<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Str;
use Midtrans\Config;
use Midtrans\Notification;
use Midtrans\Snap;

class PaymentService
{
    public function __construct()
    {
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function createTransaction(Order $order): string
    {
        // Kalau order sudah punya snap_token yang masih berlaku, pakai ulang
        // (mencegah request baru ke Midtrans setiap kali customer reload halaman pembayaran)
        if ($order->snap_token && $order->payment_status === 'unpaid') {
            return $order->snap_token;
        }

        $midtransOrderId = $order->order_number . '-' . Str::random(6);

        $params = [
            'transaction_details' => [
                'order_id' => $midtransOrderId,
                'gross_amount' => (int) $order->total,
            ],
            'customer_details' => [
                'first_name' => $order->recipient_name,
                'phone' => $order->phone,
                'billing_address' => [
                    'address' => $order->address,
                    'city' => $order->city,
                    'postal_code' => $order->postal_code,
                ],
            ],
            'item_details' => $this->buildItemDetails($order),
        ];

        $snapToken = Snap::getSnapToken($params);

        $order->update([
            'midtrans_order_id' => $midtransOrderId,
            'snap_token' => $snapToken,
        ]);

        return $snapToken;
    }

    protected function buildItemDetails(Order $order): array
    {
        $items = $order->items->map(function ($item) {
            return [
                'id' => (string) $item->product_id,
                'price' => (int) $item->price,
                'quantity' => $item->quantity,
                'name' => Str::limit($item->product_name, 50),
            ];
        })->toArray();

        // Tambahkan ongkos kirim sebagai line item terpisah,
        // supaya total item_details PERSIS sama dengan gross_amount (wajib oleh Midtrans)
        if ($order->shipping_cost > 0) {
            $items[] = [
                'id' => 'shipping',
                'price' => (int) $order->shipping_cost,
                'quantity' => 1,
                'name' => 'Ongkos Kirim',
            ];
        }

        if ($order->discount > 0) {
            $items[] = [
                'id' => 'discount',
                'price' => (int) -$order->discount,
                'quantity' => 1,
                'name' => 'Diskon',
            ];
        }

        return $items;
    }

    public function handleNotification(): array
    {
        $notification = new Notification();

        $order = Order::where('midtrans_order_id', $notification->order_id)->first();

        if (!$order) {
            throw new \RuntimeException("Order dengan midtrans_order_id {$notification->order_id} tidak ditemukan.");
        }

        $transactionStatus = $notification->transaction_status;
        $fraudStatus = $notification->fraud_status ?? null;
        $paymentType = $notification->payment_type;

        $newPaymentStatus = match (true) {
            $transactionStatus === 'capture' && $fraudStatus === 'accept' => 'paid',
            $transactionStatus === 'settlement' => 'paid',
            $transactionStatus === 'pending' => 'pending',
            in_array($transactionStatus, ['deny', 'cancel', 'expire']) => 'failed',
            $transactionStatus === 'refund' => 'refunded',
            default => $order->payment_status,
        };

        $updateData = [
            'payment_status' => $newPaymentStatus,
            'payment_method' => $paymentType,
            'midtrans_transaction_id' => $notification->transaction_id,
        ];

        if ($newPaymentStatus === 'paid' && !$order->paid_at) {
            $updateData['paid_at'] = now();
            $updateData['status'] = 'confirmed';
        }

        $order->update($updateData);

        return [
            'order' => $order->fresh(),
            'status' => $newPaymentStatus,
        ];
    }
}
<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class OrderService
{
    public function __construct(
        protected CartService $cartService,
        protected ShippingService $shippingService
    ) {
    }

    public function createFromCart(User $user, array $addressData): Order
    {
        $items = $this->cartService->getItems($user);

        if ($items->isEmpty()) {
            throw ValidationException::withMessages([
                'cart' => 'Keranjang Anda kosong.',
            ]);
        }

        return DB::transaction(function () use ($user, $addressData, $items) {

            // Kunci baris produk yang terlibat untuk mencegah race condition
            // (misal 2 customer checkout produk yang sama, stok terakhir, di waktu bersamaan)
            $productIds = $items->pluck('product_id')->all();
            $lockedProducts = Product::whereIn('id', $productIds)
                ->lockForUpdate()
                ->get()
                ->keyBy('id');

            $subtotal = 0;

            // Validasi ulang stok di dalam transaction (bukan hanya percaya data cart yang mungkin sudah usang)
            foreach ($items as $item) {
                $product = $lockedProducts->get($item->product_id);

                if (!$product || $product->status !== 'active') {
                    throw ValidationException::withMessages([
                        'cart' => "Produk \"{$item->product->name}\" sudah tidak tersedia.",
                    ]);
                }

                if ($item->quantity > $product->stock) {
                    throw ValidationException::withMessages([
                        'cart' => "Stok \"{$product->name}\" tidak mencukupi (tersisa {$product->stock}).",
                    ]);
                }

                $subtotal += $product->final_price * $item->quantity;
            }

            $shippingCost = $this->shippingService->calculate($addressData['city']);
            $total = $subtotal + $shippingCost;

            $order = Order::create([
                'user_id' => $user->id,
                'recipient_name' => $addressData['recipient_name'],
                'phone' => $addressData['phone'],
                'address' => $addressData['address'],
                'city' => $addressData['city'],
                'postal_code' => $addressData['postal_code'] ?? null,
                'address_note' => $addressData['address_note'] ?? null,
                'subtotal' => $subtotal,
                'discount' => 0,
                'shipping_cost' => $shippingCost,
                'total' => $total,
                'payment_status' => 'unpaid',
                'status' => 'pending',
            ]);

            foreach ($items as $item) {
                $product = $lockedProducts->get($item->product_id);

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'product_sku' => $product->sku,
                    'price' => $product->final_price,
                    'quantity' => $item->quantity,
                    'subtotal' => $product->final_price * $item->quantity,
                ]);

                // Kurangi stok
                $product->decrement('stock', $item->quantity);

                // Auto-update status jadi out_of_stock kalau stok habis
                if ($product->fresh()->stock <= 0) {
                    $product->update(['status' => 'out_of_stock']);
                }
            }

            // Kosongkan keranjang setelah semua berhasil
            $this->cartService->clear($user);

            $order->load('items');

            $user->notify(new \App\Notifications\OrderConfirmationNotification($order));

            return $order;
        });
    }
}
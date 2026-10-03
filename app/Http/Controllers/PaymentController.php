<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\PaymentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PaymentController extends Controller
{
    public function __construct(protected PaymentService $paymentService)
    {
    }

    public function show(Request $request, Order $order): View|RedirectResponse
    {
        abort_if($order->user_id !== $request->user()->id, 403);

        if ($order->payment_status === 'paid') {
            return redirect()->route('orders.show', $order)
                ->with('success', 'Pesanan ini sudah dibayar.');
        }

        $snapToken = $this->paymentService->createTransaction($order);

        return view('checkout.payment', [
            'order' => $order,
            'snapToken' => $snapToken,
            'clientKey' => config('services.midtrans.client_key'),
            'isProduction' => config('services.midtrans.is_production'),
        ]);
    }
}
<?php

namespace App\Http\Controllers;

use App\Services\PaymentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MidtransWebhookController extends Controller
{
    public function __construct(protected PaymentService $paymentService)
    {
    }

    public function handle(Request $request): JsonResponse
    {
        try {
            $result = $this->paymentService->handleNotification();

            Log::info('Midtrans notification processed', [
                'order_number' => $result['order']->order_number,
                'new_status' => $result['status'],
            ]);

            return response()->json(['message' => 'OK'], 200);

        } catch (\Throwable $e) {
            Log::error('Midtrans notification failed', [
                'error' => $e->getMessage(),
            ]);

            return response()->json(['message' => 'Error processing notification'], 500);
        }
    }
}
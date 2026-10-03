<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use App\Services\OrderService;
use App\Services\ShippingService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    public function __construct(
        protected CartService $cartService,
        protected OrderService $orderService,
        protected ShippingService $shippingService
    ) {
    }

    public function index(Request $request): View|RedirectResponse
    {
        $items = $this->cartService->getItems($request->user());

        if ($items->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Keranjang Anda kosong. Silakan tambahkan produk terlebih dahulu.');
        }

        $subtotal = $this->cartService->getSubtotal($request->user());
        $user = $request->user();
        $cities = $this->shippingService->getAllActiveCities();

        return view('checkout.index', compact('items', 'subtotal', 'user', 'cities'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'recipient_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string', 'max:1000'],
            'city' => ['required', 'string', 'max:255'],
            'postal_code' => ['nullable', 'string', 'max:10'],
            'address_note' => ['nullable', 'string', 'max:500'],
        ]);

        $order = $this->orderService->createFromCart($request->user(), $validated);

        return redirect()->route('checkout.payment', $order);
    }
}
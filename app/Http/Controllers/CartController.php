<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function __construct(protected CartService $cartService)
    {
    }

    public function index(Request $request): View
    {
        $items = $this->cartService->getItems($request->user());
        $subtotal = $this->cartService->getSubtotal($request->user());

        return view('cart.index', compact('items', 'subtotal'));
    }

    public function store(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'quantity' => ['nullable', 'integer', 'min:1'],
        ]);

        $this->cartService->addItem(
            $request->user(),
            $product,
            $validated['quantity'] ?? 1
        );

        return back()->with('success', 'Produk ditambahkan ke keranjang.');
    }

    public function update(Request $request, CartItem $cartItem): RedirectResponse
    {
        $validated = $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $this->cartService->updateQuantity($request->user(), $cartItem, $validated['quantity']);

        return back()->with('success', 'Keranjang diperbarui.');
    }

    public function destroy(Request $request, CartItem $cartItem): RedirectResponse
    {
        $this->cartService->removeItem($request->user(), $cartItem);

        return back()->with('success', 'Produk dihapus dari keranjang.');
    }
}
<?php

namespace App\Services;

use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\ValidationException;

class CartService
{
    public function getItems(User $user): Collection
    {
        return $user->cartItems()->with('product.category')->get();
    }

    public function addItem(User $user, Product $product, int $quantity = 1): CartItem
    {
        if ($product->status !== 'active') {
            throw ValidationException::withMessages([
                'product' => 'Produk ini tidak tersedia saat ini.',
            ]);
        }

        $existing = CartItem::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->first();

        $newQuantity = $existing ? $existing->quantity + $quantity : $quantity;

        if ($newQuantity > $product->stock) {
            throw ValidationException::withMessages([
                'quantity' => 'Jumlah melebihi stok tersedia (' . $product->stock . ').',
            ]);
        }

        return CartItem::updateOrCreate(
            ['user_id' => $user->id, 'product_id' => $product->id],
            ['quantity' => $newQuantity]
        );
    }

    public function updateQuantity(User $user, CartItem $cartItem, int $quantity): CartItem
    {
        $this->authorizeOwnership($user, $cartItem);

        if ($quantity < 1) {
            throw ValidationException::withMessages([
                'quantity' => 'Jumlah minimal 1.',
            ]);
        }

        if ($quantity > $cartItem->product->stock) {
            throw ValidationException::withMessages([
                'quantity' => 'Jumlah melebihi stok tersedia (' . $cartItem->product->stock . ').',
            ]);
        }

        $cartItem->update(['quantity' => $quantity]);

        return $cartItem->fresh();
    }

    public function removeItem(User $user, CartItem $cartItem): void
    {
        $this->authorizeOwnership($user, $cartItem);

        $cartItem->delete();
    }

    public function clear(User $user): void
    {
        $user->cartItems()->delete();
    }

    public function getSubtotal(User $user): float
    {
        return $this->getItems($user)->sum(fn (CartItem $item) => $item->subtotal);
    }

    public function getItemCount(User $user): int
    {
        return $this->getItems($user)->sum('quantity');
    }

    protected function authorizeOwnership(User $user, CartItem $cartItem): void
    {
        if ($cartItem->user_id !== $user->id) {
            abort(403, 'Anda tidak memiliki akses ke item keranjang ini.');
        }
    }
}
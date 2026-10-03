<?php

namespace App\Http\Middleware;

use App\Services\CartService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class ShareCartCount
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()) {
            $cartService = app(CartService::class);
            View::share('cartItemCount', $cartService->getItemCount($request->user()));
        } else {
            View::share('cartItemCount', 0);
        }

        return $next($request);
    }
}
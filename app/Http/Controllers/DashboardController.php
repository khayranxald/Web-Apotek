<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();

        $stats = [
            'total_orders' => $user->orders()->count(),
            'pending_orders' => $user->orders()->where('status', 'pending')->count(),
            'pending_prescriptions' => $user->prescriptions()->where('status', 'pending')->count(),
        ];

        $latestOrder = $user->orders()->latest()->first();

        return view('dashboard', compact('user', 'stats', 'latestOrder'));
    }
}
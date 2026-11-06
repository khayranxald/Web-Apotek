<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\ContactMessageNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        return view('contact');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'message' => ['required', 'string', 'max:2000'],
        ]);

        $admins = User::role(['super_admin', 'admin'])->get();

        Notification::send($admins, new ContactMessageNotification(
            $validated['name'],
            $validated['email'],
            $validated['phone'],
            $validated['message']
        ));

        return redirect()->route('contact')
            ->with('success', 'Pesan Anda berhasil dikirim. Tim kami akan segera menghubungi Anda.');
    }
}
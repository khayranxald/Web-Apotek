<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirect(): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback(): RedirectResponse
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Throwable $e) {
            Log::error('Google OAuth callback failed', ['error' => $e->getMessage()]);

            return redirect()->route('login')
                ->with('error', 'Gagal login dengan Google. Silakan coba lagi.');
        }

        // Cari user berdasarkan google_id dulu (sudah pernah login Google sebelumnya)
        $user = User::where('google_id', $googleUser->getId())->first();

        if (!$user) {
            // Belum ada yang pakai google_id ini — cek apakah email sudah terdaftar manual
            $user = User::where('email', $googleUser->getEmail())->first();

            if ($user) {
                // Akun manual sudah ada dengan email sama — gabungkan (link) akun Google ke akun ini
                $user->update([
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                ]);
            } else {
                // Benar-benar user baru — buat akun baru
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                    'password' => null,
                    'email_verified_at' => now(),
                ]);

                $user->assignRole('customer');
            }
        }

        Auth::login($user, remember: true);

        $redirectPath = match (true) {
            $user->hasRole('super_admin'), $user->hasRole('admin') => '/admin',
            $user->hasRole('pharmacist') => route('pharmacist.dashboard'),
            default => route('dashboard'),
        };

        return redirect()->intended($redirectPath);
    }
}
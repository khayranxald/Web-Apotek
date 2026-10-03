<?php

namespace App\Providers;

use App\Models\Prescription;
use App\Policies\PrescriptionPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Gate::policy(Prescription::class, PrescriptionPolicy::class);
    }
}
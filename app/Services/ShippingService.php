<?php

namespace App\Services;

use App\Models\ShippingZone;
use Illuminate\Support\Str;

class ShippingService
{
    protected const DEFAULT_COST = 20000;

    public function calculate(string $city): float
    {
        $zone = ShippingZone::where('is_active', true)
            ->whereRaw('LOWER(city) = ?', [Str::lower(trim($city))])
            ->first();

        return $zone ? (float) $zone->cost : self::DEFAULT_COST;
    }

    public function getAllActiveCities(): \Illuminate\Database\Eloquent\Collection
    {
        return ShippingZone::where('is_active', true)->orderBy('city')->get();
    }
}
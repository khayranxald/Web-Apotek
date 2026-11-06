<?php

namespace App\Services;

use App\Models\ShippingZone;
use Illuminate\Support\Str;

class ShippingService
{
    protected const DEFAULT_COST = 20000;

    public function calculate(string $city): float
    {
        $normalizedInput = $this->normalize($city);

        $zone = ShippingZone::where('is_active', true)->get()
            ->first(fn ($zone) => $this->normalize($zone->city) === $normalizedInput);

        return $zone ? (float) $zone->cost : self::DEFAULT_COST;
    }

    protected function normalize(string $city): string
    {
        $city = Str::lower(trim($city));
        $city = preg_replace('/^(kota|kabupaten|kab\.?)\s+/i', '', $city);

        return trim($city);
    }

    public function getAllActiveCities(): \Illuminate\Database\Eloquent\Collection
    {
        return ShippingZone::where('is_active', true)->orderBy('city')->get();
    }
}
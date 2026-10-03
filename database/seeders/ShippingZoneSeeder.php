<?php

namespace Database\Seeders;

use App\Models\ShippingZone;
use Illuminate\Database\Seeder;

class ShippingZoneSeeder extends Seeder
{
    public function run(): void
    {
        $zones = [
            ['city' => 'Makassar', 'cost' => 10000],
            ['city' => 'Parepare', 'cost' => 15000],
            ['city' => 'Enrekang', 'cost' => 20000],
            ['city' => 'Pare-Pare', 'cost' => 15000],
            ['city' => 'Gowa', 'cost' => 12000],
            ['city' => 'Maros', 'cost' => 12000],
            ['city' => 'Jakarta', 'cost' => 25000],
            ['city' => 'Surabaya', 'cost' => 25000],
            ['city' => 'Bandung', 'cost' => 25000],
        ];

        foreach ($zones as $zone) {
            ShippingZone::firstOrCreate(
                ['city' => $zone['city']],
                ['cost' => $zone['cost'], 'is_active' => true]
            );
        }
    }
}
<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PrescriptionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'reviewed_by' => null,
            'file_path' => 'prescriptions/dummy-' . $this->faker->uuid() . '.jpg',
            'original_filename' => 'resep-' . $this->faker->word() . '.jpg',
            'status' => 'pending',
            'pharmacist_note' => null,
            'reviewed_at' => null,
            'expires_at' => now()->addDays(30),
        ];
    }
}
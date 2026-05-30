<?php

namespace Database\Factories;

use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\Factory;

class MemberFactory extends Factory
{
    protected $model = Member::class;

    public function definition(): array
    {
        return [
            'barcode' => Member::generateBarcode(),
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'membership_type' => fake()->randomElement(['basic', 'premium', 'platinum']),
            'status' => 'active',
            'quota' => 30,
            'join_date' => now(),
        ];
    }
}

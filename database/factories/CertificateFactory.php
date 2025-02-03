<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Certificate>
 */
class CertificateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'common_name' => fake()->name(),
            'country' => fake()->countryCode(),
            'organization' => fake()->company(),
            'expiry_date' => $expiryDate = fake()->randomElement([now()->addYear(), now()->subYear()]),
            'status' => $expiryDate->isFuture() ? 'active' : 'revoked',
            'verified' => fake()->randomElement([true, false]),
        ];
    }
}

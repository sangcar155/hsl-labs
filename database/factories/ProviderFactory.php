<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Provider;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Provider>
 */
class ProviderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'user_id' => User::factory(), // ✅ this creates a User for the Provider
        'name'           => $this->faker->name(),
        'email'          => $this->faker->unique()->safeEmail(), // ✅ Add Email
        'clinic_name'    => $this->faker->company(),
        'license_number' => strtoupper($this->faker->bothify('LIC-####')),
        ];
    }
}

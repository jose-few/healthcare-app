<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'doctor_id' => fake()->numberBetween(1, 5),
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'nhs_no' => fake()->unique()->numberBetween(1000000000, 9999999999),
            'email' => fake()->unique()->email(),
            'phone' => fake()->unique()->mobileNumber(),
            'address1' => fake()->secondaryAddress(),
            'address2' => fake()->streetName(),
            'city' => fake()->city(),
            'county' => fake()->county(),
            'postcode' => 'L32 2AT',
            'dob' => fake()->date(),
            'sex' => fake()->numberBetween(1, 4),
            'deleted_at' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

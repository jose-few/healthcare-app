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
        /**
         * Select a patients sex as an int from 1-5
         * Used for a join on patients_sexes table.
         *
         * If 4 ('Prefer to self describe') is chosen, populate the self description.
         *
         * Create a first name and last name used for building a believable email.
         */
        $sex = fake()->numberBetween(1, 5);
        $first_name = fake()->firstName();
        $last_name = fake()->lastName();
        $domain = fake()->freeEmailDomain();

        /**
         * doctor_id no. 1 is reserved as a sysadmin ID.
         */
        return [
            'doctor_id' => fake()->numberBetween(2, 3),
            'first_name' => $first_name,
            'last_name' => $last_name,
            'nhs_no' => fake()->unique()->numberBetween(1000000000, 9999999999),
            'email' => $first_name . '.' . $last_name .'@' . $domain,
            'phone' => fake()->unique()->mobileNumber(),
            'address1' => fake()->secondaryAddress(),
            'address2' => fake()->streetName(),
            'city' => fake()->city(),
            'county' => fake()->county(),
            'postcode' => strtoupper(fake()->bothify('??## #??')),
            'dob' => fake()->date(),
            'sex' => $sex,
            'sex_preferred' => $sex == 4 ? 'Trans' : null,
            'deleted_at' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

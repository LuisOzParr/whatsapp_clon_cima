<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "owner_id" => User::factory()->create()->id,
            "contact_id" => User::factory()->create()->id,
            "fist_name" => $this->faker->name(),
            "last_name" => $this->faker->lastName(),
        ];
    }
}

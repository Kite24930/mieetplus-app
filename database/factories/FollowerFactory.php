<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class FollowerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $created = fake()->dateTimeBetween('-1 years', 'now');
        return [
            'student_id' => fake()->numberBetween(2, 101),
            'company_id' => 193,
            'created_at' => $created,
            'updated_at' => $created,
        ];
    }
}

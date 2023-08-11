<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faculty = [
            '人文学部',
            '教育学部',
            '医学部',
            '工学部',
            '生物資源学部',
            '人文社会科学研究科',
            '教育学研究科',
            '医学科研究科',
            '工学研究科',
            '生物資源学研究科',
            '地域イノベーション学研究科'
        ];
        return [
            'user_id' => 0,
            'univ_email' => fake()->unique()->safeEmail(),
            'faculty' => $faculty[fake()->numberBetween(0, 10)],
            'glade' => fake()->numberBetween(1, 4),
        ];
    }

    public function user(int $id): StudentFactory
    {
        return $this->state(fn (array $attributes) => [
            'user_id' => $id,
        ]);
    }
}

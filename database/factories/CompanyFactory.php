<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 0,
            'name' => fake()->company(),
            'ruby' => fake()->company(),
            'category' => Category::find(fake()->numberBetween(1, 84))->name,
            'url' => fake()->url(),
            'job_description_tellers' => fake()->realText(450),
            'tellers_img_1' => fake()->imageUrl(640, 480, 'cats'),
            'job_description' => fake()->realText(450),
            'culture_tellers' => fake()->realText(450),
            'tellers_img_2' => fake()->imageUrl(640, 480, 'cats'),
            'culture' => fake()->realText(450),
            'environment_tellers' => fake()->realText(450),
            'tellers_img_3' => fake()->imageUrl(640, 480, 'cats'),
            'environment' => fake()->realText(450),
            'feature' => fake()->realText(450),
            'career_path' => fake()->realText(450),
            'desired_person' => fake()->realText(450),
            'transfer' => fake()->realText(450),
            'content' => fake()->realText(450),
            'pr' => fake()->realText(450),
            'notice' => fake()->realText(450),
            'location' => fake()->address(),
            'location_lat' => fake()->latitude(),
            'location_lng' => fake()->longitude(),
            'work_location' => fake()->address(),
            'establishment_date' => fake()->date(),
            'capital' => fake()->numberBetween(1000, 100000),
            'sales' => fake()->numberBetween(1000, 100000),
            'employee_number' => fake()->numberBetween(1, 100),
            'graduated_number' => fake()->numberBetween(1, 100),
            'faculties' => fake()->realText(450),
            'occupations' => fake()->realText(450),
            'recruit_name' => fake()->name(),
            'recruit_ruby' => fake()->name(),
            'recruit_email' => fake()->email(),
            'top_img' => fake()->imageUrl(640, 480, 'cats'),
            'movie' => fake()->url(),
            'logo' => fake()->randomElement(['jpg', 'png', 'gif']),
            'mail_permission' => fake()->numberBetween(0, 1),
            'status' => 1,
        ];
    }

    public function company(int $id) {
        return $this->state(fn (array $attributes) => [
            'user_id' => $id,
        ]);
    }
}

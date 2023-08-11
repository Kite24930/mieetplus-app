<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $user = \App\Models\User::factory()->create();
            $user->assignRole('student');
            $student = \App\Models\Student::factory()->user($user->id)->create();
        }
    }
}

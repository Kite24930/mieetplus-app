<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $user = \App\Models\User::factory()->create();
            $user->assignRole('company');
            $student = \App\Models\Company::factory()->company($user->id)->create();
        }
    }
}

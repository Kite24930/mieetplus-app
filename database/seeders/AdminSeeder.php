<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::beginTransaction();

        $user = User::create([
            'name' => 'プロジェクトM管理者',
            'email' => 'main@mie-projectm.com',
            'password' => Hash::make('cbwI9eQgw3EP37txb9grxP8n'),
        ]);

        $user->assignRole('admin');

        DB::commit();
    }
}

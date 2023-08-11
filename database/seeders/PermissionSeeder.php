<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $accessToAdmin = Permission::create(['name' => 'admin']);
        $accessToCompany = Permission::create(['name' => 'company']);
        $accessToStudent = Permission::create(['name' => 'student']);

        $admin = Role::create(['name' => 'admin']);
        $Company = Role::create(['name' => 'company']);
        $Student = Role::create(['name' => 'student']);

        $admin->givePermissionTo($accessToAdmin);
        $Company->givePermissionTo($accessToCompany);
        $Student->givePermissionTo($accessToStudent);
    }
}

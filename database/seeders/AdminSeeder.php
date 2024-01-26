<?php

namespace Database\Seeders;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->truncate();
        DB::table('role_users')->truncate();
        $superAdminInsert = [
            'first_name' => 'Super Admin',
            'email'    => 'admin@admin.com',
            'password' => 123456,
            'is_super_admin' => 1,
        ];
        $adminInsert = [
            'first_name' => 'Admin',
            'email'    => 'user@admin.com',
            'password' => 123456,
        ];

        $roleSuperAdmin = Sentinel::findRoleBySlug('super-admin');
        $roleAdmin = Sentinel::findRoleBySlug('admin');

        $superAdmin = Sentinel::registerAndActivate($superAdminInsert);
        $admin = Sentinel::registerAndActivate($adminInsert);

        $superAdmin->roles()->attach($roleSuperAdmin);
        $admin->roles()->attach($roleAdmin);
    }
}

<?php

namespace Database\Seeders;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    const ROLES = [
        [
            'slug' => 'super-admin',
            'name' => 'Super Admin',
            'permissions' => [
                'dashboard.index' => true,
                'users.list' => true,
                'users.create' => true,
                'users.edit' => true,
                'users.show' => true,
                'users.delete' => true,
                'users.disable' => true
            ]
        ],
        [
            'slug' => 'admin',
            'name' => 'Admin',
            'permissions' => [
                'dashboard.index' => true,
                'users.list' => true,
                'users.create' => true,
                'users.show' => true,
            ]
        ],
        [
            'slug' => 'nhan-vien',
            'name' => 'Nhân viên',
            'permissions' => [
                'dashboard.index' => true,
                'users.list' => true,
                'users.create' => true,
                'users.show' => true,
            ]
        ],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->truncate();
        DB::table('role_users')->truncate();

        foreach (self::ROLES as $role) {
            Sentinel::getRoleRepository()->createModel()->create([
                'name' => $role['name'],
                'slug' => $role['slug'],
                'permissions' => $role['permissions'],
            ]);
        }
    }
}

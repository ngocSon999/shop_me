<?php

namespace Database\Seeders;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    protected array $permissions;

    public function __construct()
    {
        $this->permissions = config('permission_roles.permissions', []);
    }
    const ROLES = [
        [
            'slug' => 'super-admin',
            'name' => 'Super Admin',
        ],
        [
            'slug' => 'admin',
            'name' => 'Admin',
        ],
        [
            'slug' => 'nhan-vien',
            'name' => 'Nhân viên',
        ],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->truncate();
        DB::table('role_users')->truncate();
        $permissionAdmin = [];
        foreach ($this->permissions as $key => $permission) {
            foreach ($permission as $key2 => $value) {
                $permissionAdmin[] = [$key . '.' . $key2 => true];
            }
        }
        foreach (self::ROLES as $role) {
            if ($role['slug'] === 'super-admin') {
                Sentinel::getRoleRepository()->createModel()->create([
                    'name' => $role['name'],
                    'slug' => $role['slug'],
                    'permissions' => $permissionAdmin
                ]);
            } else {
                Sentinel::getRoleRepository()->createModel()->create([
                    'name' => $role['name'],
                    'slug' => $role['slug'],
                ]);
            }
        }
    }
}

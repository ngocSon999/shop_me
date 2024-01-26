<?php

namespace Database\Seeders;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Cartalyst\Sentinel\Roles\RoleInterface;
use Illuminate\Database\Seeder;

class RoleUpdateSeeder extends Seeder
{
    private $permissionsToAdd = [
        'film.list',
        'film.create',
        'film.show',
    ];

    private $permissionsToUpdate = [
        'dashboard.index'
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /** @var RoleInterface $roleSuperAdmin */
        $roleSuperAdmin = Sentinel::findRoleBySlug('super-admin');

        foreach ($this->permissionsToAdd as $permission) {
            $roleSuperAdmin->addPermission($permission);
        }

        foreach ($this->permissionsToUpdate as $permission) {
            $roleSuperAdmin->updatePermission($permission, true);
        }

        $roleSuperAdmin->save();
    }
}

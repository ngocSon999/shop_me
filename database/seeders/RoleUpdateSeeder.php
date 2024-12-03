<?php

namespace Database\Seeders;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Cartalyst\Sentinel\Roles\RoleInterface;
use Illuminate\Database\Seeder;

class RoleUpdateSeeder extends Seeder
{
    private $permissionsToAdd = [
        'contacts.list',
        'contacts.create',
        'contacts.edit',
        'contacts.delete',
        'contacts.show',
        'dashboard.index',
    ];

    private array $permissionsToUpdate = [
        'dashboard.index',
        'users.list',
        'categories.list',
        'products.list',
        'banners.list',
        'customers.list',
        'banks.list',
        'cards.list',
        'roles.list',
        'settings.list',
        'contacts.list',
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /** @var RoleInterface $roleAdmin */
        $roleAdmin = Sentinel::findRoleBySlug('admin');

        /** @var RoleInterface $roleSuperAdmin */
        $roleSuperAdmin = Sentinel::findRoleBySlug('super-admin');

        /** @var RoleInterface $roleUser */
        $roleUser = Sentinel::findRoleBySlug('nhan-vien');

        /*
         * nếu không có quyền nào thì thêm mới
         */
        foreach ($this->permissionsToAdd as $permission) {
            $roleSuperAdmin->addPermission($permission);
        }

        /*
         * The first true ($value) grants the permission.
         * The second true ($force) ensures the permission is added even if it doesn’t already exist in the role's permissions.
         * true 1 cấp quyền, true 2 chưa có thì tạo mới
         */
        foreach ($this->permissionsToUpdate as $permission) {
            $roleAdmin->updatePermission($permission, true, true);
            $roleUser->updatePermission($permission, true, true);
        }

        $roleAdmin->save();
        $roleSuperAdmin->save();
        $roleUser->save();
    }
}

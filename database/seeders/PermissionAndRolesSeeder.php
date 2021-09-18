<?php

namespace Database\Seeders;

use App\Enums\PermissionType;
use App\Enums\RolesType;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionAndRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => PermissionType::LOGIN_ADMIN]);
        Permission::create(['name' => PermissionType::MANAGE_USERS]);
        Permission::create(['name' => PermissionType::VIEW_USERS]);

        Role::create(['name' => RolesType::ADMIN]);
        $user = Role::create(['name' => RolesType::USER]);

        $user->givePermissionTo(PermissionType::LOGIN_ADMIN);
        $user->givePermissionTo(PermissionType::VIEW_USERS);
    }
}

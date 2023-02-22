<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleSuperAdmin = Role::create(['name' => 'superAdmin']);
        $roleAdmin = Role::create(['name' => 'admin']);
        $roleEditor = Role::create(['name' => 'editor']);
        $roleUser = Role::create(['name' => 'user']);

        $permissions = [

            // dashboard permission
            "dashboard.view",

            // blog permission
            "blog.create",
            "blog.view",
            "blog.edit",
            "blog.delete",
            "blog.approve",

            // admin permission
            "admin.create",
            "admin.view",
            "admin.edit",
            "admin.delete",
            "admin.approve",

            // role permission
            "role.create",
            "role.view",
            "role.edit",
            "role.delete",
            "role.approve",

            // profile permission
            "profile.view",
            "profile.delete"

        ];
        foreach($permissions as $key=> $permission){
            Permission::create(['name' => $permission]);
            $roleSuperAdmin->givePermissionTo($permission);
        }
    }
}

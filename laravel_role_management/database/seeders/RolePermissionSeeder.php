<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create Roles
        $roleSuperAdmin = Role::create(['name' => 'superAdmin']);
        $roleAdmin = Role::create(['name' => 'admin']);
        $roleEditor = Role::create(['name' => 'editor']);
        $roleUser = Role::create(['name' => 'user']);

//        permission list as array
        $permissions = [

            [
                'group_name' => 'dashboard',
                'permissions' => [
                    'dashboard.view',
                    'dashboard.edit',
                ]
            ],

            [
                'group_name' => 'blog',
                'permissions' => [
                    //Blog Permissions
                    'blog.create',
                    'blog.view',
                    'blog.edit',
                    'blog.delete',
                    'blog.approve',
                ]
            ],

            [
                'group_name' => 'admin',
                'permissions' => [
                    //Admin Permissions
                    'admin.create',
                    'admin.view',
                    'admin.edit',
                    'admin.delete',
                    'admin.approve',
                ]
            ],

            [
                'group_name' => 'role',
                'permissions' => [
                    //Role Permissions
                    'role.create',
                    'role.view',
                    'role.edit',
                    'role.delete',
                    'role.approve',
                ]
            ],

            [
                'group_name' => 'profile',
                'permissions' => [
                    //Profile Permissions
                    'profile.view',
                    'profile.edit',
                ]
            ],
        ];
//        Create and Assign Permissions
//        $permission = Permission::create(['name' => 'edit articles']);
        for($i=0;$i<count($permissions);$i++){
            $permissionGroup = $permissions[$i]['group_name'];
            for($j=0;$j < count($permissions[$i]['permissions']); $j++){
                // create permission
                $permission = Permission::create(['name' => $permissions[$i]['permissions'][$j], 'group_name' => $permissionGroup]);
                $roleSuperAdmin->givePermissionTo($permission);
                $permission->assignRole($roleSuperAdmin);
            }
        }
    }
}

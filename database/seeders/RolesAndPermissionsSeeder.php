<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        
        $roles = ['Admin', 'User'];

        foreach ($roles as $role) {
            DB::table('roles')->insert([
                'name' => $role,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

 
        $permissions = ['create', 'read', 'update', 'delete'];

        foreach ($permissions as $permission) {
            DB::table('permissions')->insert([
                'name' => $permission,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

       
        $adminRoleId = DB::table('roles')->where('name', 'Admin')->first()->id;
        $userRoleId = DB::table('roles')->where('name', 'User')->first()->id;

        foreach ($permissions as $permission) {
            $permissionId = DB::table('permissions')->where('name', $permission)->first()->id;
            DB::table('permission_role')->insert([
                'role_id' => $adminRoleId,
                'permission_id' => $permissionId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $readPermissionId = DB::table('permissions')->where('name', 'read')->first()->id;
        DB::table('permission_role')->insert([
            'role_id' => $userRoleId,
            'permission_id' => $readPermissionId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}


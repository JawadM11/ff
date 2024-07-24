<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        
        $roles = ['Admin', 'User'];

        foreach ($roles as $role) {
            Role::create([
                'name' => $role,
            ]);
        }

    
        $permissions = ['create', 'read', 'update', 'delete'];

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission,
            ]);
        }

        
        $adminRole = Role::where('name', 'Admin')->first();
        $userRole = Role::where('name', 'User')->first();

        foreach ($permissions as $permission) {
            $permissionModel = Permission::where('name', $permission)->first();
            $adminRole->permissions()->attach($permissionModel->id);
        }

        $readPermission = Permission::where('name', 'read')->first();
        $userRole->permissions()->attach($readPermission->id);
    }
}
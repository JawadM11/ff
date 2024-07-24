<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    public function run()
    {
        $roles = ['user', 'admin'];

        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }
    }
}

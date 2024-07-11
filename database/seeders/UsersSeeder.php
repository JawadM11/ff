<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    public function run()
    {
        // Create users
        $adminUserId = DB::table('users')->insertGetId([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $normalUserId = DB::table('users')->insertGetId([
            'name' => 'Normal User',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Assign roles to users
        $adminRoleId = DB::table('roles')->where('name', 'Admin')->first()->id;
        $userRoleId = DB::table('roles')->where('name', 'User')->first()->id;

        DB::table('role_user')->insert([
            ['user_id' => $adminUserId, 'role_id' => $adminRoleId, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => $normalUserId, 'role_id' => $userRoleId, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}

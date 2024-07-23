<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = Role::create(['name' => 'user']);
        $admin = Role::create(['name' => 'admin']);
        $user_index = Permission::create(['name' => 'user.index']);
        $user_delete = Permission::create(['name' => 'user.delete']);
        $me = Permission::create(['name' => 'me']);
        $profile_update = Permission::create(['name' => 'profile.update']);
        $reset_password = Permission::create(['name' => 'reset.password']);
        $me->assignRole($admin,$user);
        $user_index->assignRole($admin);
        $user_delete->assignRole($user,$admin);
        $profile_update->assignRole($admin,$user);
        $reset_password->assignRole($admin,$user);
    }
}

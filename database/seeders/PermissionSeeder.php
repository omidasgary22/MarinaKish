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
        $user_index->assignRole($admin);
        $user_delete = Permission::create(['name' => 'user.delete']);
        $user_delete->assignRole($user,$admin);
        $me = Permission::create(['name' => 'me']);
        $me->assignRole($admin,$user);
        $profile_update = Permission::create(['name' => 'profile.update']);
        $reset_password = Permission::create(['name' => 'reset.password']);
        $profile_update->assignRole($admin,$user);
        $reset_password->assignRole($admin,$user);
        $product_index = Permission::create(['name' => 'product.index']);
        $product_create = Permission::create(['name' => 'product.create']);
        $product_update = Permission::create(['name' => 'product.update']);
        $product_delete = Permission::create(['name' => 'product.delete']);
        $product_restore = Permission::create(['name' => 'product.restore']);
        $product_index->assignRole($admin,$user);
        $product_update->assignRole($admin);
        $product_delete->assignRole($admin);
        $product_create->assignRole($admin);
        $product_restore->assignRole($admin);
    }
}

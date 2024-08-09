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
        Permission::create(['name' => 'user.update']);
        $me = Permission::create(['name' => 'me']);
        $profile_update = Permission::create(['name' => 'profile.update']);
        $reset_password = Permission::create(['name' => 'reset.password']);
        $product_create = Permission::create(['name' => 'product.create']);
        $product_update = Permission::create(['name' => 'product.update']);
        $product_delete = Permission::create(['name' => 'product.delete']);
        $product_restore = Permission::create(['name' => 'product.restore']);
        $order_create = Permission::create(['name' => 'order.create']);
        $order_delete = Permission::create(['name' => 'order.delete']);
        $order_index = Permission::create(['name' => 'order.index']);
        $ticket_create = Permission::create(['name' => 'ticket.create']);
        $ticket_update = Permission::create(['name' => 'ticket.update']);
        $ticket_delete = Permission::create(['name' => 'ticket.delete']);
        $ticket_index = Permission::create(['name' => 'ticket.index']);
        $rule_create = Permission::create(['name' => 'rule.create']);
        $rule_update = Permission::create(['name' => 'rule.update']);
        $rule_delete = Permission::create(['name' => 'rule.delete']);
        $rule_restore = Permission::create(['name' => 'rule.restore']);
        $blog_create = Permission::create(['name' => 'blog.create']);
        $blog_update = Permission::create(['name' => 'blog.update']);
        $blog_delete = Permission::create(['name' => 'blog.delete']);
        $comment_create = Permission::create(['name' => 'comment.create']);
        $comment_delete = Permission::create(['name' => 'comment.delete']);
        $comment_restore = Permission::create(['name' => 'comment.restore']);
        $comment_index = Permission::create(['name'=>'comment.index']);

        $admin->givePermissionTo(Permission::all());
        $user->givePermissionTo([
            $user_delete,$me,$profile_update,$reset_password,
            $order_create,$order_delete,$order_index,
            $ticket_create,$ticket_update,$ticket_delete,$ticket_index,
            $comment_create
        ]);
    }
}

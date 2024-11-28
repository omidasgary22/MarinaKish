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
        $product_index = Permission::create(['name'=>'product.index']);
        $product_create = Permission::create(['name' => 'product.create']);
        $product_update = Permission::create(['name' => 'product.update']);
        $product_delete = Permission::create(['name' => 'product.delete']);
        $product_restore = Permission::create(['name' => 'product.restore']);
        $order_create = Permission::create(['name' => 'order.create']);
        $order_delete = Permission::create(['name' => 'order.delete']);
        $order_index = Permission::create(['name' => 'order.index']);
        $order_admin_index = Permission::create(['name'=>'order.admin.index']);
        $ticket_create = Permission::create(['name' => 'ticket.create']);
        $ticket_update = Permission::create(['name' => 'ticket.update']);
        $ticket_delete = Permission::create(['name' => 'ticket.delete']);
        $ticket_index = Permission::create(['name' => 'ticket.index']);
        $ticket_admin_index = Permission::create(['name' => 'ticket.admin.index']);
        $rule_index = Permission::create(['name'=>'rule.index']);
        $rule_create = Permission::create(['name' => 'rule.create']);
        $rule_update = Permission::create(['name' => 'rule.update']);
        $rule_delete = Permission::create(['name' => 'rule.delete']);
        $rule_restore = Permission::create(['name' => 'rule.restore']);
        $blog_index = Permission::create(['name'=>'blog.index']);
        $blog_create = Permission::create(['name' => 'blog.create']);
        $blog_update = Permission::create(['name' => 'blog.update']);
        $blog_delete = Permission::create(['name' => 'blog.delete']);
        $blog_restore = Permission::create(['name'=>"blog.restore"]);
        $comment_create = Permission::create(['name' => 'comment.create']);
        $comment_update = Permission::create(['name' => 'comment.update']);
        $comment_delete = Permission::create(['name' => 'comment.delete']);
        $comment_restore = Permission::create(['name' => 'comment.restore']);
        $comment_index = Permission::create(['name'=>'comment.index']);
        $comment_admin_index = Permission::create(['name'=>'comment.admin.index']);
        $off_code_index = Permission::create(['name' => 'off_code.index']);
        $off_code_update = Permission::create(['name' => 'off_code.update']);
        $off_code_delete = Permission::create(['name' => 'off_code.delete']);
        $off_code_restore = Permission::create(['name' => 'off_code.restore']);
        $off_code_create = Permission::create(['name' => 'off_code.create']);
        $off_code_use = Permission::create(['name' => 'off_code.use']);
        $passenger_index = Permission::create(['name' => 'passenger.index']);
        $passenger_create = Permission::create(['name' => 'passenger.create']);
        $passenger_update = Permission::create(['name' => 'passenger.update']);
        $passenger_delete = Permission::create(['name' => 'passenger.delete']);
        $setting_index = Permission::create(['name' => 'setting.index']);
        $setting_update = Permission::create(['name' => 'setting.update']);
        $setting_logo = Permission::create(['name' => 'setting.logo']);
        $faq_create = Permission::create(['name' => 'faq.create']);
        $faq_update = Permission::create(['name' => 'faq.update']);
        $faq_delete = Permission::create(['name' => 'faq.delete']);
        $faq_restore = Permission::create(['name' => 'faq.restore']);
        $report_index = Permission::create(['name' => 'report.index']);
        $report_show = Permission::create(['name' => 'report.show']);


        $admin->givePermissionTo(Permission::all());
        $user->givePermissionTo([
            $user_delete,$me,$profile_update,$reset_password,
            $order_create,$order_delete,$order_index,
            $ticket_create,$ticket_update,$ticket_delete,$ticket_index,
            $comment_create,$comment_index,
            $passenger_index,$passenger_create,$passenger_update,$passenger_delete,
            $off_code_use
        ]);
    }
}

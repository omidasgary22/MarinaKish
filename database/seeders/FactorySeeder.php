<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class FactorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::factory([
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'national_code' => 'admin',
            'phone' => '09120000000',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
            'birth_day'=>"2000-01-01"
        ])->create();
        $admin->assignRole('admin');
    }
}

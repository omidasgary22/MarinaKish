<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SetingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::factory(
            [
                'key' => "footer",
                'value' => [
                    'fast forward1',
                    'fast forward2',
                    'fast forward3',
                ]
            ]
        )
            ->create();
        Setting::factory(
            [
                'key' => 'contact_us',
                'value' => [
                    'phone_number',
                    'address',
                    'email'
                ]
            ])
            ->create();
        Setting::factory([
            'key' => 'category',
            'value' => [
                'category1',
                'category2',
                'category3',
            ]
        ])
            ->create();
        Setting::factory([
            'key' => 'about_us',
            'value' => 'about us text',
        ])
            ->create();
        Setting::factory([
            'key' => 'image',
            'value' => 'image address'
        ])
            ->create();
    }
}

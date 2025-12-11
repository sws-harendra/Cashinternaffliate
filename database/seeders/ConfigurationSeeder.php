<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            ['key' => 'playstore_app_link', 'value' => null],
            ['key' => 'website_link', 'value' => null],
            ['key' => 'terms_link', 'value' => null],
            ['key' => 'privacy_link', 'value' => null],
            ['key' => 'telegram_link', 'value' => null],
            ['key' => 'facebook_link', 'value' => null],
            ['key' => 'instagram_link', 'value' => null],
            ['key' => 'youtube_link', 'value' => null],
            ['key' => 'support_email', 'value' => null],
            ['key' => 'company_logo', 'value' => null],
            ['key' => 'referral_bonus', 'value' => '0'],
            ['key' => 'min_withdraw', 'value' => '0'],
        ];

        foreach ($settings as $setting) {
            \App\Models\Configuration::firstOrCreate(['key' => $setting['key']], $setting);
        }
    }
}

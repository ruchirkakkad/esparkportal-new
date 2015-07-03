<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class SettingsTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('settings')->delete();
        Setting::create([
            'key' => 'hr_name',
            'value' => '',
            'group' => 'general_settings'
        ]);
        Setting::create([
            'key' => 'hr_contact',
            'value' => '',
            'group' => 'general_settings'
        ]);
        Setting::create([
            'key' => 'hr_email',
            'value' => '',
            'group' => 'general_settings'
        ]);
        Setting::create([
            'key' => 'company_site',
            'value' => '',
            'group' => 'general_settings'
        ]);
        Setting::create([
            'key' => 'company_address',
            'value' => '',
            'group' => 'general_settings'
        ]);
    }

}
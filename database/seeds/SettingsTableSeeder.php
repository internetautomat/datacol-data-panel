<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Setting::create( [
            'name' => 'department',
            'value' => 'IT Department (aka Department Of Magic)' . PHP_EOL . 'Ministry Of Sales',
        ] );

        \App\Models\Setting::create( [
            'name' => 'prefer',
            'value' => 'barcode',
        ] );

        \App\Models\Setting::create( [
            'name' => 'reminder_days',
            'value' => '1',
        ] );

    }
}

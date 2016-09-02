<?php

use Illuminate\Database\Seeder;

class AbilitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $abs = [
            [
                'name' => 'users.view',
                'title' => 'View Users',
                'description' => '',
            ],
            [
                'name' => 'users.manage',
                'title' => 'Manage Users',
                'description' => '',
            ],
            [
                'name' => 'system.view',
                'title' => 'View System Settings',
                'description' => '',
            ],
            [
                'name' => 'system.manage',
                'title' => 'Manage System Settings',
                'description' => '',
            ],
        ];
        foreach ( $abs as $ab )
        {
            \Silber\Bouncer\Database\Ability::create( $ab );
        }
    }
}

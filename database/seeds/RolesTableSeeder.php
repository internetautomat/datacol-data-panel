<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Models\Role::create( [
            'name' => 'admin',
            'title' => 'System Administrator',
            'description' => 'That guy with god mode',
        ] );
        App\Models\Role::create( [
            'name' => 'manager',
            'title' => 'Manager',
            'description' => 'Some guy working for food',
        ] );

        App\Models\Role::create( [
            'name' => 'user',
            'title' => 'User',
            'description' => 'Regular user',
        ] );

    }
}

<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $u = App\Models\User::create( [
            'name' => 'Root Admin',
            'email' => 'i@zlad.tk',
            'login' => 'admin',
            'password' => bcrypt( 'ololo' ),
            'phone' => '+380987654321',
            'remember_token' => str_random( 10 ),
            'active' => 1,
        ] );

        $u = App\Models\User::create( [
            'name' => 'Moderator',
            'email' => 'manager@zlad.tk',
            'login' => 'manager',
            'password' => bcrypt( 'ololo' ),
            'phone' => '+380987654321',
            'remember_token' => str_random( 10 ),
            'active' => 1,
        ] );
        //factory( App\Models\User::class, 5 )->create();
    }
}

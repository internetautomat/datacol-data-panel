<?php

namespace App\Providers;

use App\Models\User;
use Bouncer;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->seedAcl();
    }

    private function seedAcl()
    {
        Bouncer::seeder( function ()
        {
            Bouncer::allow( 'admin' )->to( [

                'system.view',
                'users.view',

                'system.manage',
                'users.manage',

            ] );
            Bouncer::allow( 'manager' )->to(
                [
                    'system.view',
                    'system.manage',
                ]
            );

            Bouncer::allow( 'user' )->to(
                [
                    'system.view',
                ]
            );

            Bouncer::assign( 'admin' )->to( User::first() );
            Bouncer::assign( 'manager' )->to( User::where( [ 'login' => 'manager' ] )->first() );
        } );
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

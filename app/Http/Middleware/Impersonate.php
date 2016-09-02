<?php
/**
 * Created by PhpStorm.
 * User: exfriend
 * Date: 26.08.16
 * Time: 5:22
 */

namespace App\Http\Middleware;


use Closure;

class Impersonate
{
    /**
     * Handle an incoming request.
     */
    public function handle( $request, Closure $next )
    {
        if ( $request->session()->has( 'impersonate' ) )
        {
            auth()->onceUsingId( $request->session()->get( 'impersonate' ) );
        }

        return $next( $request );
    }
}
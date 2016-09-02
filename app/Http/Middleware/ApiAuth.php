<?php

namespace App\Http\Middleware;

use Closure;

class ApiAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle( $request, Closure $next )
    {
        if ( !\Auth::attempt( [ 'login' => $request->get( 'login' ), 'password' => $request->get( 'password' ) ] ) )
        {
            die( json_encode( [ 'status' => 'error', 'message' => 403, 'request' => $request->all() ] ) );
        }

        return $next( $request );
    }
}

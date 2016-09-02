<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Validator;

class AuthController extends Controller
{

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;
    protected $redirectTo = '/home';
    protected $alternativeIdentifier = 'login';

    public function __construct()
    {
        $this->middleware( $this->guestMiddleware(), [ 'except' => 'logout' ] );
    }

    protected function getCredentials( Request $request )
    {
        $data = $request->only( 'email', 'password' );

        if ( !$this->is_email( $data[ 'email' ] ) )
        {
            if ( $u = User::where( $this->alternativeIdentifier, $data[ 'email' ] )->first() )
            {
                $data[ 'email' ] = $u->email;
            }
        }

        $data[ 'active' ] = 1;
        return $data;
    }

    protected function is_email( $email )
    {
        $v = Validator::make( [ 'email' => $email ], [ 'email' => 'required|email' ] );
        return $v->passes();
    }

    protected function validator( array $data )
    {
        return Validator::make( $data, [
            'name' => 'required|max:255',
            'login' => 'required_without:email|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'phone' => 'max:255',
            'password' => 'required|min:6|confirmed',
        ] );
    }

    protected function create( array $data )
    {
        $user = User::create( [
            'login' => $data[ 'login' ],
            'phone' => $data[ 'phone' ],
            'name' => $data[ 'name' ],
            'email' => $data[ 'email' ],
            'password' => bcrypt( $data[ 'password' ] ),
        ] );

        \Bouncer::assign( 'user' )->to( $user );

        return $user;
    }
}

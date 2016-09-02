<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;

class ProfileController extends Controller
{
    public function index()
    {
        return view( 'profile' );
    }

    public function update( UpdateProfileRequest $request )
    {
        $user = auth()->user();

        if ( $request->get( 'new_password', false ) )
        {
            if ( !\Hash::check( $request->password, auth()->user()->password ) )
            {
                flash()->error( t( 'profile.flash.incorrect_password' ) );
                return back()->withInput();
            }
            $user->password = bcrypt( $request->get( 'new_password' ) );
        }

        $user->phone = $request->get( 'phone' );
        $user->name = $request->get( 'name' );
        $user->save();

        flash()->success( t( 'profile.flash.updated' ) );
        return back();
    }
}

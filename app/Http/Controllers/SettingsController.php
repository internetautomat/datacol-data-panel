<?php

namespace App\Http\Controllers;

use App\Http\Requests;

class SettingsController extends Controller
{
    public function index()
    {
        $this->authorize( 'system.view' );
        return view( 'settings' );
    }

    public function update( Requests\UpdateSettingsRequest $request )
    {
        $this->authorize( 'system.manage' );
        foreach ( $request->except( [ '_token' ] ) as $key => $value )
        {
            $s = \App\Models\Setting::whereName( $key )->first();
            $s->value = $value;
            $s->save();
        }


        flash()->success( 'Settings saved' );
        return redirect()->back();
    }
}

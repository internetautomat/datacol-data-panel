<?php

namespace App\Http\Controllers;

class PermissionsController extends Controller
{
    public function index()
    {
        $this->authorize( 'system.view' );
        return view( 'permissions.index' );
    }
}

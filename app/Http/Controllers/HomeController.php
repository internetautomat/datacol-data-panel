<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.2/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware( 'auth' );
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        $tables = get_data_tables();
        return view( 'home', compact( 'tables' ) );
    }

    public function table( Request $request, $table_name )
    {

        try
        {
            $columns = \DB::select( 'SHOW FULL COLUMNS FROM `datatables_' . $table_name . '`' );

            $columns = array_filter( $columns, function ( $item )
            {
                return !in_array( $item->Field, [
                    'id',
                    'created_at',
                    'updated_at',
                    'processed',
                ] );
            } );


        }
        catch ( \Exception $e )
        {
            $columns = [];
        }
        return view( 'table', compact( 'columns', 'table_name' ) );

    }


    public function ajax( Request $request, $table_name )
    {
        $q = \DB::table( 'datatables_' . $table_name );

        if ( $request->processed === '0' )
        {
            $q->where( 'processed', 0 );
        }
        elseif ( $request->processed === '1' )
        {
            $q->where( 'processed', 1 );
        }


        return \Datatables::of( $q )
                          ->blacklist( [ 'created_at', 'updated_at' ] )
            //->searchColumns('some_string', 'phone')
                          ->make( true );
    }
}

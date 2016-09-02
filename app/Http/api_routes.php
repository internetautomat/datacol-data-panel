<?php

// ---------------------------------------------------------------------
// --[ API routes ]-----------------------------------------------------
// ---------------------------------------------------------------------

Route::group( [ 'prefix' => 'api' ], function ()
{
    Route::group( [ 'prefix' => 'v1' ], function ()
    {

        Route::post( 'drop', 'ApiController@drop' )->middleware( 'api_auth' );
        Route::post( 'create', 'ApiController@create' )->middleware( 'api_auth' );
        Route::post( 'store', 'ApiController@store' )->middleware( 'api_auth' );
        Route::post( 'exists', 'ApiController@exists' )->middleware( 'api_auth' );

        Route::post( 'ajax/drop', 'ApiController@drop' );
        Route::post( 'delete', 'ApiController@destroy' ); //->middleware('auth');
        Route::post( 'setmarked', 'ApiController@setmarked' );//->middleware('auth');
        Route::post( 'setunmarked', 'ApiController@setunmarked' );//->middleware('auth');


    } );
} );



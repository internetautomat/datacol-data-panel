<?php

Route::group( [ 'middleware' => [ 'impersonate' ] ], function ()
{
    Route::get( '/', [ 'as' => 'home', 'uses' => 'HomeController@index' ] );
    Route::get( 'home', [ 'as' => 'home', 'uses' => 'HomeController@index' ] );
} );

// ---------------------------------------------------------------------
// ---------------------------------------------------------------------
// --[ API routes ]-----------------------------------------------------
// ---------------------------------------------------------------------

Route::get( 'ajax/{table_name}', [
    'as' => 'datatables.data',
    'uses' => 'HomeController@ajax',
] );


Route::get( 'login', 'Auth\AuthController@getLogin' );
Route::post( 'login', 'Auth\AuthController@postLogin' );
Route::get( 'logout', 'Auth\AuthController@logout' );

Route::get( 'register', 'Auth\AuthController@getRegister' );
Route::post( 'register', 'Auth\AuthController@postRegister' );

Route::get( 'password/reset', 'Auth\PasswordController@getEmail' );
Route::post( 'password/email', 'Auth\PasswordController@postEmail' );
Route::get( 'password/reset/{token}', 'Auth\PasswordController@getReset' );
Route::post( 'password/reset', 'Auth\PasswordController@postReset' );

Route::group( [ 'middleware' => [ 'auth', 'impersonate' ] ], function ()
{
    Route::get( '/users/{id}/impersonate', 'UserController@impersonate' );
    Route::get( '/users/stop', 'UserController@stopImpersonate' );
    // ---------------------------------------------------------------------
    // --[ Permissions ]----------------------------------------------------
    // ---------------------------------------------------------------------

    Route::get( 'profile', [
        'as' => 'profile.index',
        'uses' => 'ProfileController@index',
    ] );

    Route::post( 'profile', [
        'as' => 'profile.update',
        'uses' => 'ProfileController@update',
    ] );

    Route::get( 'permissions', [
        'as' => 'permissions.index',
        'uses' => 'PermissionsController@index',
    ] );

    // ---------------------------------------------------------------------
    // --[ Common ]---------------------------------------------------------
    // ---------------------------------------------------------------------

    Route::get( 'settings', [
        'as' => 'settings.index',
        'uses' => 'SettingsController@index',
    ] );

    Route::post( 'settings', [
        'as' => 'settings.update',
        'uses' => 'SettingsController@update',
    ] );

    Route::resource( 'users', 'UserController' );

    Route::resource( 'roles', 'RoleController' );

    Route::get( '{table_name}', [
        'as' => 'table',
        'uses' => 'HomeController@table',
    ] );

} );


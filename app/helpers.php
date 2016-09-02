<?php

function active( $path, $active = "active" )
{
    return call_user_func_array( '\Request::is', (array)$path ) ? $active : '';
}

function t( $text, $default = null )
{
    $translator = app( 'translator' );
    return $translator->has( $text ) ? $translator->trans( $text ) : ( $default ?: $text );
}

function get_first_data_table()
{
    return array_pop( get_data_tables() );
}

function normalize_data_table( $name )
{
    return str_replace( 'datatables_', '', $name );
}

function get_data_tables()
{

    $tables = \DB::select( 'SHOW TABLES' );
    $tn = 'Tables_in_' . env( 'DB_DATABASE' );
    $t = [];

    foreach ( $tables as $table )
    {
        $current = $table->$tn;
        if ( strpos( $current, 'datatables_' ) !== false )
        {
            $t[] = $current;
        }
    }

    return $t;

}

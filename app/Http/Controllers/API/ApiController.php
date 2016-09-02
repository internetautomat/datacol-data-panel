<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

class ApiController extends \App\Http\Controllers\Controller
{

    public function create( Request $request )
    {

        if ( \Schema::hasTable( 'datatables_' . $request->table ) )
        {
            return $this->respondError( 'Table exists' );
        }

        $fields = $request->fields;
        \Schema::create( 'datatables_' . $request->table, function ( $table ) use ( $fields )
        {
            $table->engine = "MyISAM";
            $table->increments( 'id' )->comment( 'ID' );
            foreach ( $fields as $field )
            {
                $type = isset( $field[ 'type' ] ) ? $field[ 'type' ] : 'string';
                $comment = isset( $field[ 'title' ] ) ? $field[ 'title' ] : $field[ 'name' ];

                if ( $type == 'string' && !isset( $field[ 'size' ] ) )
                {
                    $field[ 'size' ] = 400;
                }

                if ( isset( $field[ 'size' ] ) )
                {
                    $table->$type( $field[ 'name' ], $field[ 'size' ] )->comment( $comment );
                }
                else
                {
                    $table->$type( $field[ 'name' ] )->comment( $comment );
                }

            }
            $table->boolean( 'processed' )->default( 0 )->comment( 'обработано' );
            $table->timestamps();
        } );


        return $this->respondOk( 'table created' );
    }


    public function store( Request $request )
    {
        $data = $request->data;
        try
        {
            foreach ( $data as $item )
            {
                if ( !$record = \DB::table( 'datatables_' . $request->table )->where( $item )->first() )
                {
                    \DB::table( 'datatables_' . $request->table )->insert( $item );
                }
            }

            return $this->respondOk();
        }
        catch ( \Exception $e )
        {
            return $this->respondError( (string)$e );
        }
    }

    public function exists( Request $request )
    {

        if ( \Schema::hasTable( 'datatables_' . $request->get( 'table' ) ) )
        {

            $columns = \DB::select( 'SHOW FULL COLUMNS FROM datatables_' . $request->get( 'table' ) );
            return $this->respondOk( $columns );
        }

        return $this->respondOk( false );

    }

    public function drop( Request $request )
    {
        if ( \Schema::hasTable( 'datatables_' . $request->get( 'table' ) ) )
        {
            \Schema::drop( 'datatables_' . $request->get( 'table' ) );
            return $this->respondOk( 'Table dropped' );
        }
        else
        {
            return $this->respondError( 'Table does not exist' );
        }
    }


    public function setmarked( Request $request )
    {
        \DB::table( 'datatables_' . $request->table )->whereIn( 'id', collect( $request->rows )->lists( 'id' ) )->update( [ 'processed' => 1 ] );
        return $this->respondOk( 'Processed' );
    }

    public function setunmarked( Request $request )
    {
        \DB::table( 'datatables_' . $request->table )->whereIn( 'id', collect( $request->rows )->lists( 'id' ) )->update( [ 'processed' => 0 ] );
        return $this->respondOk( 'Processed' );
    }

    public function destroy( Request $request )
    {
        // удалить все данные
        if ( $request->get( 'all', false ) )
        {
            \DB::table( 'datatables_' . $request->table )->truncate();
            return $this->respondOk();
        }

        // удалить часть данных
        \DB::table( 'datatables_' . $request->table )->whereIn( 'id', collect( $request->rows )->lists( 'id' ) )->delete();
        return $this->respondOk();
    }

    protected function respondOk( $info = false )
    {
        return $this->respond( [ 'status' => 'success', 'message' => $info ] );
    }

    protected function respondError( $info )
    {
        return $this->respond( [ 'status' => 'error', 'message' => $info ] );
    }

    protected function respond( $response )
    {
        return json_encode( $response );
    }

}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Drop extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'drop';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Drop everything inside the database';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $pdo = \DB::connection( 'mysql' )->getPdo();

        $tables = $pdo
            ->query( "SHOW FULL TABLES;" )
            ->fetchAll();

        $sql = 'SET FOREIGN_KEY_CHECKS=0;';

        foreach ( $tables as $tableInfo )
        {
            // truncate tables only
            if ( 'BASE TABLE' !== $tableInfo[ 1 ] )
            {
                continue;
            }

            $name = $tableInfo[ 0 ];
            $sql .= 'DROP TABLE ' . $name . ';';
            $this->info( 'Dropping table ' . $name );
        }

        $sql .= 'SET FOREIGN_KEY_CHECKS=1;';

        $pdo->exec( $sql );

        $this->comment( 'Done!' );
    }
}

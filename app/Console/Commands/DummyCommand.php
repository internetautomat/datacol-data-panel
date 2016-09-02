<?php

namespace App\Console\Commands;

class DummyCommand extends \Exfriend\Overseer\Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:dummy {--max=5}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dummy for test';


    public function work()
    {

        $max = $this->option( 'max' );

        for ( $i = 0; $i < $max; $i++ )
        {
            sleep( 1 );
            $this->logger->info( 'iteration #' . $i . ' of ' . $max );
            $this->check();
        }

    }

}

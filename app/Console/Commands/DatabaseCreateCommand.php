<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PDO;
use PDOException;

class DatabaseCreateCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command creates a new database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $database = env('DB_DATABASE');
        if (!$database) {
            $this->info('Skipping creation of database as env(DB_DATABASE) is empty');
        }
        try {
            $pdo = $this->getConnection(env('DB_HOST'), env('DB_USERNAME'),
                env('DB_PASSWORD'));
            $pdo->query(sprintf('CREATE DATA BASE IF NOT EXISTS %s CHARACTER SET %s COLLATE %s',
                $database, env('DB_CHARSET'),
                env('DB_COLLATION')
            ));
            $this->info(sprintf('Successfully created %s database', $database));
        } catch (PDOException $exception) {
            $this->error(sprintf('Failed to create %s database, %s', $database,
                $exception->getMessage()));
        }

    }

    private function getConnection($host, $username, $password)
    {
        return new PDO("mysql:host=$host;", $username, $password);
    }
}

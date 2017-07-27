<?php

namespace App\Console\Commands;

use App\Library\Core\menu;
use App\Models\baseModel;
use App\Models\emailSent;
use App\Models\profileAssignments;
use App\Models\profilePermission;
use App\Models\resourceUrl;
use App\Models\translationKey;
use App\Models\user;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PDO;

class appInit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:init {option?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'XOL >> Initialize default app values';

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
		$this->line('Initializing project...');
		if($this->argument('option') === 'reset' and env('APP_ENV') == 'local')
		{
			$this->line('Resetting database...');
			$pdo = $this->getPDOConnection(env('DB_HOST'), env('DB_PORT'), env('DB_USERNAME'), env('DB_PASSWORD'));
			$pdo->exec(sprintf(
						   'DROP DATABASE IF EXISTS %s ;',
						   env('DB_DATABASE')
					   ));
			$pdo->exec(sprintf(
						   'CREATE DATABASE %s;',
						   env('DB_DATABASE')
					   ));

			$this->call('migrate:refresh');
		}
		$this->line('Initialization complete!');
		return true;
    }

	private function getPDOConnection($host, $port, $username, $password)
	{
		return new PDO(sprintf('mysql:host=%s;port=%d;', $host, $port), $username, $password);
	}
}
<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;

class tampilkanDosen extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:dosen';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
		$users = User::where('role_id',  '2')->get();
		$data = [];
		foreach ($users as $user) {
			$data[] = $user->nama;
		}
		return  dd( $data );
    }
}

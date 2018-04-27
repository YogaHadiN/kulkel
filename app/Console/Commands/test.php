<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\Perpus;
use App\Video;
use App\JenisStase;
use App\Stase;
use Storage;

class test extends Command
{
    /**
     * The name and signature of the console command.
     *

class test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:test';

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
		dd(env('MAIL_DRIVER'));
    }
}

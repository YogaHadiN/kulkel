<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\PinjamBuku;
use Log;

class HapusPeminjamanTidakTerkonfirmasi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pinjam:hapusTidakTerkonfirmasi';

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
		PinjamBuku::where('confirm', 0)->delete();
    }
}

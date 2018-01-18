<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class testing implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$da
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
		$users = User::all();
		$data = [];

		foreach ($users as $user) {
			$data[] = $user->email;
		}
		return dd($data);
    }
}

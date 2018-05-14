<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use App\User;
use Mail;
use Log;

class uploadBelumLengkap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:lengkapi';

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
		$this->email();
    }

	private function email(){
		$tolong_lengkapi = $this->tolong_lengkapi();

		foreach ($tolong_lengkapi as $k=> $lengkap) {
			$data = [
				'lengkap' => $lengkap,
				'subject'  => 'Mengingatkan Upload Ilimiah - ' . ( $k + 1 ) . ' ' . date('d M Y')
			];
			Mail::send('emails.ingatkanUploadData', $data, function($message) use ($data){
				$message->from( 'admin@dvundip.com', 'Admin DV UNDIP' );
				$message->to($data['lengkap']['user']->email);
				$message->subject($data['subject']);
			});

		}
		$data = [
			'lengkap' => $tolong_lengkapi,
			'subject' => 'Terkirim mengingatkan'
		];

		Mail::send('emails.ingatkanUploadDataYoga', $data, function($message) use ($data){
			$message->from( 'admin@dvundip.com', 'Admin DV UNDIP' );
			$message->to('yoga.dvjul17@gmail.com');
			$message->subject($data['subject']);
		});
		Mail::send('emails.laporanUploadKurangDrIto', $data, function($message) use ($data){
			$message->from( 'admin@dvundip.com', 'Admin DV UNDIP' );
			$message->to('itobuwono@gmail.com');
			$message->subject($data['subject']);
		});
		
	}
	public function tolong_lengkapi(){

		$residens      = User::with('pembacaan')->whereIn('role_id', [1,3])->get();
		$belum_lengkap = [];
		foreach ($residens as $residen) {
			if (strpos(strtolower($residen->nama), 'dr.') !== true) {

				$pembacaans = $residen->pembacaan;
				// return pembacaan masing2 orang

				$belum_lengkap[$residen->id]['belum_diisi']      = 0;
				$belum_lengkap[$residen->id]['jumlah_pembacaan'] = $pembacaans->count();
				$belum_lengkap[$residen->id]['user']             = $residen;

				foreach ($pembacaans as $pembacaan) {
					// hitung jumlah pembacaan yang belum diisi
					if ( is_null($pembacaan->link_materi) && is_null($pembacaan->link_materi_terjemahan) ) {
						$belum_lengkap[$pembacaan->user_id]['belum_diisi']++;
					}
				}
			}
		}

		$tolong_lengkapi = [];
		foreach ($belum_lengkap as $belum) {
			if ($belum['jumlah_pembacaan'] < 6 || $belum['belum_diisi'] > 0) {
				$tolong_lengkapi[] = $belum;
			}
		}
		return $tolong_lengkapi;
	}
}

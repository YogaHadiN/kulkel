<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Log;
use File;
use Storage;
use Illuminate\Http\Request;
use App\Pembacaan;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UploadMateriToS3 implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	public $pembacaan;
	public $materi_id;
	public $terjemahan_id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Pembacaan $pembacaan ,$materi_id, $terjemahan_id)
    {

		$this->pembacaan     = $pembacaan;
		$this->materi_id     = $materi_id;
		$this->terjemahan_id = $terjemahan_id;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
		$filename_materi      = $this->materi_id;
		$filepath_materi      = storage_path() . '/uploads/' . $this->materi_id;
		$filename_terjemahan  = $this->terjemahan_id;
		$filepath_terjemahan  = storage_path() . '/uploads/' . $this->terjemahan_id;
		$nama_file_materi     = 'users/' . $this->pembacaan->user_id . '/pembacaan/materi/' . $filename_materi;
		$nama_file_terjemahan = 'users/' . $this->pembacaan->user_id . '/pembacaan/terjemahan/' . $filename_terjemahan;
		if ( Storage::disk('s3')->put( $nama_file_materi, fopen($filepath_materi, 'r+'), 'public') ) {
			File::delete($filepath_materi);

			$this->pembacaan->nama_file_materi = $nama_file_materi;
			$this->pembacaan->link_materi = Storage::cloud()->url($nama_file_materi);

		}
		if ( Storage::disk('s3')->put( $nama_file_terjemahan, fopen($filepath_terjemahan, 'r+'), 'public') ) {
			File::delete($filepath_terjemahan);

			$this->pembacaan->nama_file_materi_terjemahan = $nama_file_terjemahan;
			$this->pembacaan->link_materi_terjemahan = Storage::cloud()->url($nama_file_terjemahan);

		}
		$this->pembacaan->save();
    }

	private function uploadTerjemahan($request, $name, $seminar_id, $user_id){
		if($request->hasFile($name)) {
			//get filename with extension
			$filenamewithextension = $request->file($name)->getClientOriginalName();
			//get filename without extension
			$filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
			//get file extension
			$extension = $request->file($name)->getClientOriginalExtension();
			//filename to store
			$filenametostore = 'users/' . $user_id . '/pembacaan/terjemahan/' . $filename.'_'.time().'.'.$extension;

			//Upload File to s3
			Storage::disk('s3')->put($filenametostore, fopen($request->file($name), 'r+'), 'public');
			//Store $filenametostore in the database
			return [
				'file_name' => $filenametostore,
				'link' => Storage::cloud()->url($filenametostore)
			];
			
	    }
	}
}

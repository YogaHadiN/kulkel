<?php

namespace App\Jobs;

use App\Pembacaan;
use Storage;
use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UploadToS3 implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	public $pembacaan;
	public $request;
	public $materi_id;
	public $terjemahan_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Pembacaan $pembacaan, Request $request, $materi_id, $terjemahan_id)
    {
		$this->pembacaan      = $pembacaan;
		$this->request        = $request;
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
		$filename = 
		if ($this->$request->hasFile('materi')) {
			Storage::disk('s3')->delete( $this->$pembacaan->nama_file_materi );
			$saved_file                  = $this->uploadS3($request, 'materi', Input::get('seminar_id'), $pembacaan->user_id);
			$this->$pembacaan->link_materi      = $saved_file['link'];
			$this->$pembacaan->nama_file_materi = $saved_file['file_name'];
			$this->$pembacaan->save();
		}
		if ($this->$request->hasFile('terjemahan')) {
			Storage::disk('s3')->delete( $pembacaan->nama_file_materi_terjemahan );
			$saved_file                             = $this->uploadTerjemahan($request, 'terjemahan', Input::get('seminar_id'), $pembacaan->user_id);
			$this->$pembacaan->link_materi_terjemahan      = $saved_file['link'];
			$this->$pembacaan->nama_file_materi_terjemahan = $saved_file['file_name'];
			$this->$pembacaan->save();
		}
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

	private function uploadS3($request, $name, $seminar_id, $user_id){
		if($request->hasFile($name)) {
			//get filename with extension
			$filenamewithextension = $request->file($name)->getClientOriginalName();
			//get filename without extension
			$filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
			//get file extension
			$extension = $request->file($name)->getClientOriginalExtension();
			//filename to store
			$filenametostore = 'users/' . $user_id . '/pembacaan/materi/' . $filename.'_'.time().'.'.$extension;

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

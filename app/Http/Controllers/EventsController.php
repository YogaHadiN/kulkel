<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use Input;
use App\Yoga;
use DB;
use Image;
use Auth;
class EventsController extends Controller
{
	public function index(){
		$events = Event::all();
		return view('events.index', compact(
			'events'
		));
	}
	public function create(){
		return view('events.create');
	}
	public function edit($id){
		$event = Event::find($id);
		return view('events.edit', compact('event'));
	}
	public function store(Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		$event        = new Event;
		$event->body  = json_encode( explode(PHP_EOL, Input::get('body')) );
		$event->title = Input::get('title');
		$event->user_id = Auth::id();
		$event->save();
		$event->image = $this->imageUpload('event','image', $event->id);
		$event->save();

		$pesan = Yoga::suksesFlash('Event baru berhasil dibuat');
		return redirect('events')->withPesan($pesan);
	}
	public function update($id, Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		$event          = Event::find($id);
		$event->body    = Input::get('body');
		$event->title   = Input::get('title');
		$event->user_id = Auth::id();
		if (Input::hasFile('image')) {
			$event->image   = $this->imageUpload('event','image', $event->id);
		}
		$event->save();
		$pesan = Yoga::suksesFlash('Event berhasil diupdate');
		return redirect('events')->withPesan($pesan);
	}
	public function destroy($id){
		Event::destroy($id);
		$pesan = Yoga::suksesFlash('Event berhasil dihapus');
		return redirect('events')->withPesan($pesan);
	}
	public function import(){
		return 'Not Yet Handled';
		$file      = Input::file('file');
		$file_name = $file->getClientOriginalName();
		$file->move('files', $file_name);
		$results   = Excel::load('files/' . $file_name, function($reader){
			$reader->all();
		})->get();
		$events     = [];
		$timestamp = date('Y-m-d H:i:s');
		foreach ($results as $result) {
			$events[] = [
	
				// Do insert here
	
				'created_at' => $timestamp,
				'updated_at' => $timestamp
			];
		}
		Event::insert($events);
		$pesan = Yoga::suksesFlash('Import Data Berhasil');
		return redirect()->back()->withPesan($pesan);
	}
	private function valid( $data ){
		$messages = [
			'required' => ':attribute Harus Diisi',
		];
		$rules = [
			'body'           => 'required',
			'title'           => 'required'
		];
		$validator = \Validator::make($data, $rules, $messages);
		
		if ($validator->fails())
		{
			return \Redirect::back()->withErrors($validator)->withInput();
		}
	}	

	private function imageUpload($pre, $fieldName, $id){
		if(Input::hasFile($fieldName)) {
			$upload_cover = Input::file($fieldName);
			//mengambil extension
			$extension = $upload_cover->getClientOriginalExtension();

			$upload_cover = Image::make($upload_cover);
			$upload_cover->resize(1000, null, function ($constraint) {
				$constraint->aspectRatio();
				$constraint->upsize();
			});
			//membuat nama file random + extension
			$filename =	 $pre . $id . '.' . $extension;

			//menyimpan bpjs_image ke folder public/img
			$destination_path = public_path() . DIRECTORY_SEPARATOR . 'img/events';

			// Mengambil file yang di upload
			$upload_cover->save($destination_path . '/' . $filename);
			
			//mengisi field bpjs_image di book dengan filename yang baru dibuat
			return $filename;
			
		} else {
			return null;
		}
	}
}

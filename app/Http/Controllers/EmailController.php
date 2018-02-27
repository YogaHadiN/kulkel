<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Email;
use Input;
use App\Yoga;
use DB;
use Mail;
class EmailController extends Controller
{
	public function index(){
		return view('emails.email');
	}
	public function create(){
		return view('emails.create');
	}
	public function edit($id){
		$email = Email::find($id);
		return view('emails.edit', compact('email'));
	}
	public function store(Request $request){
		$messages = [
			'required' => ':attribute Harus Diisi',
		];
		$rules = [
			'email' => 'required|email',
			'subject' => 'required',
			'message' => 'required'
		];
		
		$validator = \Validator::make(Input::all(), $rules, $messages);
		
		if ($validator->fails())
		{
			return \Redirect::back()->withErrors($validator)->withInput();
		}

		$data = [
			'email'       => Input::get('email'),
			'subject'     => Input::get('subject'),
			'bodyMessage' => Input::get('message')
		];

		Mail::send('emails.formMail', $data, function($message) use ($data){
			$message->from( 'ppdsdvkontak@gmail.com', 'laravel2' );
			$message->to($data['email']);
			$message->subject($data['subject']);
		});
		
		return redirect()->back();
	}
	public function update($id, Request $request){
		if ($this->valid( Input::all() )) {
			return $this->valid( Input::all() );
		}
		$email     = Email::find($id);
		// Edit disini untuk simpan data
		$email->save();
		$pesan = Yoga::suksesFlash('Email berhasil diupdate');
		return redirect('emails')->withPesan($pesan);
	}
	public function destroy($id){
		Email::destroy($id);
		$pesan = Yoga::suksesFlash('Email berhasil dihapus');
		return redirect('emails')->withPesan($pesan);
	}
	public function import(){
		return 'Not Yet Handled';
		$file      = Input::file('file');
		$file_name = $file->getClientOriginalName();
		$file->move('files', $file_name);
		$results   = Excel::load('files/' . $file_name, function($reader){
			$reader->all();
		})->get();
		$emails     = [];
		$timestamp = date('Y-m-d H:i:s');
		foreach ($results as $result) {
			$emails[] = [
	
				// Do insert here
	
				'created_at' => $timestamp,
				'updated_at' => $timestamp
			];
		}
		Email::insert($emails);
		$pesan = Yoga::suksesFlash('Import Data Berhasil');
		return redirect()->back()->withPesan($pesan);
	}
	private function valid( $data ){
		$messages = [
			'required' => ':attribute Harus Diisi',
		];
		$rules = [
			'data'           => 'required',
		];
		$validator = \Validator::make($data, $rules, $messages);
		
		if ($validator->fails())
		{
			return \Redirect::back()->withErrors($validator)->withInput();
		}
	}
	
}

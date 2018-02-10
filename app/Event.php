<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
	public function user(){
		return $this->belongsTo('App\User');
	}
	public function getAuthorAttribute(){
		return $this->user->nama;
	}
	
	public function getBodyeditAttribute(){
		$body = $this->body;

		$body = json_decode($body, true);

		$temp = '';

		foreach ($body as $b) {
			$temp .= $b . PHP_EOL;
		}
		return $temp;
	}
	
	protected $dates = ['created_at'];
}

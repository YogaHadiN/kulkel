<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Twilio\Rest\Client;
use Twilio\Exceptions\Twilioexception;
use App\Yoga;
use App\Outbox;

class Sms extends Model
{
	public static function send($telepon, $message){
		// Script http API SMS Reguler Zenziva
		$userkey=env('ZENZIVA_USERKEY'); // userkey lihat di zenziva

		$passkey=env('ZENZIVA_PASSKEY'); // set passkey di zenziva

		$url = 'https://reguler.zenziva.net/apps/smsapi.php';$curlHandle = curl_init();

		curl_setopt($curlHandle, CURLOPT_URL, $url);

		curl_setopt($curlHandle, CURLOPT_POSTFIELDS, 'userkey='.$userkey.'&passkey='.$passkey.'&nohp='.$telepon.'&pesan='.urlencode($message));

		curl_setopt($curlHandle, CURLOPT_HEADER, 0);

		curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);

		curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);

		curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);

		curl_setopt($curlHandle, CURLOPT_TIMEOUT,30);

		curl_setopt($curlHandle, CURLOPT_POST, 1);

		$results = curl_exec($curlHandle);

		curl_close($curlHandle);
		return $results;
	}
}

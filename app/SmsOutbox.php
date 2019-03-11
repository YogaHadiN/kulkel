<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmsOutbox extends Model
{
	protected $table = 'sms_outbox';
}

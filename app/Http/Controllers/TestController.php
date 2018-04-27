<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\LogSomething;

class TestController extends Controller
{
	public function index(){
		return dd(strtotime(date('Y-m-d H:i:s')) < strtotime('2017-06-01 00:00:00'));
	}
	
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\LogSomething;

class TestController extends Controller
{
	public function index(){
		dispatch(new LogSomething);
		return 'oye';
	}
	
}

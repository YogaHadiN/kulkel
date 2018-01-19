<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AboutUs;
use App\Event;

class WelcomeController extends Controller
{
	public function index(){
		$about_us = AboutUs::latest()->first();
		$events   = Event::orderBy('id', 'desc')->take(3)->get();
		return view('welcome', compact(
			'about_us',
			'events'
		));
	}

	public function about(){
		return view('about');
	}
}

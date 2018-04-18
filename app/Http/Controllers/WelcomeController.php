<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AboutUs;
use App\Event;

class WelcomeController extends Controller
{

	public function __construct()
	{
		/* $this->middleware('adminOnly', ['only' => ['edit', 'create', 'delete', 'update', 'destroy']]); */
	}
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
	public function events(){
		$events = Event::orderBy('created_at', 'desc')->paginate(5);
		return view('events', compact('events'));
	}
	public function show($id){
		$event = Event::find($id);
		return view('event', compact(
			'event'
		));
	}
	
	
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use App\Yoga;

class LoginController extends Controller
{
/**
     * Handle an authentication attempt.
     *
     * @return Response
     */
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
	
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Yoga;

class adminOnly
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
		if ( Auth::user()->role_id != 3 ) {
			$pesan = Yoga::gagalFlash('Maaf hanya admin yang memiliki akses untuk perintah ini');
			return redirect()->back()->withPesan($pesan);
		}
        return $next($request);
    }
}

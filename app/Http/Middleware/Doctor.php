<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;

class Doctor
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure(Request): (Response | RedirectResponse)  $next
     * @return Response | RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user()->role->name === 'doctor') {
            return $next($request);
        } else {
            return redirect()->back();
        }
    }
}

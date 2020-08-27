<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckTrainer
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
        if (!(Auth::check() && in_array(Auth::user()->user_type, ['trainer', 'admin']))){
            return redirect()->route('welcome');
        }
        return $next($request);
    }
}

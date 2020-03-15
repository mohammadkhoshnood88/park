<?php

namespace App\Http\Middleware;

use Closure;

class CheckHasProfile
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
        $user = $request->user();

        if ($user && $user->profile == 0) {

            return redirect('/profile');
        }

        return $next($request);    }
}

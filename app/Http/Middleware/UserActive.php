<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserActive
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
        if ($user && $user->status == 0) {

            return redirect('/home')->with('error' , 'دسترسی شما توسط مدیر به حالت تعلیق درآمده است.');
        }
        elseif($user && $user->profile == 0) {

           return redirect('/profile');
        }
            return $next($request);


    }
}

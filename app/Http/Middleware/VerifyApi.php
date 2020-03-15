<?php

namespace App\Http\Middleware;

use Closure;

class VerifyApi
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
//        return $request;
        $verify_token = "K8vCaBPIhZLumw6R5I2ZDkhIdaCRMgmi0mtIUKmG2P2p6BrzIhVZOfOfVWoTlxnN";
        if ($request->header('verify_token') != $verify_token){
            return response()->json([
                'message' => 'Not a valid API request.',
            ]);
        }
        return $next($request);
    }
}

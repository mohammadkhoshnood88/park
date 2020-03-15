<?php

namespace App\Http\Middleware;

use Closure;
//use JWTAuth;
use Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\JWTAuth;

class VerifyToken
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
//        $user = \JWTAuth::parseToken()->authenticate();
//        return $user;
//        $headers = apache_request_headers(); //get header
//        $request->headers->set('token', $headers['token']);
//        return response()->json(\JWTAuth::parseToken()->authenticate());
                try {
//                    $headers = apache_request_headers(); //get header
//                    $request->headers->set('Authorization', $headers['authorization']);

            $user = \JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return response()->json(['status' => 'Token is Invalid']);
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return response()->json(['status' => 'Token is Expired']);
            }else{
                return response()->json(['status' => 'Authorization Token not found']);
            }
        }
        return $next($request);
    }
}

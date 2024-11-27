<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
class CheckAdminToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {


        $user = null;

        try {

            $user = JWTAuth::parseToken()->Authenticate();

        } catch(\Exception $e) {

            if($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {

                return response()->json(['success' => false, 'msg' => "invalid_token"]);
            } else if($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return response()->json(['success' => false, 'msg' => "expired_token"]);

            } else {
                return response()->json(['success' => false, 'msg' => "invalid_token"]);

            }


        }
        return $next($request);
    }
}

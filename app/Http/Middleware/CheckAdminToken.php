<?php

namespace App\Http\Middleware;

use App\Traits\GeneralTrait;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
class CheckAdminToken
{

    use GeneralTrait;
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

                return $this -> returnError('E3001' , 'invalid_token') ;  
            } else if($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return $this -> returnError('E3001' , 'expired_token') ;  

            } else {
                return $this -> returnError('E3001' , 'no_found_token') ;  

            }


        } catch(\Throwable $e) {

            if($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {

                return $this -> returnError('E3001' , 'invalid_token') ;  
            } else if($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return $this -> returnError('E3001' , 'expired_token') ;  

            } else {
                return $this -> returnError('E3001' , 'no_found_token') ;  

            }


        }

        if(!$user) 

        $this->returnError('E3001', trans ('unauthenticated'));
        
        return $next($request);
    }
}

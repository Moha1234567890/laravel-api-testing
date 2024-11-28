<?php

namespace App\Http\Controllers\Api\User;

use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;
use Validator;
use Auth;
class AuthUserController extends Controller
{
    
    use GeneralTrait;
    public function loginUser(Request $request) {


        try {


            $rules = [
                "email" => "required|exists:users,email",

                "password" => "required",

            ];
    
    
            $validator = Validator::make($request->all(), $rules);
    
    
            if($validator->fails()) {
    
                $code = $this->returnCodeAccordingToInput($validator);
    
                return $this->returnValidationError($code, $validator);
        
            }


            $cred = $request->only(['email', 'password']);

            

            $token = Auth::guard('user-api')->attempt($cred);

            if(!$token) {
                return $this->returnError('401', 'error loggin');
            } else {

                $user = Auth::guard('user-api')->user();
                $user->token_api = $token;
                return $this->returnData('user', $user);

            }



        } catch(\Exception $e) {

            return $this->returnError($e->getCode(), $e->getMessage());
        }

       




        //return "test";
       
    }


    // public function logoutAdmin(Request $request) {


    //    $token = $request->header('auth-token');
    //     ///return $token;
    //    if($token) {

    //     try {
    //         //invalidate or kill token
    //         JWTAuth::setToken($token)->invalidate();

            
    //     } catch(\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) { 

    //         return $this->returnError('401', 'smth went wrong');

    //     }
    //     return $this->returnSuccessMessage('200', 'admin logged out successfully');



    //    } else {

    //         return $this->returnError('401', 'smth went wrong');
    //    }
       
    // }




    
}

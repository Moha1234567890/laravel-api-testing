<?php

namespace App\Http\Controllers\Api\Admin;

use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;
use Validator;
use Auth;
class AuthController extends Controller
{
    
    use GeneralTrait;
    public function loginAdmin(Request $request) {


        try {


            $rules = [
                "email" => "required|exists:admins,email",

                "password" => "required",

            ];
    
    
            $validator = Validator::make($request->all(), $rules);
    
    
            if($validator->fails()) {
    
                $code = $this->returnCodeAccordingToInput($validator);
    
                return $this->returnValidationError($code, $validator);
        
            }


            $cred = $request->only(['email', 'password']);

            

            $token = Auth::guard('admin-api')->attempt($cred);

            if(!$token) {
                return $this->returnError('401', 'error loggin');
            } else {

                $admin = Auth::guard('admin-api')->user();
                $admin->token_api = $token;
                return $this->returnData('admin', $admin);

            }



        } catch(\Exception $e) {

            return $this->returnError($e->getCode(), $e->getMessage());
        }

       
       
    }


    public function logoutAdmin(Request $request) {


       $token = $request->header('auth-token');
        ///return $token;
       if($token) {

        try {
            //invalidate or kill token
            JWTAuth::setToken($token)->invalidate();

            
        } catch(\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) { 

            return $this->returnError('401', 'smth went wrong');

        }
        return $this->returnSuccessMessage('200', 'admin logged out successfully');



       } else {

            return $this->returnError('401', 'smth went wrong');
       }
       
    }




    
}

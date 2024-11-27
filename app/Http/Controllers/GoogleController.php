<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Auth;
use App\Models\User;


class GoogleController extends Controller
{
    

    public function authGoogle() {
        return Socialite::driver('google')->redirect();
    }


    public function authGoogleRedirect() {
        
        $user = Socialite::driver('google')->user();

        $findUser = User::where('google_id', $user->id)->first();

        if($findUser) {

            Auth::login($findUser);
            //return redirect()->intended('home');
        } else {


            $user = User::updateOrCreate([
                'email' => $user->email,
            ], [
                'name' => $user->name,
                'google_id' => $user->id,
                'password' => encrypt('12345678'),
                
            ]);

            Auth::login($user);

        }

        return redirect()->intended('home');

    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Mail;
use App\Mail\EmailMailable;
class Emailcontroller extends Controller
{
    

    public function send() {

        $email = new EmailMailable();
        Mail::to("moha1234566044@gmail.com")->send($email);
    }
}

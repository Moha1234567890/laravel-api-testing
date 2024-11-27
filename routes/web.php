<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Post;

use App\Helpers\DateHelper;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {

//     $user = User::create([
//         "name" => "user name" . rand(1000, 999),
//         "email" => "em" . rand(100, 999) . '@gmail.com',
//         "password" =>  rand(100000, 99999999) ,
//     ])->image()->create([
//         "url" => "images/url" . rand(110, 99999) . 'png'
//     ]);



//     $post = Post::create([
//         "title" => "post with title" . rand(1000, 999),
       
//     ])->image()->create([
//         "url" => "images/url" . rand(110, 99999) . 'png'
//     ]);


//     dd(Post::first()->image->toArray());



// });


// Route::get('/helpers', function () {

//     $data = DateHelper::date('20-9-2024');

//     return dd($data);

// });


Route::get('/', [App\Http\Controllers\HomeController::class, 'welcome']);
Route::get('auth/google', [App\Http\Controllers\GoogleController::class, 'authGoogle'])->name('auth.google');
Route::get('auth/google/callback', [App\Http\Controllers\GoogleController::class, 'authGoogleRedirect'])->name('auth.google.redirect');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//paypal

Route::post('/paypal', [App\Http\Controllers\PaypalController::class, 'performPayment'])->name('paypal');
Route::get('/success', [App\Http\Controllers\PaypalController::class, 'success'])->name('success');
Route::get('/cancel', [App\Http\Controllers\PaypalController::class, 'cancel'])->name('cancel');





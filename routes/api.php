<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\Emailcontroller;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Api\Admin\AuthController;
use App\Http\Controllers\Api\User\AuthUserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group(['middleware' => ['api', 'check.lang'], 'namespace' => 'Api'], function() {

    Route::get('/get-cats', [CategoriesController::class, 'getCats']);
    Route::post('/get-cats-lang', [CategoriesController::class, 'getCatsLang']);

    //getting one category
    Route::post('/get-one-cat', [CategoriesController::class, 'getSingelCat']);

    //change status of category
    Route::post('/change-cat-status', [CategoriesController::class, 'changeCategoryStatus']);


    Route::post('/send-email', [Emailcontroller::class, 'send']);
    Route::post('/new-product', [PostsController::class, 'createNewProduct']);


    Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function() {


        Route::post('/login', [AuthController::class, 'loginAdmin']);
        Route::post('/logout', [AuthController::class, 'logoutAdmin'])->middleware('auth.guard:admin-api');

    });


    Route::group(['prefix' => 'user', 'namespace' => 'User'], function() {


        Route::post('/login-user', [AuthUserController::class, 'loginUser']);

    });


    Route::group(['prefix' => 'user', 'middleware' => 'auth.guard:user-api'], function() {


        Route::post('/profile', function() {

            return "only authed users are allowed";
        });

    });

   

});

Route::group(['middleware' => ['api', 'check.lang', 'check.admin.token:admin-api'], 'namespace' => 'Api'], function() {

    Route::get('/get-cats', [CategoriesController::class, 'getCats']);

});



 ///excel
 Route::get('/export-excel', [PostsController::class, 'export']);
 Route::post('/import-excel', [PostsController::class, 'import']);


 //third party api
 Route::get('/get-api', [PostsController::class, 'getData']);


 //service container
 Route::post('/sc-create-new-posts', [PostsController::class, 'createNewPost']);
 Route::post('/sc-update-posts/{id}', [PostsController::class, 'updatePost']);
 Route::get('/sc-delete-posts/{id}', [PostsController::class, 'deleteMyPost']);


 
/** 
 * 5-checking password for protection
 * 6-working with langauges 

*/



///testing api resources
Route::get(  '/users', [UserController::class, 'index']);
Route::get( '/user/{id}', [UserController::class, 'getUser']);


Route::get( '/posts', [PostsController::class, 'index']);
Route::get( '/post/{id}', [PostsController::class, 'getPost']);

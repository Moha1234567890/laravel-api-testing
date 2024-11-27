<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserCollection;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;
class UserController extends Controller
{
    

    /*
    
    collecton for more than one recored unlike make
    we can use "resource" or JsonResource to use the resource and return data



    
    
    */
    public function index() {


        $res = User::query()
            ->with('posts')
            ->withCount(relations: 'posts')
            ->paginate(10);


      
        /** this is for return the UserCollection which is basically
         * the same as return new UserCollection($res);
         */

        //return new UserCollection($res);
      

        return UserResource::collection($res);
        ///additional is used to add more arrays like "new_keys"    


    //    return UserResource::collection($res)->additional([
    //         "new_keys" => [
    //             "data1" => 1,
    //             "data2" => 2,
    //             "data3" => 3,
    //             "data4" => 4,
    //         ]]);



    }


    public function getUser($id) {

        $res = User::query()
            ->with('posts.user')
   //        ->withCount('posts')

            ->findOrFail($id);
        return UserResource::make($res);

    }


    


}

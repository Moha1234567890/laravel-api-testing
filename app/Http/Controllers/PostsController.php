<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
class PostsController extends Controller
{
    public function index() {
        return Post::query()->paginate(5)->toJson();
    }


    public function getPost($id) {


        return Post::query()->findOrFail($id);

    }
}

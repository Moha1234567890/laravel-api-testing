<?php

namespace App\Http\Controllers\Api;

use App\Events\NewproductMail;
use App\Exports\PostsExport;
use App\Imports\PostsImport;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Traits\GeneralTrait;
use Event;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Support\Facades\Http;
use App\Services\PostsService;
class PostsController extends Controller
{
    

    use GeneralTrait;
   
    public $postsService;


    public function __construct(PostsService $postsService) {

        $this->postsService = $postsService;
    }

    public function index() {

        return $this->postsService->allPosts();
    }

    public function createNewPost() {

        $res = $this->postsService->createPost(request()->all());

        return response($res);
    }

    public function updatePost(Request $request, $id) {

        $data['title'] = request('title'); 
        $res = $this->postsService->updatePost($id, $data);

        return response($res);
    }



    public function deleteMyPost($id) {

        
        $this->postsService->deletePost($id);

        return response("post deleted");
    }

    
    public function createNewProduct(Request $request) {

        $product = Post::create([
            "title" => "new title"
        ]);


        Event::dispatch(new NewproductMail($product));

        return $product;
       
    }


    public function export() {

        return Excel::download(new PostsExport(), "file.xlsx");
    }



    
    public function import(Request $request) {

        $file =  $request->file('file');
        return Excel::import(new PostsImport(), $file);

        //return $file;
    }




    public function getData() {

        $response = Http::get('https://jsonplaceholder.typicode.com/posts');

        return response($response->json());
    }

    
    
    
}

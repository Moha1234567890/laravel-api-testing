<?php


namespace App\Services;
use App\Models\Post;

class PostsService {


    public function allPosts() {

        return Post::all();
    }


    public function getPost(int $id) {
        return Post::find($id);
    }


    public function createPost($data) {
        return Post::create($data);
    }


    public function updatePost($id, $data) {

        $post = $this->getPost($id);

        $post->title = $data['title'];
        $post->save();

        return $post;
    }



   


    public function deletePost($id) {

        $post = $this->getPost($id);

        $post->delete();
    }
}
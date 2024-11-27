<?php

namespace App\Exports;

use App\Models\Post;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;

class PostsExport implements FromArray
{
    
    public function array() : array
    {
        //return Post::all();

        $list = [];
        $posts = Post::all();

        foreach($posts as $post) {

            $list[] = [$post->title, $post->created_at, $post->updated_at];

        }


        return $list;

    }
}

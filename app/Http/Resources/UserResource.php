<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;
class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        //return dd($this->resource);

        // $data = parent::toArray($request);
        // $data['created_at'] = Carbon::parse($this->created_at)->toDateTimeString();

        // return $data;

        
        return [
            'id' => $this->id,
            'name' => $this->name,
            "full_name" => $this->when($this->id === 10, function() {
                return "this 10th user";
            }),
            'email' => $this->email,
            'password' => $this->password,
            'created_at' => Carbon::parse($this->created_at)->toDateTimeString(),
            'updated_at' => $this->updated_at,
            'posts' => PostResource::collection($this->whenLoaded('posts')),
          ///  'is_loaded' => PostResource::collection($this->relationLoaded('user')),
            'posts_count' =>  $this->whenCounted('posts', $this->posts_count)
        ];
        //return parent::toArray($request);


        /**
         * 
         * we can also create another resource like "PostResource" and use inside another 
         * resource like in this file and customize "PostResource" as we like
         * and we do that to controll the data even further 
         * 
         * 
         * you can do conditions whth the closure function above and count the number of returned 
         * values if needed from relatioship with "whenCounted" method
         */
    }
}

<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $data = parent::toArray($request);

        $data['created_at'] = Carbon::parse($this->created_at)->toDateTimeString();

        if($this->relationLoaded('user')) {
          $data['is_loaded'] = true;

        }

       // $data['is_loaded'] = true;
        return $data;
       // return parent::toArray($request);
    }
}

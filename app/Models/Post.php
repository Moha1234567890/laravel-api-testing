<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Image;
class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        "title"
    ];


    public function image() {

        return $this->morphMany(Image::class, 'imageable');
    }


    public function user() {

        return $this->belongsTo(User::class);
    }
}

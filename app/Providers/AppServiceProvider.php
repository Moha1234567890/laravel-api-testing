<?php

namespace App\Providers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;
use App\Models\Post;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Relation::enforceMorphMap([
            "posts" => Post::class,
            "user" => User::class
        ]);


        /**
         * this line is used to flat data in single array in linke in 
         * "getUser" method when we try and get the data 
         * but it does not when we try with "index" because it returns
         * more than one result
         * 
         */
        
       // JsonResource::withoutWrapping();
    }
}

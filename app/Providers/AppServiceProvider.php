<?php

namespace App\Providers;

use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $tagObject = new TagController;
        $tagList = $tagObject->fetchTag();
        View::share(['tagList' => $tagList]);
    }
}

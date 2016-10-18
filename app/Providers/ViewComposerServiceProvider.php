<?php

namespace App\Providers;

use App\PHPAustralia\Docs;
use App\Tag;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        // Using Closure based composers...
        View::composer('layouts.footer', function ($view) {
            $view->docs = Docs::all();
        });

        View::composer('jobs.create', function ($view) {
            $view->tags = Tag::all();
        });

        View::composer('jobs.edit', function ($view) {
            $view->tags = Tag::all();
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

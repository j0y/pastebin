<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use \App\Snippet;
use Illuminate\Support\Facades\Auth;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('layouts.app', function($view){
           $view->with('publicSnippets', Snippet::latest()->public()->take(10)->get());
           if (Auth::check()) {
               $view->with('mySnippets', Auth::user()->snippets()->latest()->take(10)->get());
           }
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
<?php

namespace App\Providers;

use App\Brand;
use App\Category;
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
        $brands = Brand::select('id', 'url', 'name')->where('status', 1)->get();
        $categories = Category::select('id', 'url', 'name')->where('status', 1)->get();
        View::share([
            'brands' => $brands,
            'categories' => $categories
        ]);
    }
}

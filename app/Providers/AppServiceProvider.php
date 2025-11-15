<?php

namespace App\Providers;

use App\Models\Category as ProductCategory;
use App\Models\Product;
use App\Models\Sanphamphu;
use App\Models\Seeding;
use App\Models\SppCategory;
use App\Models\User;
use Firefly\FilamentBlog\Models\Category;
use Firefly\FilamentBlog\Models\Post;
use Firefly\FilamentBlog\Models\Setting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        View::share('setting', Setting::first());
        // View::share('categories', Category::all());
        // View::share('sppCategories', SppCategory::all());
        // View::share('products', Product::all());
        // View::share('posts', Post::all());
        View::share('seedings', Seeding::all());
        View::share('users', User::all());
        // View::share('product_categories', ProductCategory::all());

    }
}

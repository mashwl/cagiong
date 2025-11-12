<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use App\Models\Seeding;
use Firefly\FilamentBlog\Models\Post;
use Firefly\FilamentBlog\Models\Setting;
use GuzzleHttp\Promise\Create;
use Livewire\Component;

class Home extends Component
{


    public function render()
{   $posts=Post::all();
    $seedings=Seeding::all();
    $setting=Setting::first();
    $category = Category::withCount('products')
        ->orderBy('products_count', 'desc')
        ->first();

    $products = Product::whereHas('categories', function ($query) use ($category) {
        $query->where('categories.id', optional($category)->id);
    })
    ->orderByDesc('published_at')
    ->take(8)
    ->get();

    return view('livewire.home', [
        'products' => $products,
        'category' => $category,
        'seedings' => $seedings,
        'posts' => $posts,
        'setting' => $setting,

    ]);
}
}

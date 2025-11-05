<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use GuzzleHttp\Promise\Create;
use Livewire\Component;

class Home extends Component
{
    // public function render()
    // {
    //     return view('livewire.home');
    // }

    public function render()
{
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
        'category' => $category, // để truyền ra view

    ]);
}
}

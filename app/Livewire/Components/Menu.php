<?php

namespace App\Livewire\Components;

use App\Models\Category as ModelsCategory;
use App\Models\Product;
use Firefly\FilamentBlog\Models\Category;
use Firefly\FilamentBlog\Models\Setting;
use Livewire\Component;

class Menu extends Component
{
     public function render()
    {
        $setting = Setting::first();
        $categories = Category::all();
        $product_categories = ModelsCategory::with('products')->get();
        $products = Product::all();

        return view('livewire.components.menu', [
            'setting' => $setting,
            'categories' => $categories,
            'product_categories' => $product_categories,
            'products' => $products,
        ]);
    }
}

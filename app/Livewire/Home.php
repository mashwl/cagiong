<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\FeaturedProduct;
use App\Models\Product;
use App\Models\Seeding;
use Firefly\FilamentBlog\Models\Post;
use Firefly\FilamentBlog\Models\Setting;
use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        $posts = Post::all();
        $seedings = Seeding::all();
        $setting = Setting::first();
 

        // Lấy featured product, eager load categories cho products & sanphamphu
        $featured = FeaturedProduct::with([
            'products.categories',       // sản phẩm chính
            'sanphamphu.danhmuc'        // sản phẩm phụ
        ])->first();
        if (!$featured) {
            $featured = new FeaturedProduct();
            $featured->setRelation('products', collect());
        }
 

        return view('livewire.home', [
            'seedings' => $seedings,
            'posts' => $posts,
            'setting' => $setting,
            'featured' => $featured,
        ]);
    }
}

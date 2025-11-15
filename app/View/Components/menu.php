<?php

namespace App\View\Components;

use App\Models\Category;
use App\Models\Product;
use App\Models\Sanphamphu;
use App\Models\SppCategory;
use Closure;
use Firefly\FilamentBlog\Models\Category as ModelsCategory;
use Firefly\FilamentBlog\Models\Setting;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class menu extends Component
{
    public $product_categories;
    public $categories;
    public $sppCategories;
    public $products;
    public $sanphamphus;
    public function __construct()
    {
        $this->product_categories = Category::all();
        $this->sppCategories = SppCategory::all();
        $this->products = Product::all();
        $this->categories = ModelsCategory::all();
        $this->sanphamphus = Sanphamphu::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.menu', [
            'product_categories' => $this->product_categories,
            'sppCategories' => $this->sppCategories,
            'products' => $this->products,
            'categories' => $this->categories,
        ]);
    }
}

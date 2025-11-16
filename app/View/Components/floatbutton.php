<?php

namespace App\View\Components;

use App\Models\Product;
use Closure;
use Firefly\FilamentBlog\Models\Setting;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class floatbutton extends Component
{
    public $products;
    public $settings;

    public function __construct()
    {
        $this->products = Product::all();
        $this->settings = Setting::first();

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.floatbutton', [
            'products' => $this->products,
            'settings' => $this->settings,
            'quickLinks' => $this->settings->quick_links ?? [],
        ]);
    }
}

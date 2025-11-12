<?php

namespace App\View\Components;

use App\Models\Product;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class floatbutton extends Component
{
    public $products;

    public function __construct()
    {
        $this->products = Product::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.floatbutton', [
            'products' => $this->products,
        ]);
    }
}

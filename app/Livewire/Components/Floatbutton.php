<?php

namespace App\Livewire\Components;

use App\Models\Product;
use Livewire\Component;

class Floatbutton extends Component
{
    public $products;

    public function mount()
    {
        $this->products = Product::all();
    }

    public function render()
    
    {
        return view('livewire.components.floatbutton', [
            'products' => $this->products,
        ]);
    }
}

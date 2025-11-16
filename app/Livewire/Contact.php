<?php

namespace App\Livewire;

use App\Models\Product;
use Firefly\FilamentBlog\Facades\SEOMeta;
use Firefly\FilamentBlog\Models\Setting;
use Livewire\Component;

class Contact extends Component
{    public $setting;
    
    public function mount()
    {
        $this->setting = Setting::first();
      
    }

    public function render()
    {
        SEOMeta::setTitle('Liên Hệ');

        $phone = $this->setting?->phone;
        $formattedPhone = preg_replace('/^0/', '+84 ', $phone);
        $formattedPhone = preg_replace('/(\d{3})(\d{3})(\d+)/', '$1 $2 $3', $formattedPhone);
        $products = Product::all();
        return view('livewire.contact', compact('products', 'formattedPhone'));
    }
}

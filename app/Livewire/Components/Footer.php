<?php

namespace App\Livewire\Components;

use Firefly\FilamentBlog\Models\Category;
use Firefly\FilamentBlog\Models\Setting;
use Livewire\Component;

class Footer extends Component
{
    public function render()
    {
        $setting = Setting::first();
        $categories = Category::all();
        return view('livewire.components.footer', [
            'setting' => $setting,
            'categories' => $categories,
        ]);
    }
}

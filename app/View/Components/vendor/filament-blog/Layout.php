<?php

namespace Firefly\FilamentBlog\Components;

use Firefly\FilamentBlog\Models\Setting;
use Illuminate\View\Component;

class Layout extends Component
{
    public function render()
    {
        $setting = Setting::first();
        $categories = \Firefly\FilamentBlog\Models\Category::all();
        return view('components.layouts.app', ['setting' => $setting, 'categories' => $categories]);
    }
}

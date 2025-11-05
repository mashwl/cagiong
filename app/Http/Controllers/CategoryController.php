<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Firefly\FilamentBlog\Facades\SEOMeta;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function posts(Request $request, Category $category)
    {
        SEOMeta::setTitle($category?->name ?? 'Trang Chủ');

        $products = $category->load(['products.user', 'products.categories'])
            ->products()
            ->published()
            ->paginate(25);

        return view('filament-blog::products.category-product', [
            'products' => $products,
            'category' => $category,
        ]);
    }
}

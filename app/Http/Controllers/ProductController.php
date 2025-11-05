<?php

namespace App\Http\Controllers;

use App\Models\Product ;
use Firefly\FilamentBlog\Facades\SEOMeta;
use Firefly\FilamentBlog\Models\NewsLetter;
use Firefly\FilamentBlog\Models\ShareSnippet;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Category;

class ProductController extends Controller
{
    public function allProducts()
    {
        SEOMeta::setTitle('Tất cả sản phẩm | '.config('app.name')) ;

        $products = Product::query()->with(['categories', 'user'])
            ->published()
            ->paginate(20);

        return view('livewire.product-page', [
            'products' => $products,
        ]);
    }

    public function search(Request $request)
    {
        SEOMeta::setTitle('Kết quả tìm kiếm cho "'.$request->get('query').'"');

        $request->validate([
            'query' => 'required',
        ]);
        $searchedProducts = Product::query()
            ->with(['categories', 'user'])
            ->published()
            ->whereAny(['title', 'sub_title'], 'like', '%'.$request->get('query').'%')
            ->paginate(10)->withQueryString();

        return view('filament-blog::products.search', [
            'products' => $searchedProducts,
            'searchMessage' => 'Kết quả tìm kiếm cho "'.$request->get('query').'"',
        ]);
    }

    public function show(Category $category, Product $product)
    {
        if (!$product->categories->contains('id', $category->id)) {
            abort(404);
        }
        SEOMeta::setTitle(($product->seoDetail?->title ?? $product->title));

        SEOMeta::setDescription($product->seoDetail?->description);

        SEOMeta::setKeywords($product->seoDetail->keywords ?? []);

        $shareButton = ShareSnippet::query()->active()->first();
        // $product->load(['user', 'categories' => fn ($query) => $query->approved(), 'comments.user']);

        return view('filament-blog::products.show', [
            'product' => $product,
            'category' => $category,
            'shareButton' => $shareButton,
        ]);
    }


}

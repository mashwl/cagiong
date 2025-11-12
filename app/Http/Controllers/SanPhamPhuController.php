<?php

namespace App\Http\Controllers;

use App\Models\Sanphamphu as ModelsSanphamphu;
use App\Models\SppCategory;
use Firefly\FilamentBlog\Facades\SEOMeta;
use Firefly\FilamentBlog\Models\ShareSnippet;
use Illuminate\Http\Request;

class SanPhamPhuController extends Controller
{
    public function allProducts()
    {
        SEOMeta::setTitle('Tất cả sản phẩm | '.config('app.name')) ;

        $sanphamphus = ModelsSanphamphu::query()->with(['spp_categories', 'user'])
            ->published()
            ->paginate(20);
        return view('Sanphamphu.all-products', [
            'sanphamphus' => $sanphamphus,
        ]);
    }

    public function search(Request $request)
    {
        SEOMeta::setTitle('Kết quả tìm kiếm cho "'.$request->get('query').'"');

        $request->validate([
            'query' => 'required',
        ]);
        $searchedProducts = ModelsSanphamphu::query()
            ->with(['spp_categories', 'user'])
            ->published()
            ->whereAny('title', 'like', '%'.$request->get('query').'%')
            ->paginate(10)->withQueryString();

        return view('Sanphamphu.search', [
            'sanphamphus' => $searchedProducts,
            'searchMessage' => 'Kết quả tìm kiếm cho "'.$request->get('query').'"',
        ]);
    }

    public function show(SppCategory $sppCategory, ModelsSanphamphu $sanphamphu)
    {
        if (!$sanphamphu->danhmuc->contains('id', $sppCategory->id)) {
            abort(404);
        }
        SEOMeta::setTitle(($sanphamphu->seoDetail?->title ?? $sanphamphu->title));

        SEOMeta::setDescription($sanphamphu->seoDetail?->description);

        SEOMeta::setKeywords($sanphamphu->seoDetail->keywords ?? []);

        $shareButton = ShareSnippet::query()->active()->first();
        // $sanphamphu->load(['user', 'categories' => fn ($query) => $query->approved(), 'comments.user']);

        return view('Sanphamphu.show', [
            'sanphamphu' => $sanphamphu,
            'sppCategory' => $sppCategory,
            'shareButton' => $shareButton,
        ]);
    }


}

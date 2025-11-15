<?php

namespace App\Http\Controllers;

use App\Models\Sanphamphu;
use App\Models\SppCategory;
use Firefly\FilamentBlog\Facades\SEOMeta;
use Illuminate\Http\Request;

class SanPhamPhuCategory extends Controller
{
    public function posts(Request $request, SppCategory $sppCategory)
    {
        SEOMeta::setTitle($sppCategory?->name ?? 'Trang Chủ');

        $sanphamphus = $sppCategory->load(['sanphamphus.user', 'sanphamphus.danhmuc'])
            ->sanphamphus()
            ->paginate(25);
            $sanphamphus = $sppCategory->sanphamphus()->paginate(25);


        return view('Sanphamphu.category-product', [
            'sanphamphus' => $sanphamphus,
            'sppCategory' => $sppCategory,
        ]);
    }
    public function search(Request $request)
    {
        SEOMeta::setTitle('Kết quả tìm kiếm cho "'.$request->get('query').'"');

        $request->validate([
            'query' => 'required',
        ]);
        $searchedSanphamphus = Sanphamphu::query()
            ->with(['spp_categories', 'user'])
            ->published()
            ->whereAny(['title', 'sub_title'], 'like', '%'.$request->get('query').'%')
            ->paginate(10)->withQueryString();

        return view('Sanphamphu.search', [
            'sanphamphus' => $searchedSanphamphus,
            'searchMessage' => 'Kết quả tìm kiếm cho "'.$request->get('query').'"',
        ]);
    }
}

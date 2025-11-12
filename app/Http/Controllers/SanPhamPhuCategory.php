<?php

namespace App\Http\Controllers;

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
}

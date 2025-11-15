<?php

namespace App\Http\Controllers;

use App\Models\Sanphamphu as ModelsSanphamphu;
use App\Models\SppCategory;
use Firefly\FilamentBlog\Facades\SEOMeta;
use Firefly\FilamentBlog\Models\ShareSnippet;
use Illuminate\Http\Request;

class SanPhamPhuController extends Controller
{

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

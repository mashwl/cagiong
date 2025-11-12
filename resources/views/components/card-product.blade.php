@props(['product', 'type' => 'product'])

@php
    // Lấy slug danh mục phù hợp
    $categorySlug = 'khong-xac-dinh';
    if ($type === 'product' && $product->categories) {
        $categorySlug = optional($product->categories->first())->slug ?? 'khong-xac-dinh';
    } elseif ($type === 'spp' && $product->danhmuc) {
        $categorySlug = optional($product->danhmuc->first())->slug ?? 'khong-xac-dinh';
    }

    // Xác định route hiển thị chi tiết
    $link =
        $type === 'product'
            ? route('product.show', [
                'category' => $categorySlug,
                'product' => $product->slug,
            ])
            : route('spp.show', [
                'sppCategory' => $categorySlug,
                'sanphamphu' => $product->slug,
            ]);

    // Ảnh đại diện
    $mainImage =
        $type === 'product'
            ? optional($product->images->first())->image_path
            : optional($product->hinhanhs->first())->image_path;

    // Giá sản phẩm
    $price = $product->price ?? null;
    $priceMin = $product->price_min ?? null;
    $priceMax = $product->price_max ?? null;
@endphp

<a href="{{ $link }}">
    <div class="group/blog-item flex flex-col items-center gap-y-4">
        {{-- Ảnh sản phẩm --}}
        <div class="relative h-[220px] sm:h-[250px] w-full rounded-xl bg-zinc-200 overflow-hidden shadow-md">
            @if ($mainImage)
                <img class="h-full w-full object-cover object-top transition-transform duration-700 ease-out group-hover/blog-item:scale-105"
                    src="{{ asset('storage/' . $mainImage) }}" alt="{{ $product->photo_alt_text ?? $product->title }}">
            @else
                <div class="h-full w-full bg-gray-300 flex items-center justify-center text-gray-500">
                    Không có hình ảnh
                </div>
            @endif

            {{-- Hiệu ứng tráng gương --}}
            <div
                class="absolute inset-0 before:absolute before:top-0 before:left-[-75%] before:w-[50%] before:h-full before:bg-gradient-to-r before:from-transparent before:via-white/60 before:to-transparent before:skew-x-[-25deg] before:transition-all before:duration-700 group-hover/blog-item:before:left-[125%]">
            </div>
        </div>

        {{-- Tên sản phẩm --}}
        <div class="px-2 text-center">
            <h2 title="{{ $product->title }}"
                class="mb-2 line-clamp-2 text-lg sm:text-xl font-semibold text-gray-800 transition-colors duration-300 group-hover/blog-item:text-primary-700">
                {{ $product->title }}
            </h2>
            <span class="text-secondary-600 text-lg sm:text-xl font-bold">
                @if ($priceMin && $priceMax)
                    {{ number_format($priceMin, 0, ',', '.') }}đ -
                    {{ number_format($priceMax, 0, ',', '.') }}đ
                @elseif($price)
                    {{ number_format($price, 0, ',', '.') }}đ
                @else
                    <span class="text-gray-500 text-base font-normal">đang cập nhật</span>
                @endif
            </span>
        </div>
    </div>
</a>

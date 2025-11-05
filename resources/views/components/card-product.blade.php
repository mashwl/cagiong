@props(['product'])

<a
    href="{{ route('product.show', [
        'category' => $product->categories->first()?->slug ?? 'khong-xac-dinh',
        'product' => $product->slug,
    ]) }}">
    @php
        // Lấy ảnh đầu tiên trong danh sách ảnh (ảnh đại diện)
        $mainImage = $product->images->first()?->image_path;
    @endphp
    <div class="group/blog-item flex flex-col items-center gap-y-4">
        {{-- Ảnh sản phẩm với hiệu ứng tráng gương --}}
        <div class="relative h-[220px] sm:h-[250px] w-full rounded-xl bg-zinc-200 overflow-hidden shadow-md">
            <img class="h-full w-full object-cover object-top transition-transform duration-700 ease-out group-hover/blog-item:scale-105"
                src="{{ asset('storage/' . $mainImage) }}" alt="{{ $product->photo_alt_text }}">

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
                @if (!empty($product->price_min) && !empty($product->price_max))
                    {{ number_format($product->price_min, 0, ',', '.') }}đ -
                    {{ number_format($product->price_max, 0, ',', '.') }}đ
                @elseif(!empty($product->price))
                    {{ number_format($product->price, 0, ',', '.') }}đ
                @else
                    <span class="text-gray-500 text-base font-normal">đang cập nhật</span>
                @endif
            </span>
        </div>
    </div>
</a>

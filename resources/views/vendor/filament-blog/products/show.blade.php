<x-blog-layout>
    @php
        $phone = $setting?->phone;
        // Thay 0 đầu thành +84 và thêm dấu cách mỗi 3 số cho đẹp
        $formattedPhone = preg_replace('/^0/', '+84 ', $phone);
        $formattedPhone = preg_replace('/(\d{3})(\d{3})(\d+)/', '$1 $2 $3', $formattedPhone);
    @endphp
    <style>
        [x-cloak] {
            display: none !important;
        }

        body {
            transition: opacity .2s ease-in-out;
        }

        body.fade-out {
            opacity: 0;
        }

        /* Mobile gallery swipe cảm ứng */
        @media (max-width: 640px) {
            .gallery-scroll {
                display: flex;
                overflow-x: auto;
                gap: 0.5rem;
                scroll-snap-type: x mandatory;
            }

            .gallery-scroll img {
                scroll-snap-align: center;
            }
        }
    </style>
    <section x-data="{ tab: 'info', openOrderForm: false, mainImage: '{{ $product->images->first()->image_path ?? '' }}' }" class="pb-16" x-cloak>
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">

            @if (session('success'))
                <div
                    class="max-w-2xl mx-auto mb-6 bg-green-100 text-green-800 px-4 py-3 rounded-lg text-center font-semibold">
                    {{ session('success') }}
                </div>
            @endif

            <nav class="mb-6 sm:mb-10 flex flex-wrap items-center gap-1 text-sm font-medium text-gray-600">
                <a href="{{ url('/') }}" class="hover:text-primary-600">Trang chủ</a>
                <span class="opacity-30">/</span>
                <a href="{{ route('category.show', ['category' => $category->slug]) }}" class="hover:text-primary-600">
                    {{ $category->name }}
                </a>
                <span class="opacity-30">/</span>
                <span class="text-primary-600 line-clamp-1">{{ $product->title }}</span>
            </nav>

            {{-- 🧱 Layout 2 cột --}}
            <div class="grid lg:grid-cols-2 gap-8 md:gap-10 items-start">

                {{-- 🎨 Hình ảnh sản phẩm --}}
                <div x-data="{ mainImage: '{{ $product->sorted_images->first()?->image_path }}' }" class="space-y-3">
                    @if ($product->sorted_images->count())
                        {{-- Ảnh chính --}}
                        <div class="relative overflow-hidden rounded-2xl shadow-md">
                            <img :src="'/storage/' + mainImage"
                                alt="{{ $product->sorted_images->first()->photo_alt_text ?? $product->title }}"
                                class="w-full h-72 sm:h-96 md:h-[500px] object-cover rounded-2xl transition-all duration-300"
                                x-transition>
                        </div>

                        {{-- Danh sách tất cả ảnh (ảnh đại diện lên đầu) --}}
                        <div class="flex flex-wrap justify-center sm:justify-start gap-2 sm:gap-3">
                            @foreach ($product->sorted_images as $img)
                                <img src="{{ asset('storage/' . $img->image_path) }}"
                                    alt="{{ $img->photo_alt_text ?? $product->title }}"
                                    class="w-16 h-16 sm:w-20 sm:h-20 rounded-xl border border-gray-200 object-cover cursor-pointer hover:ring-2 hover:ring-primary-500 transition-all"
                                    @click="mainImage = '{{ $img->image_path }}'">
                            @endforeach
                        </div>
                    @else
                        <div class="text-gray-400 text-center border rounded-lg p-10">
                            Chưa có hình ảnh sản phẩm
                        </div>
                    @endif
                </div>



                {{-- 📋 Thông tin sản phẩm --}}
                <div class="space-y-4 sm:space-y-6">
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 leading-tight">{{ $product->title }}</h1>

                    {{-- Danh sách thông số --}}
                    <ul class="divide-y divide-gray-100 text-sm sm:text-base text-gray-700">
                        <li class="py-2"><span class="font-semibold">Mã sản phẩm:</span>
                            {{ $product->code ?? 'Đang cập nhật...' }}</li>
                        <li class="py-2"><span class="font-semibold">Tên giống:</span>
                            {{ $product->name ?? 'Đang cập nhật...' }}</li>
                        <li class="py-2"><span class="font-semibold">Mô hình nuôi:</span>
                            {{ $product->mohinhnuoi ?? 'Đang cập nhật...' }}</li>
                        <li class="py-2"><span class="font-semibold">Thức ăn:</span>
                            {{ $product->thucan ?? 'Đang cập nhật...' }}</li>
                        <li class="py-2"><span class="font-semibold">Độ khó nuôi:</span>
                            {{ $product->dokhonuoi ?? 'Đang cập nhật...' }}</li>
                        <li class="py-2"><span class="font-semibold">Giá trị kinh tế:</span>
                            {{ $product->giatrikinhte ?? 'Đang cập nhật...' }}</li>
                        <li class="py-2"><span class="font-semibold">Thời gian nuôi:</span>
                            {{ $product->thoigiannuoi ?? 'Đang cập nhật...' }}</li>
                        <li class="py-2"><span class="font-semibold">Phù hợp với:</span>
                            {{ $product->phuhop ?? 'Đang cập nhật...' }}</li>
                    </ul>

                    {{-- 💰 Giá bán --}}
                    <p class="text-lg font-semibold mt-4">
                        Giá:
                        <span class="text-primary-600 text-xl font-bold">
                            @if (!empty($product->price_min) && !empty($product->price_max))
                                {{ number_format($product->price_min, 0, ',', '.') }}đ -
                                {{ number_format($product->price_max, 0, ',', '.') }}đ
                            @elseif(!empty($product->price))
                                {{ number_format($product->price, 0, ',', '.') }}đ
                            @else
                                <span class="text-gray-500 text-base font-normal">đang cập nhật</span>
                            @endif
                        </span>
                    </p>

                    {{-- 🛒 Nút hành động --}}
                    <div class="flex flex-wrap gap-3 mt-6">
                        <button @click="openOrderForm = true"
                            class="bg-primary-600 hover:bg-primary-700 text-white px-5 py-2.5 sm:px-6 sm:py-3 rounded-xl font-semibold shadow transition text-sm sm:text-base w-full sm:w-auto">
                            🛒 Đặt hàng ngay
                        </button>
                        <a href="tel:{{ $formattedPhone }}"
                            class="bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2.5 sm:px-6 sm:py-3 rounded-xl font-semibold shadow transition text-sm sm:text-base w-full sm:w-auto text-center">
                            ☎ Gọi {{ $formattedPhone }}
                        </a>
                    </div>

                    {{-- 🏷️ Danh mục --}}
                    {{-- <div class="flex flex-wrap gap-2 mt-4 sm:mt-6">
                        @foreach ($product->categories as $category)
                            <a href="{{ route('category.show', ['category' => $category->slug]) }}"
                                class="inline-block bg-primary-50 text-primary-700 rounded-full px-3 py-1 text-xs sm:text-sm font-semibold hover:bg-primary-100 transition">
                                {{ $category->name }}
                            </a>
                        @endforeach
                    </div> --}}
                </div>
            </div>

            {{-- 📦 Form đặt hàng --}}
            <x-dathang :product="$product" />

            {{-- 📑 Tab mô tả, hướng dẫn, liên hệ --}}
            <x-tab :product="$product" :formattedPhone="$formattedPhone" />

        </div>
    </section>



    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('a[href]').forEach(a => {
                a.addEventListener('click', e => {
                    const url = a.getAttribute('href');
                    if (url && !url.startsWith('#') && !url.startsWith('javascript:') && !a
                        .hasAttribute('target')) {
                        document.body.classList.add('fade-out');
                    }
                });
            });
        });
        window.addEventListener('pageshow', () => document.body.classList.remove('fade-out'));
    </script>

    {!! $shareButton?->script_code !!}
</x-blog-layout>

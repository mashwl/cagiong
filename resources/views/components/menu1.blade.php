@php
    $phone = $setting?->phone;
    // Thay 0 đầu thành +84 và thêm dấu cách mỗi 3 số cho đẹp
    $formattedPhone = preg_replace('/^0/', '+84 ', $phone);
    $formattedPhone = preg_replace('/(\d{3})(\d{3})(\d+)/', '$1 $2 $3', $formattedPhone);
@endphp

<header x-data="{ open: false }" x-cloak class="sticky top-0 z-50 bg-white shadow flex-none">
    <div class="max-w-7xl mx-auto flex items-center justify-between px-4 py-3">
        <a href="{{ route('home') }}" class="flex-shrink-0">
            <img src="{{ asset('storage/' . $setting?->logo) }}" alt="Logo" class="h-20 w-auto">
        </a>

        <!-- Search form -->
        <form action="{{ route('filamentblog.post.search') }}" method="GET"
            class="flex items-center flex-1 max-w-md bg-white border border-gray-300 rounded-full px-3 py-1 shadow-sm mx-4">

            <input type="text" name="query"
                class="flex-1 text-sm text-gray-700 placeholder-gray-400 bg-transparent pl-2 py-2 rounded-full 
                 focus:outline-none border-none"
                placeholder="Tìm kiếm nội dung...">

            <button type="submit"
                class="flex items-center justify-center bg-cyan-700 hover:bg-cyan-800 text-white rounded-full w-9 h-9 ml-1 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 21l-5.2-5.2m0 0a7 7 0 10-9.9 0 7 7 0 009.9 0z" />
                </svg>
            </button>
        </form>


        <!-- Hotline -->
        <div
            class="hidden md:flex items-center space-x-2 border border-gray-300 rounded-full px-4 py-2 bg-white shadow-sm whitespace-nowrap text-sm md:text-base">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 md:h-6 md:w-6 text-cyan-800" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M2 8.82V5a2 2 0 012-2h3.82a1 1 0 01.95.68l1.26 3.79a1 1 0 01-.27 1.04L8.91 10.09a11.05 11.05 0 005 5l1.58-1.58a1 1 0 011.04-.27l3.79 1.26a1 1 0 01.68.95V21a2 2 0 01-2 2h-3.82a2 2 0 01-1.99-1.72A15.97 15.97 0 012 8.82z" />
            </svg>
            <span class="font-semibold text-cyan-800">Hotline: {{ $formattedPhone }}</span>
        </div>

        <!-- Đặt hàng nhanh -->
        {{-- <div x-data="{ openOrder: false, showSuccessModal: false }" x-cloak class="hidden md:block relative mx-3">
            <button @click="openOrder = true"
                class="bg-red-600 text-white font-semibold rounded-full px-5 py-2 md:px-6 md:py-2.5 shadow hover:bg-red-700 transition-colors text-sm md:text-base whitespace-nowrap">
                ĐẶT HÀNG NHANH
            </button>

            <!-- POPUP FORM ĐẶT HÀNG -->
            <div x-show="openOrder"
                class="fixed inset-0 z-[100] flex items-center justify-center bg-black/50 backdrop-blur-sm"
                x-transition.opacity>

                <div @click.away="openOrder = false"
                    class="bg-white rounded-2xl shadow-2xl w-full max-w-3xl max-h-[90vh] overflow-y-auto p-8 relative"
                    x-transition.scale>
                    <!-- Nút đóng -->
                    <button @click="openOrder = false"
                        class="absolute top-3 right-3 text-gray-400 hover:text-gray-700 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                    <h2 class="text-2xl font-bold text-center text-cyan-800 mb-1">🐟 Đặt Hàng Nhanh</h2>
                    <p class="text-gray-600 text-center mb-6 text-sm">
                        Vui lòng nhập thông tin để chúng tôi liên hệ xác nhận đơn hàng.
                    </p>

                    <form action="{{ route('order.submit') }}" method="POST" class="space-y-4"
                        x-on:submit.prevent="
                            fetch($el.action, {
                                method: 'POST',
                                body: new FormData($el),
                                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
                            }).then(res => {
                                if(res.ok) {
                                    openOrder = false;
                                    showSuccessModal = true;
                                    $el.reset();
                                }
                            })
                        ">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold mb-1 text-gray-700">Họ và tên <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="name" required
                                    class="w-full rounded-lg border border-gray-300 bg-gray-50 focus:bg-white focus:border-cyan-600 focus:ring-2 focus:ring-cyan-100 py-2.5 px-3 placeholder-gray-400 transition">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold mb-1 text-gray-700">Số điện thoại (Zalo) <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="phone" required
                                    class="w-full rounded-lg border border-gray-300 bg-gray-50 focus:bg-white focus:border-cyan-600 focus:ring-2 focus:ring-cyan-100 py-2.5 px-3 placeholder-gray-400 transition">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold mb-1 text-gray-700">Email (nếu có)</label>
                                <input type="email" name="email"
                                    class="w-full rounded-lg border border-gray-300 bg-gray-50 focus:bg-white focus:border-cyan-600 focus:ring-2 focus:ring-cyan-100 py-2.5 px-3 placeholder-gray-400 transition">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold mb-1 text-gray-700">Tên cá giống muốn mua
                                    <span class="text-red-500">*</span></label>
                                <select name="product_name" required
                                    class="w-full rounded-lg border border-gray-300 bg-gray-50 focus:bg-white focus:border-cyan-600 focus:ring-2 focus:ring-cyan-100 py-2.5 px-3 text-gray-700 transition">
                                    <option value="">-- Chọn loại cá giống --</option>
                                    @foreach ($products as $item)
                                        <option value="{{ $item->title }}">{{ $item->title }}</option>
                                    @endforeach
                                    <option value="Khác">🔹 Loại khác (ghi chú ở địa chỉ)</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold mb-1 text-gray-700">Số lượng</label>
                                <input type="number" name="quantity" min="1" value="1"
                                    class="w-full rounded-lg border border-gray-300 bg-gray-50 focus:bg-white focus:border-cyan-600 focus:ring-2 focus:ring-cyan-100 py-2.5 px-3 text-center transition">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold mb-1 text-gray-700">Địa chỉ giao hàng</label>
                                <textarea name="address" rows="2"
                                    class="w-full rounded-lg border border-gray-300 bg-gray-50 focus:bg-white focus:border-cyan-600 focus:ring-2 focus:ring-cyan-100 py-2.5 px-3 placeholder-gray-400 transition"></textarea>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 pt-1">
                            <input type="checkbox" name="subscribe" value="1" id="subscribe"
                                class="rounded border-gray-300 text-cyan-600 focus:ring-cyan-500">
                            <label for="subscribe" class="text-sm text-gray-700 select-none">
                                Tôi muốn nhận bản tin khuyến mãi & sản phẩm mới
                            </label>
                        </div>
                        <div class="pt-2">
                            <button type="submit"
                                class="w-full bg-cyan-600 hover:bg-cyan-700 text-white py-3 rounded-xl font-semibold shadow transition">
                                GỬI ĐƠN ĐẶT HÀNG
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- POPUP THÀNH CÔNG -->
            <div x-show="showSuccessModal"
                class="fixed inset-0 z-[200] flex items-center justify-center bg-black/50 backdrop-blur-sm"
                x-transition.opacity x-cloak>
                <div class="bg-white rounded-2xl p-8 w-full max-w-md text-center shadow-lg" x-transition.scale>
                    <h2 class="text-2xl font-bold text-green-600 mb-2">🎉 Đặt hàng thành công!</h2>
                    <p class="text-gray-700 mb-6">Cảm ơn bạn! Chúng tôi sẽ liên hệ xác nhận đơn hàng trong thời gian
                        sớm nhất.</p>
                    <button @click="showSuccessModal = false"
                        class="bg-cyan-600 hover:bg-cyan-700 text-white px-6 py-2 rounded-lg font-semibold transition">
                        Đóng
                    </button>
                </div>
            </div>
        </div> --}}
    </div>

    <!-- Navigation -->
    <nav class="bg-gradient-to-r from-cyan-900 to-teal-700 text-white text-sm font-semibold uppercase tracking-wide">
        <div class="max-w-7xl mx-auto px-4">
            <ul class="hidden lg:flex items-center justify-end py-2 space-x-7">
                <li><a wire:navigate href="{{ route('home') }}" class="hover:text-yellow-300 transition">Trang
                        chủ</a></li>

                {{-- ====================== SẢN PHẨM CÁ GIỐNG ====================== --}}
                <li x-data="{ open: false, activeCategory: 0, loaded: {} }" class="relative group flex-shrink-0"
                    @mouseenter="
                     open = true;
                    if (!loaded[0]) loaded[0] = true;
                 "
                    @mouseleave="open = false" x-cloak>

                    <button class="flex items-center uppercase font-semibold hover:text-yellow-300 transition">
                        cá giống
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="ml-1 w-4 h-4 transition duration-200 group-hover:text-yellow-300" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    {{-- === Mega Menu === --}}
                    <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-2"
                        class="absolute left-1/2 top-full mt-3 w-[900px] -translate-x-1/2 bg-white text-gray-800 rounded-xl shadow-xl border border-gray-200 z-50 overflow-hidden"
                        @mouseenter="open = true" @mouseleave="open = false">

                        <div class="flex flex-col md:flex-row">
                            {{-- ==== DANH MỤC BÊN TRÁI ==== --}}
                            <ul
                                class="w-full md:w-60 bg-gray-50 p-3 border-b md:border-b-0 md:border-r border-gray-200">
                                @foreach ($product_categories as $index => $category)
                                    <li>
                                        <a href="{{ route('category.show', ['category' => $category->slug]) }}"
                                            @mouseenter="
                        activeCategory = {{ $index }};
                        if (!loaded[{{ $index }}]) loaded[{{ $index }}] = true;
                    "
                                            class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-gradient-to-r hover:from-teal-600 hover:to-cyan-600 hover:text-white transition"
                                            :class="activeCategory === {{ $index }} ?
                                                'bg-gradient-to-r from-teal-600 to-cyan-600 text-white shadow-sm' :
                                                ''">
                                            {{ $category->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>

                            {{-- ==== DANH SÁCH SẢN PHẨM ==== --}}
                            <div class="flex-1 p-4 bg-white">
                                @foreach ($product_categories as $index => $category)
                                    <div x-show="loaded[{{ $index }}]" x-cloak
                                        :class="activeCategory === {{ $index }} ? 'block' : 'hidden'"
                                        x-transition:enter="transition ease-out duration-200"
                                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                        x-transition:leave="transition ease-in duration-100"
                                        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                        class="space-y-8">

                                        {{-- Lưới sản phẩm --}}
                                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 sm:gap-4 md:gap-3">
                                            @forelse ($category->products->take(4) as $product)
                                                <a href="{{ route('product.show', ['category' => $category->slug, 'product' => $product->slug]) }}"
                                                    class="group block bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-500 border border-gray-100 hover:border-teal-200 hover:-translate-y-1">
                                                    @php
                                                        $mainImage =
                                                            $product->images->first()?->image_path ??
                                                            'images/default.jpg';
                                                    @endphp
                                                    <div class="relative h-36 sm:h-32 overflow-hidden">
                                                        <img src="{{ asset('storage/' . $mainImage) }}"
                                                            alt="{{ $product->title }}"
                                                            class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-110 group-hover:brightness-105">
                                                        <div
                                                            class="absolute inset-0 bg-gradient-to-t from-black/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                                        </div>
                                                    </div>
                                                    <div class="p-1 text-center">
                                                        <h3
                                                            class="text-sm sm:text-base font-semibold text-gray-800 line-clamp-2 group-hover:text-teal-700 transition-colors">
                                                            {{ $product->title }}
                                                        </h3>
                                                    </div>
                                                </a>
                                            @empty
                                                <p class="text-gray-500 col-span-full text-center">Chưa có sản phẩm
                                                </p>
                                            @endforelse
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </li>
                {{-- ====================== SẢN PHẨM PHỤ ====================== --}}
                <li x-data="{ open: false, activeCategory: 0, loaded: {} }" class="relative group flex-shrink-0"
                    @mouseenter="
                    open = true;
                    if (!loaded[0]) loaded[0] = true;
                "
                    @mouseleave="open = false" x-cloak>

                    {{-- Nút chính --}}
                    <button class="flex items-center uppercase font-semibold hover:text-yellow-300 transition">
                        phụ kiện chăn nuôi
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="ml-1 w-4 h-4 transition duration-200 group-hover:text-yellow-300" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    {{-- === Mega Menu === --}}
                    <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-2"
                        class="absolute left-1/3 top-full mt-3 max-w-[95vw] w-[900px] -translate-x-1/2 bg-white text-gray-800 rounded-xl shadow-xl border border-gray-200 z-50 overflow-hidden"
                        @mouseenter="open = true" @mouseleave="open = false">

                        <div class="flex flex-col md:flex-row">
                            {{-- ==== DANH MỤC BÊN TRÁI ==== --}}
                            <ul
                                class="w-full md:w-60 bg-gray-50 p-3 border-b md:border-b-0 md:border-r border-gray-200 overflow-y-auto max-h-[70vh]">
                                @foreach ($sppCategories as $index => $sppCategory)
                                    <li>
                                        {{-- Khi hover đổi danh mục, khi click đi đến trang danh mục --}}
                                        <a href="{{ route('sppcategory.show', ['sppCategory' => $sppCategory->slug]) }}"
                                            @mouseenter="
                        activeCategory = {{ $index }};
                        if (!loaded[{{ $index }}]) loaded[{{ $index }}] = true;
                    "
                                            class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-gradient-to-r hover:from-teal-600 hover:to-cyan-600 hover:text-white transition"
                                            :class="activeCategory === {{ $index }} ?
                                                'bg-gradient-to-r from-teal-600 to-cyan-600 text-white shadow-sm' :
                                                ''">
                                            {{ $sppCategory->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>

                            {{-- ==== DANH SÁCH SẢN PHẨM ==== --}}
                            <div class="flex-1 p-4 bg-white overflow-y-auto max-h-[70vh]">
                                @foreach ($sppCategories as $index => $sppCategory)
                                    <div x-show="loaded[{{ $index }}]" x-cloak
                                        :class="activeCategory === {{ $index }} ? 'block' : 'hidden'"
                                        x-transition:enter="transition ease-out duration-200"
                                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                        x-transition:leave="transition ease-in duration-100"
                                        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                        class="space-y-8">

                                        {{-- Lưới sản phẩm --}}
                                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 sm:gap-4 md:gap-3">
                                            @forelse ($sppCategory->sanphamphus->take(4) as $spp)
                                                <a href="{{ route('spp.show', ['sppCategory' => $sppCategory->slug, 'sanphamphu' => $spp->slug]) }}"
                                                    class="group block bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-500 border border-gray-100 hover:border-teal-200 hover:-translate-y-1">
                                                    @php
                                                        $mainImage =
                                                            $spp->hinhanhs->first()?->image_path ??
                                                            'images/default.jpg';
                                                    @endphp
                                                    <div class="relative h-36 sm:h-32 overflow-hidden">
                                                        <img src="{{ asset('storage/' . $mainImage) }}"
                                                            alt="{{ $spp->title }}"
                                                            class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-110 group-hover:brightness-105">
                                                        <div
                                                            class="absolute inset-0 bg-gradient-to-t from-black/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                                        </div>
                                                    </div>
                                                    <div class="p-1 text-center">
                                                        <h3
                                                            class="text-sm sm:text-base font-semibold text-gray-800 line-clamp-2 group-hover:text-teal-700 transition-colors">
                                                            {{ $spp->title }}
                                                        </h3>
                                                    </div>
                                                </a>
                                            @empty
                                                <p class="text-gray-500 col-span-full text-center">Chưa có sản phẩm
                                                </p>
                                            @endforelse
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </li>

                {{-- ====================== KỸ THUẬT NUÔI ====================== --}}
                <li x-data="{ open: false }" class="relative group" x-cloak @mouseenter="open = true"
                    @mouseleave="open = false">

                    {{-- Nút chính --}}
                    <button class="flex items-center uppercase font-semibold hover:text-yellow-300 transition">
                        Kỹ thuật nuôi
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="ml-1 w-4 h-4 transition-colors duration-200 group-hover:text-yellow-300"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    {{-- Menu thả xuống --}}
                    <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-2"
                        class="absolute left-1/2 -translate-x-1/2 mt-2 bg-white border border-gray-200 
                rounded-2xl shadow-lg overflow-hidden z-50 min-w-max max-w-[95vw]">

                        @foreach ($categories as $category)
                            <a href="{{ route('filamentblog.category.post', ['category' => $category->slug]) }}"
                                class="block px-5 py-2.5 text-sm text-gray-700 font-medium capitalize transition-all duration-200 
              hover:bg-gradient-to-r hover:from-teal-500 hover:to-cyan-600 hover:text-white rounded-lg mx-2 mt-1 whitespace-nowrap">
                                {{ $category->name }}
                            </a>
                        @endforeach
                    </div>
                </li>
                {{-- ====================== MỤC KHÁC ====================== --}}
                <li><a href="{{ route('contact') }}" class="hover:text-yellow-300 transition">Liên hệ</a></li>
            </ul>

            {{-- ====================== MENU MOBILE ====================== --}}
            <div x-data="{ open: false }" class="lg:hidden" x-cloak>
                <button @click="open = !open" class="flex items-center justify-between w-full py-3 font-semibold">
                    <span>MENU</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>

                <div x-show="open" x-cloak x-transition class="py-3 space-y-2 bg-cyan-900 rounded-b-lg">
                    <a href="/" class="block px-4 py-2 hover:bg-cyan-800 rounded">Trang chủ</a>

                    {{-- Sản phẩm cá giống --}}
                    <div x-data="{ openSub: false }" class="px-4" x-cloak>
                        <button @click="openSub = !openSub"
                            class="flex justify-between uppercase w-full py-2 hover:bg-cyan-800 rounded">
                            <span> cá giống</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mt-1" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="openSub" x-transition class="pl-4 space-y-1" x-cloak>
                            @foreach ($product_categories as $category)
                                <a href="{{ route('category.show', ['category' => $category->slug]) }}"
                                    class="block py-1 text-sm text-gray-100 hover:text-yellow-300">
                                    {{ $category->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                    {{-- Sản phẩm phụ --}}
                    <div x-data="{ openSpp: false }" class="px-4" x-cloak>
                        <button @click="openSpp = !openSpp"
                            class="flex justify-between uppercase w-full py-2 hover:bg-cyan-800 rounded">
                            <span>Phụ Kiện Chăn Nuôi</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mt-1" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="openSpp" x-transition class="pl-4 space-y-1" x-cloak>
                            @foreach ($sppCategories as $sppCategory)
                                <a href="{{ route('sppcategory.show', ['sppCategory' => $sppCategory->slug]) }}"
                                    class="block py-1 text-sm text-gray-100 hover:text-yellow-300">
                                    {{ $sppCategory->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                    {{-- kỹ thuật nuôi --}}
                    <div x-data="{ openTech: false }" class="px-4" x-cloak>
                        <button @click="openTech = !openTech"
                            class="flex justify-between uppercase w-full py-2 hover:bg-cyan-800 rounded">
                            <span>Kỹ thuật nuôi</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mt-1" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="openTech" x-transition class="pl-4 space-y-1" x-cloak>
                            @foreach ($categories as $category)
                                <a href="{{ route('filamentblog.category.post', ['category' => $category->slug]) }}"
                                    class="block py-1 text-sm text-gray-100 hover:text-yellow-300">
                                    {{ $category->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <a href="{{ route('contact') }}" class="block px-4 py-2 hover:bg-cyan-800 rounded">Liên hệ</a>
                </div>
            </div>

        </div>
    </nav>
</header>

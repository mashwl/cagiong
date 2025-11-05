<div>
    @php
        $phone = $setting?->phone;
        $formattedPhone = preg_replace('/^0/', '+84 ', $phone);
        $formattedPhone = preg_replace('/(\d{3})(\d{3})(\d+)/', '$1 $2 $3', $formattedPhone);
    @endphp

    <header x-data="{ open: false }" x-cloak class="sticky top-0 z-50 bg-white shadow">
        {{-- === HEADER CHÍNH === --}}
        <div class="max-w-7xl mx-auto flex items-center justify-between px-4 py-3">
            <a href="/" class="flex-shrink-0">
                <img src="{{ asset('storage/' . $setting?->logo) }}" alt="Logo" class="h-20 w-auto">
            </a>

            <span
                class="text-xl bg-clip-text text-transparent bg-gradient-to-r from-green-400 via-yellow-300 to-pink-500">
                {{ $setting?->description }}
            </span>

            {{-- === FORM TÌM KIẾM === --}}
            <form wire:navigate action="{{ route('filamentblog.post.search') }}" method="GET"
                class="hidden md:flex items-center flex-1 max-w-md bg-white border border-gray-300 rounded-full px-4 py-1 shadow-sm mx-4">
                <input type="text" name="query" placeholder="Nhập tên loại cá cần tìm ?"
                    class="flex-1 text-sm text-gray-700 placeholder-gray-400 focus:outline-none py-2">
                <button type="submit"
                    class="flex items-center justify-center bg-cyan-700 hover:bg-cyan-800 text-white rounded-full w-8 h-8 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-5.2-5.2m0 0a7 7 0 10-9.9 0 7 7 0 009.9 0z" />
                    </svg>
                </button>
            </form>

            {{-- === HOTLINE === --}}
            <div
                class="hidden md:flex items-center space-x-2 border border-gray-300 rounded-full px-4 py-2 bg-white shadow-sm whitespace-nowrap text-sm md:text-base">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 md:h-6 md:w-6 text-cyan-800" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2 8.82V5a2 2 0 012-2h3.82a1 1 0 01.95.68l1.26 3.79a1 1 0 01-.27 1.04L8.91 10.09a11.05 11.05 0 005 5l1.58-1.58a1 1 0 011.04-.27l3.79 1.26a1 1 0 01.68.95V21a2 2 0 01-2 2h-3.82a2 2 0 01-1.99-1.72A15.97 15.97 0 012 8.82z" />
                </svg>
                <span class="font-semibold text-cyan-800">Hotline: {{ $formattedPhone }}</span>
            </div>

            {{-- === NÚT ĐẶT HÀNG NHANH === --}}
            <div x-data="{ openOrder: false, success: false }" x-cloak class="hidden md:block relative mx-3">
                <button @click="openOrder = true"
                    class="bg-red-600 text-white font-semibold rounded-full px-5 py-2 md:px-6 md:py-2.5 shadow hover:bg-red-700 transition-colors text-sm md:text-base whitespace-nowrap">
                    ĐẶT HÀNG NHANH
                </button>

                {{-- === MODAL FORM === --}}
                <div x-show="openOrder" x-cloak
                    class="fixed inset-0 z-[100] flex items-center justify-center bg-black/50 backdrop-blur-sm"
                    x-transition.opacity>
                    <div @click.away="openOrder = false"
                        class="bg-white rounded-2xl shadow-2xl w-full max-w-3xl max-h-[90vh] overflow-y-auto p-8 relative"
                        x-transition.scale>

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

                        <div x-show="success" x-transition x-cloak
                            class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-5 text-center">
                            🎉 Cảm ơn bạn! Đơn hàng đã được gửi thành công.
                        </div>

                        {{-- === FORM GỬI ĐƠN === --}}
                        <form action="{{ route('order.submit') }}" method="POST" class="space-y-4"
                            x-on:submit.prevent="
                            fetch($el.action, {
                                method: 'POST',
                                body: new FormData($el),
                                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
                            }).then(res => {
                                if(res.ok) {
                                    success = true;
                                    setTimeout(() => {
                                        openOrder = false;
                                        success = false;
                                        $el.reset();
                                    }, 10000);
                                }
                            })
                        ">
                            @csrf

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-semibold mb-1 text-gray-700">
                                        Họ và tên <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="name" required
                                        class="w-full rounded-lg border border-gray-300 bg-gray-50 focus:bg-white focus:border-cyan-600 focus:ring-2 focus:ring-cyan-100 py-2.5 px-3 placeholder-gray-400 transition"
                                        placeholder="Nhập họ tên của bạn">
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold mb-1 text-gray-700">
                                        Số điện thoại (Zalo) <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="phone" required
                                        class="w-full rounded-lg border border-gray-300 bg-gray-50 focus:bg-white focus:border-cyan-600 focus:ring-2 focus:ring-cyan-100 py-2.5 px-3 placeholder-gray-400 transition"
                                        placeholder="Ví dụ: 0987 654 321">
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold mb-1 text-gray-700">Email (nếu có)</label>
                                    <input type="email" name="email"
                                        class="w-full rounded-lg border border-gray-300 bg-gray-50 focus:bg-white focus:border-cyan-600 focus:ring-2 focus:ring-cyan-100 py-2.5 px-3 placeholder-gray-400 transition"
                                        placeholder="example@gmail.com">
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold mb-1 text-gray-700">
                                        Tên cá giống muốn mua <span class="text-red-500">*</span>
                                    </label>
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
                                    <label class="block text-sm font-semibold mb-1 text-gray-700">Địa chỉ giao
                                        hàng</label>
                                    <textarea name="address" rows="2"
                                        class="w-full rounded-lg border border-gray-300 bg-gray-50 focus:bg-white focus:border-cyan-600 focus:ring-2 focus:ring-cyan-100 py-2.5 px-3 placeholder-gray-400 transition"
                                        placeholder="Nhập địa chỉ nhận hàng hoặc tỉnh/thành phố"></textarea>
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
            </div>
        </div>

        {{-- === THANH MENU CHÍNH === --}}
<div class="sticky top-0 z-50" wire:ignore>
    <nav class="bg-gradient-to-r from-cyan-900 to-teal-700 shadow-md">
        <div class="container mx-auto px-4">
            <ul class="flex items-center justify-center md:justify-between gap-6 py-3 text-sm md:text-base font-semibold text-white uppercase">

                {{-- Trang chủ --}}
                <li>
                    <a href="{{ route('home') }}" class="hover:text-yellow-300 transition">Trang chủ</a>
                </li>

                {{-- Giới thiệu --}}
                <li>
                    <a href="{{ url('/gioi-thieu') }}" class="hover:text-yellow-300 transition">Giới thiệu</a>
                </li>

                {{-- ====================== SẢN PHẨM CÁ GIỐNG (MEGAMENU) ====================== --}}
                <li x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false"
                    class="relative group">
                    <button
                        class="flex items-center hover:text-yellow-300 transition focus:outline-none focus:text-yellow-300">
                        Sản phẩm cá giống
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    {{-- Megamenu --}}
                    <div x-show="open" x-transition
                        class="absolute left-0 top-full w-screen md:w-auto bg-white text-gray-800 shadow-2xl rounded-b-xl mt-1 border-t border-teal-600 z-50">
                        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6 p-6 md:p-8">

                            {{-- Cột 1: Danh mục sản phẩm --}}
                            <div>
                                <h3 class="text-teal-700 font-bold mb-3 uppercase text-sm">Danh mục sản phẩm</h3>
                                <ul class="space-y-2 text-sm">
                                    <li>
                                        <a href="{{ route('product.all') }}"
                                            class="block px-3 py-2 rounded-md hover:bg-teal-50 hover:text-teal-700 transition">
                                            Tất cả sản phẩm
                                        </a>
                                    </li>
                                    @foreach ($product_categories as $category)
                                        <li>
                                            <a href="{{ route('category.show', $category->slug) }}"
                                                class="block px-3 py-2 rounded-md hover:bg-teal-50 hover:text-teal-700 transition">
                                                {{ $category->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            {{-- Cột 2: Sản phẩm nổi bật --}}
                            <div>
                                <h3 class="text-teal-700 font-bold mb-3 uppercase text-sm">Sản phẩm nổi bật</h3>
                                <div class="grid grid-cols-2 gap-3">
                                    @foreach ($featured_products ?? [] as $prod)
                                        <a href="{{ route('product.show', [
                                                'category' => $prod->categories->first()?->slug ?? 'khac',
                                                'product' => $prod->slug,
                                            ]) }}"
                                            class="block group">
                                            <div
                                                class="h-24 w-full rounded-lg overflow-hidden bg-gray-100 shadow-sm mb-1">
                                                <img src="{{ asset('storage/' . $prod->image_path) }}"
                                                    alt="{{ $prod->title }}"
                                                    class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-500">
                                            </div>
                                            <p
                                                class="text-xs font-medium text-gray-700 group-hover:text-teal-700 line-clamp-2">
                                                {{ $prod->title }}
                                            </p>
                                        </a>
                                    @endforeach
                                </div>
                            </div>

                            {{-- Cột 3–4: Ảnh banner hoặc giới thiệu --}}
                            <div class="md:col-span-1 lg:col-span-2 hidden md:block">
                                <a href="{{ route('product.all') }}" class="block relative rounded-xl overflow-hidden">
                                    <img src="{{ asset('images/banner-fish.jpg') }}" alt="Cá giống chất lượng cao"
                                        class="w-full h-40 object-cover rounded-lg shadow-md hover:scale-105 transition-transform duration-500">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-tr from-black/40 to-transparent rounded-lg flex items-end p-3">
                                        <span class="text-white font-semibold text-sm">Cá giống chất lượng cao</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </li>

                {{-- ====================== KỸ THUẬT NUÔI ====================== --}}
                <li x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false"
                    class="relative group">
                    <button class="flex items-center hover:text-yellow-300 transition">
                        Kỹ thuật nuôi
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    {{-- Dropdown kỹ thuật --}}
                    <div x-show="open" x-transition
                        class="absolute left-0 top-full bg-white text-gray-700 shadow-xl rounded-md mt-2 w-56 z-50 py-2">
                        @foreach ($categories as $cate)
                            <a href="{{ route('category.show', $cate->slug) }}"
                                class="block px-4 py-2 hover:bg-teal-600 hover:text-white transition">
                                {{ $cate->name }}
                            </a>
                        @endforeach
                    </div>
                </li>

                {{-- Bảng giá --}}
                <li>
                    <a href="{{ url('/bang-gia') }}" class="hover:text-yellow-300 transition">Bảng giá</a>
                </li>

                {{-- Tài liệu kỹ thuật --}}
                <li>
                    <a href="{{ url('/tai-lieu-ky-thuat') }}" class="hover:text-yellow-300 transition">Tài liệu kỹ thuật</a>
                </li>

                {{-- Hỗ trợ --}}
                <li>
                    <a href="{{ url('/ho-tro') }}" class="hover:text-yellow-300 transition">Hỗ trợ</a>
                </li>

                {{-- Liên hệ --}}
                <li>
                    <a href="{{ url('/lien-he') }}" class="hover:text-yellow-300 transition">Liên hệ</a>
                </li>
            </ul>
        </div>
    </nav>
</div>



        {{-- @include('components.partials.navbar', ['product_categories' => $product_categories, 'categories' => $categories]) --}}
    </header>
</div>

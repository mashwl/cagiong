@props(['product'])
<div>
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
<div x-show="openOrderForm" x-cloak
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm p-3 md:p-4"
    x-transition.opacity
    @click.self="openOrderForm = false">

    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-3xl max-h-[90vh] overflow-y-auto p-6 md:p-8"
        x-transition.scale>
        
        {{-- Nút đóng --}}
        <button @click="openOrderForm = false"
            class="absolute top-3 right-3 text-gray-400 hover:text-gray-600 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        {{-- Tiêu đề --}}
        <h2 class="text-xl md:text-2xl font-bold text-center text-cyan-700 mb-2">
            🐟 Đăng ký mua ngay
        </h2>
        <p class="text-gray-500 text-center text-sm mb-6">
            Vui lòng điền thông tin để chúng tôi liên hệ xác nhận đơn hàng sớm nhất.
        </p>

        {{-- ✅ Thông báo thành công --}}
        @if (session('success'))
            <div x-data="{ show: true }" x-show="show" x-transition.opacity.duration.500ms
                class="mb-6 rounded-xl bg-green-50 border border-green-200 px-4 py-3 text-green-700 text-sm relative" x-cloak>
                <strong class="font-semibold">🎉 {{ session('success') }}</strong>
                <button type="button" @click="show = false"
                    class="absolute top-2 right-3 text-green-500 hover:text-green-700">
                    &times;
                </button>
            </div>
        @endif

        {{-- Form --}}
        <form action="{{ route('order.submit') }}" method="POST"
            class="grid grid-cols-1 md:grid-cols-2 gap-x-5 gap-y-5">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">

            {{-- Sản phẩm --}}
            <div class="flex flex-col">
                <label class="text-sm font-semibold mb-1 text-gray-700">Sản phẩm</label>
                <input type="text" value="{{ $product->title }}" readonly
                    class="h-[44px] rounded-lg border border-gray-200 bg-gray-100 text-gray-700 font-medium cursor-not-allowed text-sm px-3">
            </div>

            {{-- Số điện thoại --}}
            <div class="flex flex-col">
                <label class="text-sm font-semibold mb-1 text-gray-700">Số điện thoại (Zalo) <span
                        class="text-red-500">*</span></label>
                <input type="text" name="phone" required
                    class="h-[44px] rounded-lg border border-gray-300 bg-gray-50 focus:border-cyan-600 
                       focus:ring-1 focus:ring-cyan-200 px-3 placeholder-gray-400 text-sm"
                    placeholder="Ví dụ: 0987 654 321">
            </div>

            {{-- Họ tên --}}
            <div class="flex flex-col">
                <label class="text-sm font-semibold mb-1 text-gray-700">Họ và tên <span
                        class="text-red-500">*</span></label>
                <input type="text" name="name" required
                    class="h-[44px] rounded-lg border border-gray-300 bg-gray-50 focus:border-cyan-600 
                       focus:ring-1 focus:ring-cyan-200 px-3 placeholder-gray-400 text-sm"
                    placeholder="Nhập họ tên của bạn">
            </div>

            {{-- Địa chỉ --}}
            <div class="flex flex-col">
                <label class="text-sm font-semibold mb-1 text-gray-700">Địa chỉ giao hàng</label>
                <input type="text" name="address"
                    class="h-[44px] rounded-lg border border-gray-300 bg-gray-50 focus:border-cyan-600 
                       focus:ring-1 focus:ring-cyan-200 px-3 placeholder-gray-400 text-sm"
                    placeholder="Nhập địa chỉ hoặc tỉnh/thành phố">
            </div>

            {{-- Email --}}
            <div class="flex flex-col">
                <label class="text-sm font-semibold mb-1 text-gray-700">Email (nếu có)</label>
                <input type="email" name="email"
                    class="h-[44px] rounded-lg border border-gray-300 bg-gray-50 focus:border-cyan-600 
                       focus:ring-1 focus:ring-cyan-200 px-3 placeholder-gray-400 text-sm"
                    placeholder="example@gmail.com">
            </div>

            {{-- Số lượng --}}
            <div class="flex flex-col">
                <label class="text-sm font-semibold mb-1 text-gray-700">Số lượng đặt</label>
                <input type="number" name="quantity" min="1" value="1"
                    class="h-[44px] rounded-lg border border-gray-300 bg-gray-50 focus:border-cyan-600 
                       focus:ring-1 focus:ring-cyan-200 px-3 text-center text-sm">
            </div>

            {{-- Checkbox & Nút --}}
            <div class="col-span-1 md:col-span-2 space-y-3 pt-2">
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="subscribe" value="1" id="subscribe"
                        class="rounded border-gray-300 text-cyan-600 focus:ring-cyan-500">
                    <label for="subscribe" class="text-sm text-gray-700 select-none cursor-pointer">
                        Tôi muốn nhận bản tin khuyến mãi & sản phẩm mới
                    </label>
                </div>

                <button type="submit"
                    class="w-full bg-cyan-600 hover:bg-cyan-700 text-white py-3 rounded-xl 
                       font-semibold text-sm shadow transition">
                    GỬI ĐƠN ĐẶT HÀNG NGAY
                </button>
            </div>
        </form>
    </div>
</div>

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
</div>

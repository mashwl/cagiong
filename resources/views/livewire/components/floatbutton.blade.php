<div>
   <div x-data="{ openOrder: false, success: false }" class="fixed bottom-4 right-4 flex flex-col gap-3 z-50" x-cloak>

        <!-- 🐟 Nút Đặt Hàng Nhanh -->
        <button @click="openOrder = true"
            class="flex items-center justify-center bg-teal-700 hover:bg-teal-800 text-white rounded-full w-14 h-14 shadow-lg transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 20h9M12 4h9M5 4h2v16H5zM9 9h12M9 15h12" />
            </svg>
        </button>

        <!-- ☎️ Nút Gọi -->
        <a href="tel:{{ preg_replace('/\D/', '', $setting->phone ?? '#') }}"
            class="flex items-center justify-center bg-green-600 hover:bg-green-700 text-white rounded-full w-14 h-14 shadow-lg transition">
            <i class="fa fa-phone text-xl"></i>
        </a>

        <!-- 💬 Zalo -->
        <a href="https://zalo.me/{{ $setting->phone ?? '#' }}" target="_blank"
            class="flex items-center justify-center bg-blue-500 hover:bg-blue-600 text-white rounded-full w-14 h-14 shadow-lg transition font-bold text-sm">
            Zalo
        </a>

        <!-- 💙 Messenger -->
        <a href="https://m.me/{{ $setting->facebook ?? '#' }}" target="_blank"
            class="flex items-center justify-center bg-blue-700 hover:bg-blue-800 text-white rounded-full w-14 h-14 shadow-lg transition">
            <i class="fab fa-facebook-messenger text-2xl"></i>
        </a>

        <!-- ⬆️ Back To Top -->
        <button id="backToTop"
            class="hidden flex items-center justify-center bg-cyan-700 hover:bg-cyan-800 text-white rounded-full w-14 h-14 shadow-lg transition">
            <i class="fa fa-arrow-up text-xl"></i>
        </button>

        <!-- ✅ MODAL ĐẶT HÀNG HOÀN CHỈNH - KHÔNG BỊ ẨN KHI CLICK LABEL -->
        <div x-show="openOrder" x-cloak x-transition.opacity
            class="fixed inset-0 z-[100] flex items-center justify-center bg-black/50 backdrop-blur-sm"
            x-data="{ success: false }" x-cloak>
            <!-- Overlay nền ngoài - chỉ đóng khi click vào vùng này -->
            <div class="absolute inset-0" @click="openOrder = false"></div>

            <!-- Nội dung modal -->
            <div x-transition.scale
                class="relative bg-white rounded-2xl shadow-2xl w-full max-w-3xl max-h-[90vh] overflow-y-auto p-8 z-10"
                @click.stop>
                <!-- Nút đóng -->
                <button @click="openOrder = false"
                    class="absolute top-3 right-3 text-gray-400 hover:text-gray-700 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <!-- Tiêu đề -->
                <h2 class="text-2xl font-bold text-center text-cyan-800 mb-1">🐟 Đặt Hàng Nhanh</h2>
                <p class="text-gray-600 text-center mb-6 text-sm">
                    Vui lòng nhập thông tin để chúng tôi liên hệ xác nhận đơn hàng.
                </p>

                <!-- Thông báo thành công -->
                <div x-show="success" x-transition x-cloak
                    class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-5 text-center">
                    🎉 Cảm ơn bạn! Đơn hàng đã được gửi thành công.
                </div>

                <!-- Form -->
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
            "
                    @click.stop>
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
                            <label class="block text-sm font-semibold mb-1 text-gray-700">Địa chỉ giao hàng</label>
                            <textarea name="address" rows="2"
                                class="w-full rounded-lg border border-gray-300 bg-gray-50 focus:bg-white focus:border-cyan-600 focus:ring-2 focus:ring-cyan-100 py-2.5 px-3 placeholder-gray-400 transition"
                                placeholder="Nhập địa chỉ nhận hàng hoặc tỉnh/thành phố"></textarea>
                        </div>
                    </div>

                    <!-- Checkbox -->
                    <div class="flex items-center gap-2 pt-1" @click.stop>
                        <input type="checkbox" name="subscribe" value="1" id="subscribe"
                            class="rounded border-gray-300 text-cyan-600 focus:ring-cyan-500">
                        <label for="subscribe" class="text-sm text-gray-700 select-none cursor-pointer" @click.stop>
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

    <script>
        const backToTop = document.getElementById('backToTop');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 400) {
                backToTop.classList.remove('hidden');
            } else {
                backToTop.classList.add('hidden');
            }
        });
        backToTop.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    </script></div>
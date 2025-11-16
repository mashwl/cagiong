<div x-data="{ openOrder: false, showSuccessModal: false }" x-cloak class="fixed bottom-4 right-4 flex flex-col gap-3 z-50">

    <!-- 🐟 Nút Đặt Hàng Nhanh -->
    <button @click="openOrder = true"
        class="flex items-center justify-center bg-teal-700 hover:bg-teal-800 text-white rounded-full w-14 h-14 shadow-lg transition">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"
            stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 20h9M12 4h9M5 4h2v16H5zM9 9h12M9 15h12" />
        </svg>
    </button>

    <!-- ☎️ CALL -->
    <a href="tel:{{ $settings->phone ?? '#' }}"
        class="flex items-center justify-center bg-green-600 hover:bg-green-700 text-white rounded-full w-14 h-14 shadow-lg transition">
        <i class="fa fa-phone text-xl"></i>
    </a>

    <!-- 💬 ZALO -->
    <a href="{{ $settings->quick_links['zalo'] ?? '#' }}" target="_blank"
        class="flex items-center justify-center bg-blue-500 hover:bg-blue-600 text-white rounded-full w-14 h-14 shadow-lg transition font-bold text-sm">
        Zalo
    </a>

    <!-- 💙 MESSENGER -->
    <a href="{{ $settings->quick_links['messenger'] ?? '#' }}" target="_blank"
        class="flex items-center justify-center bg-blue-700 hover:bg-blue-800 text-white rounded-full w-14 h-14 shadow-lg transition">
        <i class="fab fa-facebook-messenger text-2xl"></i>
    </a>
    <button id="backToTop"
        class="hidden flex items-center justify-center bg-cyan-700 hover:bg-cyan-800 text-white rounded-full w-14 h-14 shadow-lg transition">
        <i class="fa fa-arrow-up text-xl"></i>
    </button>

    <!-- ========================= -->
    <!-- 📌 MODAL FORM ĐẶT HÀNG    -->
    <!-- ========================= -->
    <div x-show="openOrder" x-transition.opacity
        class="fixed inset-0 z-[100] flex items-center justify-center bg-black/50 backdrop-blur-sm">

        <div class="absolute inset-0" @click="openOrder = false"></div>

        <div x-transition.scale
            class="relative bg-white rounded-2xl shadow-2xl w-full max-w-3xl max-h-[90vh] overflow-y-auto p-8 z-10"
            @click.stop>

            <button @click="openOrder = false"
                class="absolute top-3 right-3 text-gray-400 hover:text-gray-700 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <h2 class="text-2xl font-bold text-center text-cyan-800 mb-1">YÊU CẦU BÁO GIÁ</h2>
            <p class="text-gray-600 text-center mb-6 text-sm">
                Vui lòng nhập thông tin để chúng tôi liên hệ báo giá.
            </p>

            <!-- FORM -->
            <form action="{{ route('order.submit') }}" method="POST" class="space-y-4"
                x-on:submit.prevent="
                    fetch($el.action, {
                        method: 'POST',
                        body: new FormData($el),
                        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
                    }).then(res => {
                        if(res.ok){
                            openOrder = false;
                            showSuccessModal = true;
                            $el.reset();
                        }
                    })
                ">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <div>
                        <label class="block text-sm font-semibold mb-1 text-gray-700">Họ và tên *</label>
                        <input type="text" name="name" required
                            class="w-full rounded-lg border border-gray-300 bg-gray-50 focus:border-cyan-600 py-2.5 px-3">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-1 text-gray-700">Số điện thoại *</label>
                        <input type="text" name="phone" required
                            class="w-full rounded-lg border border-gray-300 bg-gray-50 focus:border-cyan-600 py-2.5 px-3">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-1 text-gray-700">Email</label>
                        <input type="email" name="email"
                            class="w-full rounded-lg border border-gray-300 bg-gray-50 focus:border-cyan-600 py-2.5 px-3">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-1 text-gray-700">Tên cá giống *</label>
                        <select name="product_name" required
                            class="w-full rounded-lg border border-gray-300 bg-gray-50 focus:border-cyan-600 py-2.5 px-3">
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
                            class="w-full rounded-lg border border-gray-300 bg-gray-50 focus:border-cyan-600 py-2.5 px-3 text-center">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-1 text-gray-700">Địa chỉ</label>
                        <textarea name="address" rows="2"
                            class="w-full rounded-lg border border-gray-300 bg-gray-50 focus:border-cyan-600 py-2.5 px-3"></textarea>
                    </div>
                </div>

                <button type="submit"
                    class="w-full bg-cyan-600 hover:bg-cyan-700 text-white py-3 rounded-xl font-semibold shadow transition">
                    GỬI YÊU CẦU BÁO GIÁ
                </button>
            </form>
        </div>
    </div>


    <!-- ========================= -->
    <!-- ⭐ POPUP THÀNH CÔNG (STYLE ĐẸP) ⭐ -->
    <!-- ========================= -->
    <div x-show="showSuccessModal"
        class="fixed inset-0 z-[200] flex items-center justify-center bg-black/50 backdrop-blur-sm" x-transition.opacity
        x-cloak>

        <div class="bg-white rounded-2xl p-8 w-full max-w-md text-center shadow-lg" x-transition.scale>

            <h2 class="text-2xl font-bold text-green-600 mb-2">🎉 Gửi yêu cầu thành công!</h2>
            <p class="text-gray-700 mb-6">
                Cảm ơn bạn! Chúng tôi sẽ liên hệ xác nhận yêu cầu báo giá trong thời gian sớm nhất.
            </p>

            <button @click="showSuccessModal = false"
                class="bg-cyan-600 hover:bg-cyan-700 text-white px-6 py-2 rounded-lg font-semibold transition">
                Đóng
            </button>
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
</script>
</div>

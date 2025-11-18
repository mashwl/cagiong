@props(['product'])

<div x-data="{ openOrderForm: false, showSuccess: false }" x-on:open-order-form.window="openOrderForm = true" x-cloak class="relative">

    <!-- =========================== -->
    <!-- MODAL FORM ĐẶT HÀNG -->
    <!-- =========================== -->
    <div x-show="openOrderForm" x-transition.opacity
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm p-3 md:p-4"
        @click.self="openOrderForm = false">

        <div x-transition.scale
            class="relative bg-white rounded-2xl shadow-2xl w-full max-w-3xl max-h-[90vh] overflow-y-auto p-6 md:p-8"
            @click.stop>

            <!-- Nút đóng -->
            <button @click="openOrderForm = false"
                class="absolute top-3 right-3 text-gray-400 hover:text-gray-600 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <h2 class="text-xl md:text-2xl font-bold text-center text-cyan-700 mb-2">
                Đăng ký mua ngay
            </h2>
            <p class="text-gray-500 text-center text-sm mb-6">
                Vui lòng điền thông tin để chúng tôi liên hệ xác nhận đơn hàng sớm nhất.
            </p>

            <!-- FORM -->
            <form action="{{ route('order.submit') }}" method="POST"
                x-on:submit.prevent="
                    fetch($el.action, {
                        method: 'POST',
                        body: new FormData($el),
                        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
                    }).then(res => {
                        if(res.ok) {
                            openOrderForm = false;
                            showSuccess = true;
                            $el.reset();
                            setTimeout(() => showSuccess = false, 6000);
                        }
                    })
                  "
                class="grid grid-cols-1 md:grid-cols-2 gap-x-5 gap-y-5">

                @csrf
                <input type="hidden" name="type" value="order">
                <input type="hidden"
                    name="{{ $product instanceof \App\Models\Sanphamphu ? 'sanphamphu_id' : 'product_id' }}"
                    value="{{ $product->id }}">

                <div class="flex flex-col">
                    <label class="text-sm font-semibold mb-1 text-gray-700">Sản phẩm</label>
                    <input type="text" value="{{ $product->title }}" readonly
                        class="h-[44px] rounded-lg border border-gray-200 bg-gray-100 text-gray-700 font-medium cursor-not-allowed text-sm px-3">
                </div>

                <div class="flex flex-col">
                    <label class="text-sm font-semibold mb-1 text-gray-700">Số điện thoại (Zalo) <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="phone" required
                        class="h-[44px] rounded-lg border border-gray-300 bg-gray-50 focus:border-cyan-600 focus:ring-1 focus:ring-cyan-200 px-3 placeholder-gray-400 text-sm">
                </div>

                <div class="flex flex-col">
                    <label class="text-sm font-semibold mb-1 text-gray-700">Họ và tên <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="name" required
                        class="h-[44px] rounded-lg border border-gray-300 bg-gray-50 focus:border-cyan-600 focus:ring-1 focus:ring-cyan-200 px-3 placeholder-gray-400 text-sm">
                </div>

                <div class="flex flex-col">
                    <label class="text-sm font-semibold mb-1 text-gray-700">Địa chỉ giao hàng</label>
                    <input type="text" name="address"
                        class="h-[44px] rounded-lg border border-gray-300 bg-gray-50 focus:border-cyan-600 focus:ring-1 focus:ring-cyan-200 px-3 placeholder-gray-400 text-sm">
                </div>

                <div class="flex flex-col">
                    <label class="text-sm font-semibold mb-1 text-gray-700">Email (nếu có)</label>
                    <input type="email" name="email"
                        class="h-[44px] rounded-lg border border-gray-300 bg-gray-50 focus:border-cyan-600 focus:ring-1 focus:ring-cyan-200 px-3 placeholder-gray-400 text-sm">
                </div>

                <div class="flex flex-col">
                    <label class="text-sm font-semibold mb-1 text-gray-700">Số lượng đặt</label>
                    <input type="number" name="quantity" min="1" value="1"
                        class="h-[44px] rounded-lg border border-gray-300 bg-gray-50 focus:border-cyan-600 focus:ring-1 focus:ring-cyan-200 px-3 text-center text-sm">
                </div>

                <div class="col-span-1 md:col-span-2 space-y-3 pt-2">
                    <div class="flex items-center gap-2">
                        <input type="checkbox" name="subscribe" value="1" id="subscribe"
                            class="rounded border-gray-300 text-cyan-600 focus:ring-cyan-500">
                        <label for="subscribe" class="text-sm text-gray-700 cursor-pointer">
                            Tôi muốn nhận bản tin khuyến mãi & sản phẩm mới
                        </label>
                    </div>

                    <button type="submit"
                        class="w-full bg-cyan-600 hover:bg-cyan-700 text-white py-3 rounded-xl font-semibold text-sm shadow transition">
                        GỬI ĐƠN ĐẶT HÀNG NGAY
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- POPUP THÀNH CÔNG -->
    <div x-show="showSuccess" x-cloak
        class="fixed inset-0 z-[200] flex items-center justify-center bg-black/40 backdrop-blur-sm"
        x-transition.opacity>
        <div x-transition.scale
            class="bg-white rounded-2xl p-8 max-w-md w-full text-center shadow-xl border border-green-200">
            <h2 class="text-2xl font-bold text-green-600 mb-3">🎉 Đặt hàng thành công!</h2>
            <p class="text-gray-700 mb-6">
                Cảm ơn bạn! Chúng tôi sẽ liên hệ xác nhận đơn hàng trong thời gian sớm nhất.
            </p>
            <button @click="showSuccess = false"
                class="bg-cyan-600 hover:bg-cyan-700 text-white px-6 py-2 rounded-lg font-semibold">
                Đóng
            </button>
        </div>
    </div>
</div>

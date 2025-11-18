<main>
    <div class="container-fluid contact overflow-hidden py-5">
        <div class="container py-5">
            <div class="row g-5 mb-5">
                <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.1s">
                    <div class="sub-style">
                        <h5 class="sub-title text-primary pe-3">Liên hệ</h5>
                    </div>
                    <h1 class="display-6 mb-4 uppercase">Liên hệ với chúng tôi</h1>
                    <p class="mb-5">Đội tư vấn sẽ gọi xác nhận – gửi ảnh giống thật – chốt lịch giao hàng..</p>
                    <div class="d-flex border-bottom mb-4 pb-4">
                        <i class="fas fa-map-marked-alt fa-4x text-primary bg-light p-3 rounded"></i>
                        <div class="ps-3">
                            <h5>Địa chỉ</h5>
                            <p>{{ $setting?->description ?? 'Hội Am' }}</p>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-xl-6">
                            <div class="d-flex">
                                <i class="fas fa-tty fa-3x text-primary"></i>
                                <div class="ps-3">
                                    <h5 class="mb-3">Thông tin liên hệ</h5>
                                    <div class="mb-3">
                                        <h6 class="mb-0">Phone:</h6>
                                        <a href="tel:{{ $setting?->phone ?? '' }}" class="fs-5 text-primary">
                                            {{ $formattedPhone ?? '' }}
                                        </a>
                                    </div>
                                    <div class="mb-3">
                                        <h6 class="mb-0">Email:</h6>
                                        <a href="mailto:{{ $setting?->email ?? '' }}" class="fs-5 text-primary">
                                            {{ $setting?->email ?? '' }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="d-flex">
                                <i class="fas fa-clone fa-3x text-primary"></i>
                                <div class="ps-3">
                                    <h5 class="mb-3">Giờ mở cửa</h5>
                                    <div class="mb-3">
                                        <h6 class="mb-0">Thứ Hai - Thứ Bảy:</h6>
                                        <a href="#" class="fs-5 text-primary">07:00 - 19:00</a>
                                    </div>
                                    <div class="mb-3">
                                        <h6 class="mb-0">Chủ Nhật:</h6>
                                        <a href="#" class="fs-5 text-primary">10:00 - 17:00</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @php
                        $quickLinks = $setting->quick_links ?? [];
                    @endphp
                    <div class="d-flex align-items-center pt-3">
                        <div class="me-4">
                            <div class="bg-light d-flex align-items-center justify-content-center"
                                style="width: 90px; height: 90px; border-radius: 10px;"><i
                                    class="fas fa-share fa-3x text-primary"></i></div>
                        </div>
                        <div class="d-flex">
                            <a class="btn btn-secondary border-secondary me-2 p-2 d-flex align-items-center gap-2"
                                href="{{ $quickLinks['facebook'] ?? '#' }}" target="_blank">
                                <i class="fab fa-facebook-f" style="color:#1877F2;"></i> Facebook
                            </a>
                            <a class="btn btn-secondary border-secondary mx-2 p-2 d-flex align-items-center gap-2"
                                href="{{ $quickLinks['zalo'] ?? '#' }}" target="_blank">
                                <img src="{{ asset('front/img/zalo.png') }}" alt="Zalo"
                                    style="width: 20px; height: 20px;"> Zalo
                            </a>
                            <a class="btn btn-secondary border-secondary mx-2 p-2 d-flex align-items-center gap-2"
                                href="{{ $quickLinks['tiktok'] ?? '#' }}" target="_blank">
                                <i class="fab fa-tiktok" style="color:#000000;"></i> TikTok
                            </a>
                        </div>

                    </div>
                </div>
                <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.3">
                    <div class="sub-style">
                        {{-- <h5 class="sub-title text-primary pe-3">Let’s Connect</h5> --}}
                    </div>
                    <h1 class="display-5 mb-4">Đơn Đặt Hàng</h1>

                    <p class="text-muted mb-4">Vui lòng nhập thông tin để chúng tôi liên hệ xác nhận đơn hàng.</p>

                    <!-- AlpineJS -->
                    <div x-data="{ showSuccess: false }">

                        <!-- FORM -->
                        <form action="{{ route('order.submit') }}" method="POST"
                            x-on:submit.prevent="
                                fetch($el.action, {
                                    method: 'POST',
                                    body: new FormData($el),
                                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
                                })
                                .then(res => {
                                    if (res.ok) {
                                        showSuccess = true;
                                        let modal = new bootstrap.Modal(document.getElementById('successModal'));
                                        modal.show();
                                        $el.reset();
                                    }
                                });
                            ">

                            @csrf
                            <input type="hidden" name="type" value="order">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Họ và tên" required>
                                        <label for="name">Họ và tên <span class="text-danger">*</span></label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="phone" name="phone"
                                            placeholder="Số điện thoại" required>
                                        <label for="phone">Số điện thoại (Zalo) <span
                                                class="text-danger">*</span></label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="Email">
                                        <label for="email">Email (nếu có)</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select" id="product_name" name="product_name" required>
                                            <option value="">-- Chọn loại cá giống --</option>
                                            @foreach ($products as $item)
                                                <option value="{{ $item->title }}">{{ $item->title }}</option>
                                            @endforeach
                                            <option value="Khác">🔹 Loại khác (ghi chú ở địa chỉ)</option>
                                        </select>
                                        <label for="product_name">Tên cá giống muốn mua <span
                                                class="text-danger">*</span></label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" id="quantity" name="quantity"
                                            min="1" value="1">
                                        <label for="quantity">Số lượng</label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control" id="address" name="address" style="height: 80px"></textarea>
                                        <label for="address">Địa chỉ giao hàng</label>
                                    </div>
                                </div>

                                <div class="col-12 form-check mt-2">
                                    <input type="checkbox" class="form-check-input" id="subscribe" name="subscribe"
                                        value="1">
                                    <label class="form-check-label" for="subscribe">Tôi muốn nhận bản tin khuyến
                                        mãi</label>
                                </div>

                                <div class="col-12">
                                    <button class="btn btn-primary w-100 mt-3">Gửi đơn đặt hàng</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- POPUP THÀNH CÔNG (Bootstrap Modal) -->
                    <div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content text-center p-3">

                                <div class="modal-header border-0">
                                    <h5 class="modal-title w-100 text-success">🎉 Đặt hàng thành công!</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">
                                    Cảm ơn bạn! Chúng tôi đã nhận được đơn hàng và sẽ liên hệ sớm nhất.
                                </div>

                                <div class="modal-footer border-0">
                                    <button class="btn btn-primary w-100" data-bs-dismiss="modal">Đóng</button>
                                </div>

                            </div>
                        </div>
                    </div>



                </div>
            </div>
            @if (!empty($setting->map))
                <div class="col-12 pt-5 wow zoomIn" data-wow-delay="0.1s">
                    <div class="rounded h-100">
                        <iframe class="rounded w-100" style="height: 500px;" src="{{ $setting->map }}"
                            loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            @endif

        </div>
    </div>
</main>

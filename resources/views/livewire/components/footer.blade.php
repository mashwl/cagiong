<div>
    <div class="container-fluid footer py-5 wow fadeIn" data-wow-delay="0.2s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="footer-item d-flex flex-column">
                        <h4 class="text-secondary mb-4">Thông tin liên hệ</h4>
                        <a href=""><i class="fa fa-map-marker-alt me-2"></i> {{ $setting->description ?? '' }}</a>
                        <a href=""><i class="fas fa-envelope me-2"></i> {{ $setting->email ?? '' }}</a>
                        <a href=""><i class="fas fa-phone me-2"></i> {{ $setting->phone ?? '' }}</a>
                        <div class="d-flex align-items-center">
                            @php
                                $quickLinks = $setting->quick_links ?? [];
                            @endphp
                            <i class="fas fa-share fa-2x text-secondary me-2"></i>
                            <a class="btn mx-1" href="{{ $quickLinks['facebook'] ?? '#' }}"><i
                                    class="fab fa-facebook-f"></i></a>
                            <a class="btn mx-1" href="{{ $quickLinks['messenger'] ?? '#' }}"><img
                                    src="{{ asset('front/img/messenger.png') }}" alt="Messenger"
                                    style="width: 20px; height: 20px;"></a>
                            <a class="btn mx-1" href="{{ $quickLinks['zalo'] ?? '#' }}">
                                <img src="{{ asset('front/img/zalo.png') }}" alt="Zalo"
                                    style="width: 20px; height: 20px;"></a>
                            <a class="btn mx-1" href="{{ $quickLinks['tiktok'] ?? '#' }}"><i
                                    class="fab fa-tiktok"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="footer-item d-flex flex-column">
                        <h4 class="text-secondary mb-4">Giờ mở cửa</h4>
                        <div class="mb-3">
                            <h6 class="text-muted mb-0">Thứ Hai - Thứ Bảy:</h6>
                            <p class="text-white mb-0">09:00 - 19:00</p>
                        </div>
                        <div class="mb-3">
                            <h6 class="text-muted mb-0">Chủ Nhật:</h6>
                            <p class="text-white mb-0">10:00 - 17:00</p>
                        </div>

                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="footer-item d-flex flex-column">
                        <h4 class="text-secondary mb-4">Kỹ Thuật Nuôi</h4>
                        @foreach ($categories as $item)
                            <a href="{{ route('filamentblog.category.post', $item->slug) }}" class=""><i
                                    class="fas fa-angle-right me-2"></i> {{ $item->name }}</a>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="footer-item">
                        <h4 class="text-secondary uppercase mb-4">Đăng ký nhận tin mới nhất</h4>
                        <p class="text-light mb-3">
                            Nhận các bài viết mới nhất trực tiếp vào email của bạn.
                        </p>
                        <form method="post" action="{{ route('filamentblog.post.subscribe') }}">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="email" name="email" class="form-control"
                                    placeholder="Nhập email của bạn" required>
                                <button class="btn btn-secondary" type="submit">
                                    <i class="fa fa-arrow-right"></i>
                                </button>
                            </div>
                            @error('email')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                            @if (session('success'))
                                <div class="text-success small">{{ session('success') }}</div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid copyright py-4">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-md-6 text-center ">
                    <span class="text-white">©{{ $setting->organization_name ?? 'Phạm Hiếu Mỹ' }}, All Right
                        Reserved.</span>
                </div>
                <div class="col-md-6 text-center text-md-end text-white"></div>
            </div>
        </div>
    </div>

    <script>
        function onSubmit(token) {
            document.getElementById("comment-box").submit();
        }
    </script>
</div>

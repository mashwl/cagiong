<main>
    <title>{{ $setting?->title ?? (config('app.name') ?? 'Trang chủ') }}</title>
    <link rel="icon" href="{{ $setting?->faviconImage }}" type="image/x-icon" />
    </title>
    <!-- Banner Start -->
    <div class="w-full relative py-4">
        <div id="carouselId" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    {{-- <img src="{{ asset('storage/' . $setting?->banner) }}" alt="Banner" --}}
                    <img src="{{ Storage::url($setting?->banner) }}" alt="Banner"
                        class="w-100 h-auto object-cover rounded" style="max-height: 600px;">
                    <div class="carousel-caption d-none d-md-block">
                        <!-- Nếu bạn có text hoặc nút trong banner thì đặt ở đây -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->
    <!-- Products Start -->
  
<div class="container-fluid country overflow-hidden py-5">
    <div class="container">

        {{-- === HEADER: Desktop & Tablet === --}}
        <div class="d-none d-md-flex justify-content-between align-items-center flex-wrap mb-3 text-center text-md-start">
            <div class="d-flex align-items-center px-4 py-2 text-white fw-bold text-uppercase"
                style="background: linear-gradient(90deg, #003a60, #00897b); border-radius: 12px;">
                <i class="fas fa-fish me-2 fs-5"></i>
                {{  'Sản Phẩm Nổi Bật' ?? $category->name}}
            </div>

            <a href="{{ $category ? route('category.show', ['category' => $category->slug]) : '#' }}"
                class="btn text-white fw-semibold d-flex align-items-center justify-content-center px-4 py-2 mt-2 mt-md-0"
                style="background: linear-gradient(90deg, #00897b, #004c73); border-radius: 25px;">
                Xem thêm <i class="fas fa-chevron-right ms-2"></i>
            </a>
        </div>

        {{-- === HEADER CHO MOBILE === --}}
        <div class="d-flex d-md-none justify-content-center mb-3">
            <div class="d-flex align-items-center px-4 py-2 text-white fw-bold text-uppercase"
                style="background: linear-gradient(90deg, #003a60, #00897b); border-radius: 12px;">
                <i class="fas fa-fish me-2 fs-5"></i>
                {{ 'Sản Phẩm Bán Chạy' ?? $category->name }}
            </div>
        </div>

        {{-- === SẢN PHẨM === --}}
        <div class="row g-4 text-center">
            @foreach ($products->sortByDesc('published_at') as $product)
                <div class="col-6 col-md-4 col-xl-3 mb-4 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="country-item">
                        @php
                            $image = $product->featuredImage->image_path ?? ($product->images->first()->image_path ?? null);
                        @endphp
                        <div class="rounded overflow-hidden" style="height: 220px;">
                            <img src="{{ Storage::url($image) }}" class="w-auto h-100 object-fit-contain rounded"
                                alt="{{ $product->title }}">
                        </div>

                        <div class="country-name mt-2">
                            <a href="{{ route('product.show', ['category' => $category->slug, 'product' => $product->slug]) }}" class="text-white fs-5">{{ $product->title }}</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>


        {{-- === NÚT XEM THÊM CHỈ DÀNH CHO MOBILE === --}}
        <div class="d-block d-md-none text-center mt-3">
            <a href="{{ $category ? route('category.show', ['category' => $category->slug]) : '#' }}"
                class="btn text-white fw-semibold d-inline-flex align-items-center justify-content-center px-4 py-2"
                style="background: linear-gradient(90deg, #00897b, #004c73); border-radius: 25px;">
                Xem thêm <i class="fas fa-chevron-right ms-2"></i>
            </a>
        </div>

    </div>
</div>




    <!-- Products End -->
    <!-- Features Start -->
    <div class="container-fluid features overflow-hidden py-5">
        <div class="container">
            <div class="section-title text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">
                <div class="sub-style">
                    <h5 class="sub-title text-primary px-3">Vì sao nên lựa chọn chúng tôi</h5>
                </div>
                <h2 class="display-6 mb-4">Làm lớn- Nuôi nhiều- hãy bắt đầu từ con giống khỏe mạnh</h2>
                <p class="mb-0">Đối tác tin cậy và đồng hành cùng các Hộ nuôi nhỏ, trang trại nuôi thương phẩm cho đến
                    mô hình nuôi Hợp tác xã & Doanh nghiệp vừa và lớn.!</p>
            </div>
            <div class="row g-4 justify-content-center text-center">
                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="feature-item text-center p-4">
                        <div class="feature-icon p-3 mb-4">
                            <i class="fas fa-dollar-sign fa-4x text-primary"></i>
                        </div>
                        <div class="feature-content d-flex flex-column">
                            <h5 class="mb-3 uppercase">Giá cả hợp lý</h5>
                            <p class="mb-3 ">Mua càng nhiều càng rẻ</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="feature-item text-center p-4">
                        <div class="feature-icon p-3 mb-4">
                            <i class="fas fa-fish fa-4x text-primary"></i>
                        </div>
                        <div class="feature-content d-flex flex-column">
                            <h5 class="mb-3 uppercase">Con giống khỏe mạnh</h5>
                            <p class="mb-3">Con giống khỏe, chất lượng đồng đều</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="feature-item text-center p-4">
                        <div class="feature-icon p-3 mb-4">
                            <i class="fas fa-headphones fa-4x text-primary"></i>
                        </div>
                        <div class="feature-content d-flex flex-column">
                            <h5 class="mb-3 uppercase">Hỗ trợ 24/7</h5>
                            <p class="mb-3">Tư vấn miễn phí kỹ thuật nuôi</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="feature-item text-center p-4">
                        <div class="feature-icon p-3 mb-4">
                            <i class="fa-solid fa-truck-moving fa-4x text-primary"></i>
                        </div>
                        <div class="feature-content d-flex flex-column">
                            <h5 class="mb-3 uppercase">giao hàng toàn quốc</h5>
                            <p class="mb-3">Giao hàng nhanh chóng và an toàn</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Features End -->
    <!-- About Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-xl-5 wow fadeInLeft" data-wow-delay="0.1s">
                    <div class="bg-light rounded">
                        <img src="{{ asset('front/img/about-1.png') }}" class="img-fluid w-100"
                            style="margin-bottom: -7px;" alt="Image">
                        <img src="{{ asset('front/img/about.jpg') }}"
                            class="img-fluid w-100 border-bottom border-5 border-primary"
                            style="border-top-right-radius: 300px; border-top-left-radius: 300px;" alt="Image">
                    </div>
                </div>
                <div class="col-xl-7 wow fadeInRight" data-wow-delay="0.3s">
                    <h5 class="sub-title pe-3">Giới thiệu</h5>
                    <h1 class="display-5 mb-4">Hành trình hơn 20 năm cung cấp các loại cá giống</h1>
                    <p class="mb-4">Hành trình hơn 20 năm cung cấp các loại cá giống đủ tiêu chuẩn,
                        {{ $setting->title ?? 'Cá Giống Linh Nam' }} đồng hành và gắn bó với nhiều thế hệ bà con miền Bắc đang làm nghề nuôi
                        cá….</p>
                    <div class="row gy-4 align-items-center">
                        <div class="col-4 col-md-3">
                            <div class="bg-light text-center rounded p-3">
                                <div class="mb-2">
                                    <i class="fas fa-ticket-alt fa-4x text-primary"></i>
                                </div>
                                <h1 class="display-5 fw-bold mb-2">20</h1>
                                <p class="text-muted mb-0">Năm kinh nghiệm</p>
                            </div>
                        </div>
                        <div class="col-8 col-md-9">
                            <div class="mb-5">
                                <p class="text-primary h6 mb-3"><i class="fa fa-check-circle text-secondary me-2"></i>
                                    Mua càng nhiều giá càng rẻ</p>
                                <p class="text-primary h6 mb-3"><i class="fa fa-check-circle text-secondary me-2"></i>
                                    Giao hàng nhanh chóng</p>
                                <p class="text-primary h6 mb-3"><i class="fa fa-check-circle text-secondary me-2"></i>
                                    Tư vấn chính xác và chuyên nghiệp</p>
                            </div>
                            <div class="d-flex flex-wrap">
                                <div id="phone-tada" class="d-flex align-items-center justify-content-center me-4">
                                    <a href="" class="position-relative wow tada" data-wow-delay=".9s">
                                        <i class="fa fa-phone-alt text-primary fa-3x"></i>
                                        <div class="position-absolute" style="top: 0; left: 25px;">
                                            <span><i class="fa fa-comment-dots text-secondary"></i></span>
                                        </div>
                                    </a>
                                </div>
                                @php
                                    $phone = $setting?->phone;
                                    // Thay 0 đầu thành +84 và thêm dấu cách mỗi 3 số cho đẹp
                                    $formattedPhone = preg_replace('/^0/', '+84 ', $phone);
                                    $formattedPhone = preg_replace(
                                        '/(\d{3})(\d{3})(\d+)/',
                                        '$1 $2 $3',
                                        $formattedPhone,
                                    );
                                @endphp
                                <div class="d-flex flex-column justify-content-center">
                                    <span class="text-primary">Tư vấn liên hệ</span>
                                    <span class="text-secondary fw-bold fs-5" style="letter-spacing: 2px;">Hotline:
                                        {{ $formattedPhone }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->
    <!-- Seeding Start -->
    <div class="container-fluid testimonial overflow-hidden pb-5">
        <div class="container py-5">
            <div class="section-title text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">
                <div class="sub-style">
                    <h5 class="sub-title text-primary px-3">Ý kiến khách hàng</h5>
                </div>
                <h1 class="display-5 mb-4">Khách hàng họ nói gì về chúng tôi</h1>
                <p class="mb-0">Chúng ta cùng xem những đánh giá của khách hàng về chúng tôi trong suốt thời gian
                    qua
                </p>
            </div>

            @if ($seedings->isNotEmpty())
                <div class="owl-carousel testimonial-carousel wow zoomInDown" data-wow-delay="0.2s">
                    @foreach ($seedings as $seeding)
                        <div class="testimonial-item">
                            <div class="testimonial-content p-4 mb-5">
                                <p class="fs-5 mb-0">{{ $seeding->description }}</p>
                                <div class="d-flex justify-content-end">
                                    <i class="fas fa-star text-secondary"></i>
                                    <i class="fas fa-star text-secondary"></i>
                                    <i class="fas fa-star text-secondary"></i>
                                    <i class="fas fa-star text-secondary"></i>
                                    <i class="fas fa-star text-secondary"></i>
                                </div>
                            </div>

                            <div class="d-flex align-items-center">
                                <div
                                    style="width: 100px; height: 100px; border-radius: 50%; border: 3px solid #15b990; overflow: hidden;">
                                    <img class="img-fluid w-100 h-100"
                                        src="{{ $seeding->user->profile_photo_path
                                            ? Storage::url($seeding->user->profile_photo_path)
                                            : asset('front/img/testimonial-1.jpg') }}"
                                        alt="img" style="object-fit: cover;">
                                </div>
                                <div class="ms-4">
                                    <h5>{{ $seeding->user->name ?? 'Khách hàng' }}</h5>
                                    <p class="mb-0">{{ $seeding->address }}</p>
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    <!-- Seeding End -->
    <!-- Post Start -->
    <div class="container-fluid training overflow-hidden bg-light py-5">
        <div class="container py-5">
            <div class="section-title text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">
                <div class="sub-style">
                    <h5 class="sub-title text-primary px-3">Nơi Chia Sẻ Kinh Nghiệm</h5>
                </div>
                <h2 class="display-5 mb-4">Kiến thức & kỹ thuật nuôi</h2>
            </div>
            @if ($posts->isNotEmpty())
                <div class="position-relative overflow-hidden">
                    <div id="autoCarousel" class="d-flex gap-4">
                        @foreach ($posts->where('status', 'published')->sortByDesc('published_at')->take(4) as $post)
                            <div class="flex-shrink-0" style="width: 280px;">
                                <div class="training-item">
                                    <div class="training-inner">
                                        <div class="training-img-wrapper overflow-hidden rounded bg-white d-flex align-items-center justify-content-center"
                                            style="height: 220px;">
                                            <img src="{{ Storage::url($post->cover_photo_path) }}"
                                                class="w-auto h-100 object-fit-contain" alt="{{ $post->title }}">
                                        </div>
                                        <div class="training-title-name">
                                            <a href="#" class="h5 text-white mb-0">{{ $post->title }}</a>
                                        </div>
                                    </div>
                                    <div class="training-content bg-secondary rounded-bottom p-3">
                                        <a href="{{ route('filamentblog.post.show', $post) }}">
                                            <h6 class="text-white mb-2">{{ $post->title }}</h6>
                                        </a>
                                        <p class="text-black" style="color: ffff !important;">
                                            {{ Str::limit(strip_tags($post->body), 60) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            @endif
            <div class="col-12 text-center mt-4">
                <a class="btn btn-primary border-secondary rounded-pill py-2 px-5 wow fadeInUp" data-wow-delay="0.1s"
                    href="{{ route('filamentblog.post.all') }}">Xem thêm</a>
            </div>
        </div>
    </div>
    <!-- Post End -->


</main>

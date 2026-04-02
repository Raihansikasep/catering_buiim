@extends('layouts.frontend')
@section('content')

<!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">

            <!-- SLIDE 1 -->
            <div class="carousel-item active position-relative">
                <img class="carousel-img" src="img/8e1e17f5f76a43bcb1fea0cc4ff951e1.jpg" alt="Image">

                <div class="overlay-dark"></div>

                <div class="carousel-caption d-flex justify-content-center align-items-center text-center">
                    <div class="col-lg-8">
                        <h1 class="display-3 text-white fw-bold mb-3">
                            Masakan Rumahan Berkualitas
                        </h1>
                        <p class="fs-5 text-white mb-2">
                            Disiapkan dari bahan segar pilihan dengan cita rasa khas rumahan
                        </p>
                        <p class="text-white">
                            Cocok untuk kebutuhan harian, acara keluarga, hingga katering kantor dengan kualitas terbaik
                        </p>
                    </div>
                </div>
            </div>

            <!-- SLIDE 2 -->
            <div class="carousel-item position-relative">
                <img class="carousel-img" src="img/catering lunch box (4).jpg" alt="Image">

                <div class="overlay-dark"></div>

                <div class="carousel-caption d-flex justify-content-center align-items-center text-center">
                    <div class="col-lg-8">
                        <h1 class="display-3 text-white fw-bold mb-3">
                            Menu Sehat & Lezat
                        </h1>
                        <p class="fs-5 text-white mb-2">
                            Perpaduan rasa nikmat dan nutrisi seimbang untuk keluarga Anda
                        </p>
                        <p class="text-white">
                            Tersedia berbagai pilihan menu nasi kotak, snack box, dan paket catering harian
                        </p>
                    </div>
                </div>
            </div>

        </div>

        <!-- NAV -->
        <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
            <span class="custom-arrow">&lt;</span>
        </button>

        <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
            <span class="custom-arrow">&gt;</span>
        </button>

    </div>
</div>
    <!-- Carousel End -->


    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 align-items-center">

                <!-- IMAGE -->
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <div class="about-img position-relative">
                        <img class="img-fluid w-100 rounded-4 shadow-lg" src="img/nasbox (1).jpg">
                    </div>
                </div>

                <!-- TEXT -->
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">

                    <h1 class="display-5 fw-bold mb-4">
                        Masakan Rumahan Lezat & Berkualitas
                    </h1>

                    <p class="mb-4 text-muted">
                        Kami menghadirkan hidangan rumahan dengan kualitas terbaik yang dibuat dari bahan segar pilihan.
                        Setiap menu diolah dengan penuh perhatian untuk memberikan rasa yang autentik dan kepuasan maksimal.
                    </p>

                    <div class="mb-4">
                        <p class="d-flex align-items-center mb-2">
                            <i class="fa fa-check-circle text-success me-2"></i>
                            Masakan rumahan berkualitas premium
                        </p>
                        <p class="d-flex align-items-center mb-2">
                            <i class="fa fa-check-circle text-success me-2"></i>
                            Bahan segar, higienis & terpercaya
                        </p>
                        <p class="d-flex align-items-center mb-2">
                            <i class="fa fa-check-circle text-success me-2"></i>
                            Rasa lezat & konsisten setiap hari
                        </p>
                    </div>

                    <a class="btn btn-success btn-modern px-4 py-2 mt-2" href="{{ route('about') }}">
                        Baca Selengkapnya
                    </a>

                </div>

            </div>
        </div>
    </div>
    <!-- About End -->


       <!-- Feature Start -->
    <div class="container-fluid bg-light py-6">
    <div class="container">

        <!-- HEADER -->
        <div class="text-center mx-auto mb-5" style="max-width: 500px;">
            <h1 class="display-5 mb-3">Keunggulan Kami</h1>
            <p class="text-muted">
                Kami menyediakan masakan rumahan berkualitas dengan bahan segar dan rasa terbaik untuk kepuasan Anda.
            </p>
        </div>

        <div class="row g-4">

            <!-- ITEM 1 -->
            <div class="col-lg-4 col-md-6">
                <div class="feature-card text-center p-4">

                    <div class="icon-box mb-4">
                        <img src="img/icon-1.png" alt="">
                    </div>

                    <h4 class="mb-3">Bahan Berkualitas</h4>
                    <p class="text-muted">
                        Menggunakan bahan segar pilihan.
                    </p>

                </div>
            </div>

            <!-- ITEM 2 -->
            <div class="col-lg-4 col-md-6">
                <div class="feature-card text-center p-4">

                    <div class="icon-box mb-4">
                        <img src="img/icon-1.png" alt="">
                    </div>

                    <h4 class="mb-3">Masakan Rumahan</h4>
                    <p class="text-muted">
                        Cita rasa khas rumahan yang autentik dan lezat.
                    </p>

                </div>
            </div>

            <!-- ITEM 3 -->
            <div class="col-lg-4 col-md-6">
                <div class="feature-card text-center p-4">

                    <div class="icon-box mb-4">
                        <img src="img/icon-1.png" alt="">
                    </div>

                    <h4 class="mb-3">Aman & Higienis</h4>
                    <p class="text-muted">
                        Diproses dengan standar kebersihan terbaik.
                    </p>

                </div>
            </div>
            <div class="text-center mt-4">
            <a href="{{ route('about') }}" class="btn btn-success rounded-pill px-5 py-3">
                Baca Selengkapnya
            </a>
        </div>
        </div>
    </div>
</div>
    <!-- Feature End -->

     <!-- MODAL POPUP -->
    <div class="modal fade" id="featureModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Judul</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body text-center">
                    <p>Isi deskripsi</p>
                </div>

            </div>
        </div>
    </div>
    <!-- modal pop op End -->


    <!-- Product Start -->
    <div class="container-xxl py-5">
    <div class="container">

        {{-- HEADER --}}
        <div class="row g-0 gx-5 align-items-end">
            <div class="col-lg-6">
                <h1 class="display-5 mb-3">Produk Kami</h1>
                <p>Pilihan catering lezat untuk Anda</p>
            </div>

            {{-- CATEGORY TAB --}}
            <div class="col-lg-6 text-lg-end">
                <ul class="nav nav-pills d-inline-flex mb-5">

                    {{-- TAB SEMUA --}}
                    <li class="nav-item me-2">
                        <a class="btn btn-outline-success border-2 active"
                           data-bs-toggle="pill"
                           href="#tab-all">
                            Semua
                        </a>
                    </li>

                    {{-- LOOP CATEGORY --}}
                    @foreach($categories as $category)
                        <li class="nav-item me-2">
                            <a class="btn btn-outline-success border-2"
                               data-bs-toggle="pill"
                               href="#tab-{{ $category->id }}">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach

                </ul>
            </div>
        </div>

        {{-- TAB CONTENT --}}
        <div class="tab-content">

            {{-- ================= SEMUA ================= --}}
            <div id="tab-all" class="tab-pane fade show active">
                <div class="row g-4">

                    @foreach($menus as $menu)
                    <div class="col-xl-3 col-lg-4 col-md-6">

                        <div class="product-item border rounded shadow-sm">

                            <div class="position-relative bg-light overflow-hidden">
                                <img class="img-fluid w-100"
                                     src="{{ asset('storage/'.$menu->image) }}"
                                     style="height:220px; object-fit:cover;">

                                <div class="bg-secondary text-white position-absolute top-0 start-0 m-3 px-2 py-1 rounded">
                                    {{ $menu->category->name }}
                                </div>
                            </div>

                            <div class="text-center p-4">
                                <h5 class="mb-2">{{ $menu->name }}</h5>

                                <span class="text-success">
                                    Rp {{ number_format($menu->price) }}
                                </span>
                            </div>

                            <div class="d-flex border-top">
                                <small class="w-100 text-center py-2">
                                    <a href="{{ route('product.detail', $menu->id) }}">
                                        <i class="fa fa-eye text-success me-2"></i>Detail
                                    </a>
                                </small>
                            </div>

                        </div>

                    </div>
                    @endforeach

                </div>
            </div>

            {{-- ================= PER KATEGORI ================= --}}
            @foreach($categories as $category)
            <div id="tab-{{ $category->id }}" class="tab-pane fade">
                <div class="row g-4">

                    @foreach($menus->where('category_id', $category->id) as $menu)
                    <div class="col-xl-3 col-lg-4 col-md-6">

                        <div class="product-item border rounded shadow-sm">

                            <div class="position-relative bg-light overflow-hidden">
                                <img class="img-fluid w-100"
                                     src="{{ asset('storage/'.$menu->image) }}"
                                     style="height:220px; object-fit:cover;">

                                <div class="bg-secondary text-white position-absolute top-0 start-0 m-3 px-2 py-1 rounded">
                                    {{ $category->name }}
                                </div>
                            </div>

                            <div class="text-center p-4">
                                <h5 class="mb-2">{{ $menu->name }}</h5>

                                <span class="text-success">
                                    Rp {{ number_format($menu->price) }}
                                </span>
                            </div>

                            <div class="d-flex border-top">
                                <small class="w-100 text-center py-2">
                                    <a href="{{ route('product.detail', $menu->id) }}">
                                        <i class="fa fa-eye text-success me-2"></i>Detail
                                    </a>
                                </small>
                            </div>

                        </div>

                    </div>
                    @endforeach

                </div>
            </div>
            @endforeach

        </div>
        <div class="text-center mt-4">
            <a href="{{ route('product') }}" class="btn btn-success rounded-pill px-5 py-3">
                Lihat Selengkapnya
            </a>
        </div>

    </div>
</div>
    <!-- Product End -->


    <!-- Firm Visit Start -->
    <div class="container-fluid bg-success bg-icon mt-5 py-6">
    <div class="container">
        <div class="row g-5 align-items-center">

            <div class="col-md-7">
                <h1 class="display-5 text-white mb-3">Komitmen Kami</h1>
                <p class="text-white mb-0">
                    Kami selalu menghadirkan masakan rumahan dengan kualitas terbaik,
                    menggunakan bahan segar dan proses higienis untuk memastikan setiap hidangan
                    lezat, sehat, dan memuaskan pelanggan.
                </p>
            </div>

            <div class="col-md-5 text-md-end">
                <a class="btn btn-secondary rounded-pill py-3 px-5" href="">
                    Pesan Sekarang
                </a>
            </div>

        </div>
    </div>
</div>
    <!-- Firm Visit End -->


    <!-- Testimonial Start -->
    <div class="container-fluid bg-light py-6 mb-5">
    <div class="container">

        <!-- HEADER -->
        <div class="text-center mx-auto mb-5" style="max-width: 550px;">
            <h1 class="display-5 mb-3">Ulasan Pelanggan</h1>
            <p class="text-muted">
                Kepuasan pelanggan adalah prioritas kami. Berikut beberapa pengalaman nyata dari pelanggan yang telah mencoba layanan kami.
            </p>
        </div>

        <div class="owl-carousel testimonial-carousel">

            <!-- ITEM 1 -->
            <div class="testimonial-item p-4">
                <div class="testimonial-card">

                    <div class="stars mb-2">
                        ⭐⭐⭐⭐⭐
                    </div>

                    <p class="mb-3">
                        "Makanannya enak banget, rasanya kaya masakan rumah sendiri. Porsinya juga pas, Recommended!"
                    </p>

                    <div class="d-flex align-items-center">
                        <img src="img/testimonial-1.jpg" class="rounded-circle me-3" width="55">
                        <div>
                            <h6 class="mb-0">Ibu Rina</h6>
                            <small class="text-muted">Pelanggan Catering</small>
                        </div>
                    </div>

                </div>
            </div>

            <!-- ITEM 2 -->
            <div class="testimonial-item p-4">
                <div class="testimonial-card">

                    <div class="stars mb-2">
                        ⭐⭐⭐⭐⭐
                    </div>

                    <p class="mb-3">
                        "Sudah langganan untuk acara kantor. Rasanya konsisten enak, bersih, dan packaging rapi. Pelayanan juga ramah."
                    </p>

                    <div class="d-flex align-items-center">
                        <img src="img/testimonial-2.jpg" class="rounded-circle me-3" width="55">
                        <div>
                            <h6 class="mb-0">Pak Andi</h6>
                            <small class="text-muted">Karyawan Swasta</small>
                        </div>
                    </div>

                </div>
            </div>

            <!-- ITEM 3 -->
            <div class="testimonial-item p-4">
                <div class="testimonial-card">

                    <div class="stars mb-2">
                        ⭐⭐⭐⭐⭐
                    </div>

                    <p class="mb-3">
                        "Suka banget sama kebersihannya. Makanannya fresh dan tidak berminyak. Cocok buat keluarga."
                    </p>

                    <div class="d-flex align-items-center">
                        <img src="img/testimonial-3.jpg" class="rounded-circle me-3" width="55">
                        <div>
                            <h6 class="mb-0">Mbak Sari</h6>
                            <small class="text-muted">Ibu Rumah Tangga</small>
                        </div>
                    </div>

                </div>
            </div>

            <!-- ITEM 4 -->
            <div class="testimonial-item p-4">
                <div class="testimonial-card">

                    <div class="stars mb-2">
                        ⭐⭐⭐⭐⭐
                    </div>

                    <p class="mb-3">
                        "Harga terjangkau tapi kualitas premium. Cocok banget buat acara keluarga dan hajatan."
                    </p>

                    <div class="d-flex align-items-center">
                        <img src="img/testimonial-4.jpg" class="rounded-circle me-3" width="55">
                        <div>
                            <h6 class="mb-0">Bapak Dedi</h6>
                            <small class="text-muted">Pelanggan Tetap</small>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
    <!-- Testimonial End -->


    <!-- Blog Start -->
    <div class="container-xxl py-5">
    <div class="container">

        <!-- HEADER -->
        <div class="text-center mx-auto mb-5" style="max-width: 550px;">
            <h1 class="display-5 mb-3">Artikel Terbaru</h1>
            <p class="text-muted">
                Temukan berbagai tips, inspirasi, dan informasi seputar masakan rumahan
                serta panduan memilih catering terbaik untuk kebutuhan Anda.
            </p>
        </div>

        <div class="row g-4">

            <!-- ITEM 1 -->
            <div class="col-lg-4 col-md-6">
                <div class="blog-card">

                    <div class="blog-img">
                        <img src="img/blog-1.jpg" alt="">
                    </div>

                    <div class="blog-content">
                        <a href="#" class="blog-title">
                            Tips Memilih Catering Sehat untuk Keluarga
                        </a>

                        <p class="blog-desc">
                            Pelajari cara memilih catering dengan bahan berkualitas dan proses higienis untuk menjaga kesehatan keluarga Anda.
                        </p>

                        <div class="blog-meta">
                            <span><i class="fa fa-user"></i> Admin</span>
                            <span><i class="fa fa-calendar"></i> 10 Feb 2026</span>
                        </div>
                    </div>

                </div>
            </div>

                <!-- ITEM 2 -->
                <div class="col-lg-4 col-md-6">
                    <div class="blog-card">

                        <div class="blog-img">
                            <img src="img/blog-2.jpg" alt="">
                        </div>

                        <div class="blog-content">
                            <a href="#" class="blog-title">
                                Kenapa Masakan Rumahan Lebih Sehat?
                            </a>

                            <p class="blog-desc">
                                Masakan rumahan menggunakan bahan segar dan minim pengawet sehingga lebih aman dan sehat untuk dikonsumsi setiap hari.
                            </p>

                            <div class="blog-meta">
                                <span><i class="fa fa-user"></i> Admin</span>
                                <span><i class="fa fa-calendar"></i> 12 Feb 2026</span>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- ITEM 3 -->
                <div class="col-lg-4 col-md-6">
                    <div class="blog-card">

                        <div class="blog-img">
                            <img src="img/blog-3.jpg" alt="">
                        </div>

                        <div class="blog-content">
                            <a href="#" class="blog-title">
                                Tips Memilih Menu Catering untuk Acara
                            </a>

                            <p class="blog-desc">
                                Bingung pilih menu? Simak tips memilih menu catering yang cocok untuk acara keluarga maupun kantor.
                            </p>

                            <div class="blog-meta">
                                <span><i class="fa fa-user"></i> Admin</span>
                                <span><i class="fa fa-calendar"></i> 15 Feb 2026</span>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Blog End -->

@endsection

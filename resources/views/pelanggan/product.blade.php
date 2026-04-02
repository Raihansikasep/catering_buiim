@extends('layouts.frontend')
@section('content')

<div class="container-fluid product-header position-relative">
    <div class="overlay-dark"></div>
    <div class="container text-center text-white position-relative">
        <h1 class="display-3 fw-bold mb-3 text-white">Produk Kami</h1>
        <p class="mb-4 mx-auto" style="max-width: 600px;">
            Temukan berbagai pilihan masakan rumahan yang lezat, sehat,
            dan siap memenuhi kebutuhan harian maupun acara spesial Anda.
        </p>
        <div class="d-flex justify-content-center">
            <input type="text"
                   id="searchInput"
                   class="form-control w-50 rounded-pill me-2 px-4"
                   placeholder="Cari menu favorit kamu..."
                   oninput="filterMenu()">
            <button class="btn btn-success rounded-pill px-4" onclick="filterMenu()">
                Cari
            </button>
        </div>
    </div>
</div>

<!-- Product Start -->
<div class="container-xxl py-5">
    <div class="container">

        <div class="row g-0 gx-5 align-items-end">
            <div class="col-lg-6">
                <h1 class="display-5 mb-3">Produk Kami</h1>
                <p>Pilihan catering lezat untuk Anda</p>
            </div>

            {{-- CATEGORY TAB --}}
            <div class="col-lg-6 text-lg-end">
                <ul class="nav nav-pills d-inline-flex mb-5">
                    <li class="nav-item me-2">
                        <a class="btn btn-outline-success border-2 active"
                           data-bs-toggle="pill"
                           href="#tab-all">
                            Semua
                        </a>
                    </li>
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

        <div class="tab-content">

            {{-- SEMUA --}}
            <div id="tab-all" class="tab-pane fade show active">
                <div class="row g-4" id="menu-grid-all">
                    @foreach($menus as $menu)
                        <div class="col-xl-3 col-lg-4 col-md-6 product-item-filter"
                             data-name="{{ strtolower($menu->name) }}">
                            <div class="product-item border rounded shadow-sm">
                                <div class="position-relative bg-light overflow-hidden">
                                    <img class="img-fluid w-100"
                                         src="{{ asset('storage/'.$menu->image) }}"
                                         style="height:220px; object-fit:cover;"
                                         alt="{{ $menu->name }}">
                                    <div class="bg-secondary text-white position-absolute top-0 start-0 m-3 px-2 py-1 rounded">
                                        {{ $menu->category->name }}
                                    </div>
                                </div>
                                <div class="text-center p-4">
                                    <h5 class="mb-2">{{ $menu->name }}</h5>
                                    {{-- FIX: harga dari menu->price --}}
                                    <span class="text-success fw-bold">
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

            {{-- PER KATEGORI --}}
            @foreach($categories as $category)
                <div id="tab-{{ $category->id }}" class="tab-pane fade">
                    <div class="row g-4">
                        @foreach($menus->where('category_id', $category->id) as $menu)
                            <div class="col-xl-3 col-lg-4 col-md-6">
                                <div class="product-item border rounded shadow-sm">
                                    <div class="position-relative bg-light overflow-hidden">
                                        <img class="img-fluid w-100"
                                             src="{{ asset('storage/'.$menu->image) }}"
                                             style="height:220px; object-fit:cover;"
                                             alt="{{ $menu->name }}">
                                        <div class="bg-secondary text-white position-absolute top-0 start-0 m-3 px-2 py-1 rounded">
                                            {{ $category->name }}
                                        </div>
                                    </div>
                                    <div class="text-center p-4">
                                        <h5 class="mb-2">{{ $menu->name }}</h5>
                                        {{-- FIX: harga dari menu->price --}}
                                        <span class="text-success fw-bold">
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
    </div>
</div>

<script>
function filterMenu() {
    const keyword = document.getElementById('searchInput').value.toLowerCase();
    document.querySelectorAll('.product-item-filter').forEach(item => {
        const name = item.dataset.name ?? '';
        item.style.display = name.includes(keyword) ? '' : 'none';
    });
}
</script>

@endsection

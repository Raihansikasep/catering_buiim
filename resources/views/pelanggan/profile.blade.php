@extends('layouts.frontend')
@section('content')

<div class="container py-5">

    <div class="row g-4">

        {{-- SIDEBAR --}}
        <div class="col-lg-4">
            <div class="card border-1 shadow-sm rounded-4 p-4 text-center">

                <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}"
                     class="rounded-circle mx-auto mb-3"
                     width="90">

                <h5 class="fw-semibold mb-1">{{ auth()->user()->name }}</h5>
                <small class="text-muted">{{ auth()->user()->email }}</small>

                <hr class="my-4">

                <a href="{{ route('my.orders') }}"
                   class="btn btn-outline-primary w-100 mb-2 rounded-pill">
                    Pesanan Saya
                </a>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-outline-danger w-100 rounded-pill">
                        Logout
                    </button>
                </form>

            </div>
        </div>

        {{-- CONTENT --}}
        <div class="col-lg-8">
            <div class="card border-1 shadow-sm rounded-4 p-4">

                {{-- TAB --}}
                <ul class="nav nav-pills mb-4 gap-2">

                    <li class="nav-item">
                        <button class="nav-link active rounded-pill px-4"
                                data-bs-toggle="tab" data-bs-target="#info">
                            Info User
                        </button>
                    </li>

                    <li class="nav-item">
                        <button class="nav-link rounded-pill px-4"
                                data-bs-toggle="tab" data-bs-target="#alamat">
                            Alamat
                        </button>
                    </li>

                    <li class="nav-item">
                        <button class="nav-link rounded-pill px-4"
                                data-bs-toggle="tab" data-bs-target="#tracking">
                            Tracking
                        </button>
                    </li>

                    <li class="nav-item">
                        <button class="nav-link rounded-pill px-4"
                                data-bs-toggle="tab" data-bs-target="#riwayat">
                            Riwayat
                        </button>
                    </li>

                </ul>

                {{-- TAB CONTENT --}}
                <div class="tab-content">

                    {{-- INFO --}}
                    <div class="tab-pane fade show active" id="info">

                        <div class="row g-3">

                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <form action="{{ route('profile.update') }}" method="POST">
                                @csrf

                                <div class="row g-3">

                                    <div class="col-md-6">
                                        <label>Nama</label>
                                        <input type="text" name="name" class="form-control"
                                            value="{{ auth()->user()->name }}">
                                    </div>

                                    <div class="col-md-6">
                                        <label>Email</label>
                                        <input type="text" class="form-control"
                                            value="{{ auth()->user()->email }}" disabled>
                                    </div>

                                    <div class="col-12">
                                        <label>No HP</label>
                                        <input type="text" name="phone" class="form-control"
                                            value="{{ auth()->user()->phone }}">
                                    </div>

                                    <div class="col-12">
                                        <label>Alamat</label>
                                        <textarea name="address" class="form-control" rows="3">{{ auth()->user()->address }}</textarea>
                                    </div>

                                    <div class="col-12 text-end">
                                        <button class="btn btn-primary px-4 rounded-pill">
                                            Simpan
                                        </button>
                                    </div>

                                </div>

                            </form>

                        </div>

                    </div>

                    {{-- ALAMAT --}}
                    <div class="tab-pane fade" id="alamat">

                        <div class="border rounded-3 p-3 mb-3 bg-light">
                            <strong>Alamat Utama</strong>
                            <p class="mb-0 text-muted">
                                Belum ada alamat
                            </p>
                        </div>

                        <textarea class="form-control mb-3" rows="3"
                            placeholder="Masukkan alamat lengkap"></textarea>

                        <div class="text-end">
                            <button class="btn btn-primary px-4 rounded-pill">
                                Simpan Alamat
                            </button>
                        </div>

                    </div>

                    {{-- TRACKING --}}
                    <div class="tab-pane fade" id="tracking">

                        <div class="text-center py-5 text-muted">
                            Belum ada pesanan yang sedang diproses
                        </div>

                    </div>

                    {{-- RIWAYAT --}}
                    <div class="tab-pane fade" id="riwayat">

                        <div class="text-center py-5 text-muted">
                            Belum ada riwayat pesanan
                        </div>

                    </div>

                </div>

            </div>
        </div>

    </div>

</div>

@endsection
@extends('layouts.frontend')
@section('content')


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

    @endsection
@extends('layouts.frontend')
@section('content')

<!-- HEADER -->
<div class="container-fluid product-header position-relative">
    <div class="overlay-dark"></div>

    <div class="container text-center text-white position-relative">
        <h1 class="display-3 fw-bold mb-3 text-white">
            Hubungi Kami
        </h1>

        <p class="mb-4 mx-auto" style="max-width: 600px;">
            Punya pertanyaan atau ingin pesan catering? 
            Hubungi kami langsung melalui WhatsApp, kami siap membantu Anda.
        </p>
    </div>
</div>


<!-- CONTACT -->
<div class="container-xxl py-6">
    <div class="container">
        <div class="row g-5 align-items-center">

            <!-- INFO -->
            <div class="col-lg-5">
                <div class="p-5 text-white rounded-4" 
                     style="background: linear-gradient(135deg,#22c55e,#16a34a);">

                    <h3 class="mb-4 text-white">Informasi Kontak</h3>

                    <p class="mb-3">
                        <i class="fa fa-map-marker-alt me-2"></i>
                        Bandung, Indonesia
                    </p>

                    <p class="mb-3">
                        <i class="fa fa-phone-alt me-2"></i>
                        +62 821 2953 9896
                    </p>

                    <p class="mb-4">
                        <i class="fab fa-whatsapp me-2"></i>
                        WhatsApp Aktif 24 Jam
                    </p>

                    <!-- BUTTON WA -->
                    <a href="https://wa.me/6282129539896" target="_blank"
                       class="btn btn-light w-100 rounded-pill py-3 fw-bold">
                        <i class="fab fa-whatsapp me-2"></i>
                        Chat WhatsApp Sekarang
                    </a>
                </div>
            </div>


            <!-- FORM WA -->
            <div class="col-lg-7">
                <div class="p-5 bg-light rounded-4 shadow-sm">

                    <h3 class="mb-4">Kirim Pesan Cepat</h3>

                    <div class="row g-3">

                        <div class="col-md-6">
                            <input type="text" id="nama" class="form-control rounded-pill px-4" placeholder="Nama Anda">
                        </div>

                        <div class="col-md-6">
                            <input type="text" id="telepon" class="form-control rounded-pill px-4" placeholder="No HP">
                        </div>

                        <div class="col-12">
                            <textarea id="pesan" class="form-control rounded-4 px-4" rows="5"
                                placeholder="Tulis pesan atau pesanan Anda..."></textarea>
                        </div>

                        <div class="col-12">
                            <button onclick="kirimWA()" 
                                class="btn btn-success w-100 rounded-pill py-3 fw-bold">
                                <i class="fab fa-whatsapp me-2"></i>
                                Kirim via WhatsApp
                            </button>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<!-- MAP -->
<div class="container-xxl px-0">
    <iframe class="w-100 rounded shadow"
    style="height: 450px; border:0;"
    loading="lazy"
    allowfullscreen
    referrerpolicy="no-referrer-when-downgrade"
    src="https://maps.google.com/maps?q=Baleendah,%20Kabupaten%20Bandung&t=&z=14&ie=UTF8&iwloc=&output=embed">
</iframe>
</div>


<!-- SCRIPT WA -->
<script>
function kirimWA() {
    let nama = document.getElementById('nama').value;
    let telepon = document.getElementById('telepon').value;
    let pesan = document.getElementById('pesan').value;

    let text = `Halo, saya ${nama}%0A` +
               `No HP: ${telepon}%0A` +
               `Pesan: ${pesan}`;

    window.open(`https://wa.me/6282129539896?text=${text}`, '_blank');
}
</script>

@endsection
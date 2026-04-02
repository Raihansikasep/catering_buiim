@extends('layouts.frontend')
@section('content')

<!-- PAGE HEADER (UPGRADE) -->
<div class="container-fluid page-header-modern mb-5">
    <div class="container text-center text-white">
        <h1 class="display-3 text-white fw-bold">Tentang Kami</h1>
    </div>
</div>


<!-- ABOUT (STORY SECTION) -->
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
                <div class="col-lg-6">
                <h1 class="display-5 mb-4">
                    Masakan Rumahan yang 
                    <span class="text-success">Sehat</span> & 
                    <span class="text-secondary">Lezat</span>
                </h1>

                <p class="text-muted mb-4">
                    <strong>Dapur Bu Iim</strong> hadir untuk memberikan pengalaman makan terbaik 
                    dengan cita rasa khas rumahan yang autentik. Kami percaya bahwa makanan yang baik 
                    bukan hanya soal rasa, tetapi juga tentang kualitas, kebersihan, dan kehangatan 
                    yang dirasakan oleh setiap pelanggan.
                </p>

                <p class="text-muted mb-4">
                    Dengan bahan pilihan yang segar dan proses memasak yang higienis, 
                    kami berkomitmen menghadirkan hidangan yang tidak hanya lezat, 
                    tetapi juga sehat dan aman untuk dikonsumsi setiap hari.
                </p>

                <div class="row g-3 mb-4">
                    <div class="col-sm-6">
                        <p><i class="fa fa-check text-success me-2"></i>Bahan segar & berkualitas</p>
                        <p><i class="fa fa-check text-success me-2"></i>Masakan rumahan autentik</p>
                    </div>
                    <div class="col-sm-6">
                        <p><i class="fa fa-check text-success me-2"></i>Proses higienis</p>
                        <p><i class="fa fa-check text-success me-2"></i>Rasa terjamin lezat</p>
                    </div>
                </div>
            </div>

            </div>
        </div>
    </div>

<!-- KOMITMEN (GANTI VISIT JADI LEBIH MASUK) -->
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


<!-- KEUNGGULAN (TETAP, TAPI NYAMBUNG) -->
<div class="container-fluid bg-light py-6">
    <div class="container">

        <!-- HEADER -->
        <div class="text-center mx-auto mb-5" style="max-width: 550px;">
            <h1 class="display-5 mb-3">Keunggulan Kami</h1>
            <p class="text-muted">
                Kami berkomitmen menghadirkan masakan rumahan berkualitas dengan bahan terbaik, 
                rasa lezat, dan proses higienis untuk kepuasan Anda.
            </p>
        </div>

        <div class="row g-4">

            <!-- ITEM 1 -->
            <div class="col-lg-4 col-md-6">
                <div class="feature-card text-center p-4">
                    <div class="icon-box mb-4">
                        <img src="img/icon-1.png">
                    </div>

                    <h4 class="mb-3">Bahan Berkualitas</h4>
                    <p class="text-muted">
                        Menggunakan bahan segar pilihan untuk kualitas terbaik.
                    </p>

                    <button class="btn btn-outline-success btn-sm rounded-pill mt-2"
                        data-bs-toggle="modal"
                        data-bs-target="#featureModal"
                        data-title="Bahan Berkualitas"
                        data-desc="Kami hanya menggunakan bahan segar pilihan dari supplier terpercaya."
                        data-full="Setiap bahan dipilih dengan standar tinggi, memastikan kebersihan, kesegaran, dan kualitas terbaik sehingga menghasilkan hidangan yang sehat, lezat, dan bernutrisi.">
                        Baca Selengkapnya
                    </button>
                </div>
            </div>

            <!-- ITEM 2 -->
            <div class="col-lg-4 col-md-6">
                <div class="feature-card text-center p-4">
                    <div class="icon-box mb-4">
                        <img src="img/icon-1.png">
                    </div>

                    <h4 class="mb-3">Masakan Rumahan</h4>
                    <p class="text-muted">
                        Cita rasa khas rumahan yang autentik dan lezat.
                    </p>

                    <button class="btn btn-outline-success btn-sm rounded-pill mt-2"
                        data-bs-toggle="modal"
                        data-bs-target="#featureModal"
                        data-title="Masakan Rumahan"
                        data-desc="Menghadirkan rasa rumahan yang autentik dan menggugah selera."
                        data-full="Setiap hidangan dimasak dengan resep tradisional dan sentuhan profesional, memberikan rasa yang familiar, lezat, dan cocok untuk semua kalangan.">
                        Baca Selengkapnya
                    </button>
                </div>
            </div>

            <!-- ITEM 3 -->
            <div class="col-lg-4 col-md-6">
                <div class="feature-card text-center p-4">
                    <div class="icon-box mb-4">
                        <img src="img/icon-1.png">
                    </div>

                    <h4 class="mb-3">Aman & Higienis</h4>
                    <p class="text-muted">
                        Proses memasak dengan standar kebersihan tinggi.
                    </p>

                    <button class="btn btn-outline-success btn-sm rounded-pill mt-2"
                        data-bs-toggle="modal"
                        data-bs-target="#featureModal"
                        data-title="Aman & Higienis"
                        data-desc="Semua proses dilakukan dengan standar kebersihan tinggi."
                        data-full="Kami memastikan setiap proses pengolahan makanan dilakukan secara higienis tanpa bahan berbahaya, sehingga aman dikonsumsi setiap hari oleh keluarga Anda.">
                        Baca Selengkapnya
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>


<!-- MODAL -->
<div class="modal fade" id="featureModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content premium-modal">

            <div class="modal-header premium-header">
                <h5 class="modal-title" id="modalTitle"></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <p class="text-muted" id="modalDesc"></p>
                <hr>
                <p id="modalFull"></p>
            </div>

        </div>
    </div>
</div>

@endsection

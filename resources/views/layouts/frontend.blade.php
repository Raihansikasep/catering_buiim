<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Dapur Ibu Iim</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Lora:wght@600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <style>
        /* FIX JARAK FOOTER */
.footer-modern {
    margin-top: 0 !important;
    background: #111;
    position: relative;
}

/* Memberi ruang nyaman di atas footer */
.footer-modern .container.py-5 {
    padding-top: 100px !important;   /* Bisa diubah: 90px / 110px / 120px */
    padding-bottom: 60px !important;
}

/* Gradient transisi halus agar tidak terlalu kasar */
/* .footer-modern::before {
    content: '';
    position: absolute;
    top: -70px;
    left: 0;
    right: 0;
    height: 90px;
    background: linear-gradient(to bottom, transparent, #111111);
    pointer-events: none;
    z-index: 1;
} */

/* Copyright */
.footer-bottom {
    border-top: 1px solid #222;
    background: #0a0a0a;
    padding: 25px 0;
}
    </style>
</head>

<body>
    <div class="wrapper">

        <!-- Navbar Start -->
        @include("layouts.component_pelanggan.navbar")
        <!-- Navbar End -->

        <!-- Main Content -->
        <main>
            @yield('content')
        </main>

        <!-- Footer Start -->
        @include("layouts.component_pelanggan.footer")
        <!-- Footer End -->

    </div>

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Script Kamu -->
    <script>
        // Script user card, modal, filter, dll... (biarkan tetap sama)
        const toggle = document.getElementById('userToggle');
        const card = document.getElementById('userCard');

        if (toggle && card) {
            toggle.addEventListener('click', function (e) {
                e.preventDefault();
                card.style.display = (card.style.display === 'block') ? 'none' : 'block';
            });

            document.addEventListener('click', function (e) {
                if (!toggle.contains(e.target) && !card.contains(e.target)) {
                    card.style.display = 'none';
                }
            });
        }
    </script>

    <!-- Script lain kamu tetap di sini... -->
    @stack('scripts')

</body>
</html>

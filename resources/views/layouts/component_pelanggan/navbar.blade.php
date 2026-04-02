<!-- Navbar Start -->
<div class="container-fluid fixed-top px-0 wow fadeIn" data-wow-delay="0.1s">
    
    <!-- TOP BAR -->
    <div class="top-bar row gx-0 align-items-center d-none d-lg-flex">
        <div class="col-lg-6 px-5 text-start">
            <small><i class="fa fa-map-marker-alt me-2"></i>Bojong Malaka Indah No. 13, Bandung, Indonesia</small>
            <small class="ms-4"><i class="fa fa-envelope me-2"></i>CateringBuiim@gmail.com</small>
        </div>
        <div class="col-lg-6 px-5 text-end">
            <small>Ikuti Kami:</small>
            <a class="text-body ms-3" href=""><i class="fab fa-facebook-f"></i></a>
            <a class="text-body ms-3" href=""><i class="fab fa-twitter"></i></a>
            <a class="text-body ms-3" href=""><i class="fab fa-linkedin-in"></i></a>
            <a class="text-body ms-3" href=""><i class="fab fa-instagram"></i></a>
        </div>
    </div>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-light py-lg-0 px-lg-5 wow fadeIn">
        
        <!-- LOGO -->
        <a href="{{ route('home') }}" class="navbar-brand ms-4 ms-lg-0">
            <h1 class="fw-bold text-success m-0">Dapur<span class="text-secondary">Bu</span>iim</h1>
        </a>

        <!-- TOGGLE -->
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">
            
            <div class="navbar-nav ms-auto p-4 p-lg-0">

                <!-- MENU -->
                <a href="{{ route('home') }}" 
                   class="nav-item nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                   Beranda
                </a>

                <a href="{{ route('about') }}" 
                   class="nav-item nav-link {{ request()->routeIs('about') ? 'active' : '' }}">
                   Tentang Kami
                </a>

                <a href="{{ route('product') }}" 
                   class="nav-item nav-link {{ request()->routeIs('product') ? 'active' : '' }}">
                   Produk
                </a>

                <!-- DROPDOWN -->
                <div class="nav-item dropdown">
                    <a href="#" 
                       class="nav-link dropdown-toggle 
                       {{ request()->routeIs('blog') || request()->routeIs('feature') || request()->routeIs('testimonial') ? 'active' : '' }}" 
                       data-bs-toggle="dropdown">
                       Halaman
                    </a>

                    <div class="dropdown-menu m-0">
                        <a href="{{ route('blog') }}" 
                           class="dropdown-item {{ request()->routeIs('blog') ? 'active' : '' }}">
                           Blog
                        </a>

                        <a href="{{ route('testimonial') }}" 
                           class="dropdown-item {{ request()->routeIs('testimonial') ? 'active' : '' }}">
                           Ulasan Pelanggan
                        </a>
                    </div>
                </div>

                <a href="{{ route('contact') }}" 
                   class="nav-item nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">
                   Kontak
                </a>
            </div>

            <!-- ICON -->
            <div class="d-none d-lg-flex ms-2">
                <div class="position-relative ms-3">
                    <a href="#" id="userToggle" class="btn-sm-square bg-white rounded-circle">
                        <small class="fa fa-user text-body"></small>
                    </a>

                    <!-- CARD DROPDOWN -->
                    <div id="userCard" class="user-card shadow">
                        @guest
                            <a href="{{ route('login') }}" class="dropdown-item">Login</a>
                            <a href="{{ route('register') }}" class="dropdown-item">Register</a>
                        @endguest

                        @auth
                            <div class="px-3 py-2">
                                <strong>{{ auth()->user()->name }}</strong>
                                <br>
                                <small class="text-muted">{{ auth()->user()->email }}</small>
                            </div>

                            <hr class="m-0">

                            <a href="{{ route('profile') }}" class="dropdown-item">
                                Profile Saya
                            </a>
                        @endauth
                    </div>
                </div>
                <a href="{{ route('cart') }}" 
                class="btn-sm-square bg-white rounded-circle ms-3 {{ request()->routeIs('cart') ? 'active' : '' }}">
                    <small class="fa fa-shopping-bag text-body"></small>
                </a>
            </div>

        </div>
    </nav>
</div>
<!-- Navbar End -->
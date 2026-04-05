{{-- Header / Navbar --}}
<header class="header">
    <div class="container">
        <a href="{{ route('home') }}" class="logo">
            <img src="{{ asset('images/logo.png') }}" class="navbar-logo" alt="Logo Go Green School">
            <div class="logo-text">
                <h1>Go Green School</h1>
                <span>Sekolah Hijau untuk Masa Depan</span>
            </div>
        </a>

        <nav>
            <ul class="nav-menu" id="navMenu">
                <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a>
                </li>
                <li><a href="{{ route('programs') }}"
                        class="{{ request()->routeIs('programs') ? 'active' : '' }}">Program</a></li>
                <li><a href="{{ route('gallery') }}"
                        class="{{ request()->routeIs('gallery') ? 'active' : '' }}">Galeri</a></li>
                <li><a href="{{ route('news') }}" class="{{ request()->routeIs('news') ? 'active' : '' }}">Berita</a>
                </li>
                <li><a href="{{ route('information') }}"
                        class="{{ request()->routeIs('information') ? 'active' : '' }}">Informasi</a></li>
                <li><a href="{{ route('procedure') }}"
                        class="{{ request()->routeIs('procedure') ? 'active' : '' }}">Prosedur</a></li>
                <li><a href="{{ route('contact') }}"
                        class="{{ request()->routeIs('contact') ? 'active' : '' }}">Kontak</a></li>
                <li><a href="{{ route('developer-profile') }}"
                        class="{{ request()->routeIs('developer-profile') ? 'active' : '' }}">Developer</a></li>
                <li><a href="{{ route('waste-calculator') }}"
                        class="{{ request()->routeIs('waste-calculator') ? 'active' : '' }}">Kalkulator Sampah</a></li>
            </ul>
        </nav>

        <div class="nav-right">
            <button class="hamburger" id="hamburger" aria-label="Toggle menu">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </div>
</header>

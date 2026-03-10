{{-- Header / Navbar --}}
<header class="header">
    <div class="container">
        <a href="{{ route('home') }}" class="logo">
            <div class="logo-icon">
                <i class="fas fa-leaf"></i>
            </div>
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
                <li><a href="{{ route('contact') }}"
                        class="{{ request()->routeIs('contact') ? 'active' : '' }}">Kontak</a></li>
            </ul>
        </nav>

        <div class="nav-right">
            <div class="search-box">
                <input type="text" placeholder="Cari informasi..." aria-label="Search">
                <i class="fas fa-search"></i>
            </div>
            <button class="hamburger" id="hamburger" aria-label="Toggle menu">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </div>
</header>

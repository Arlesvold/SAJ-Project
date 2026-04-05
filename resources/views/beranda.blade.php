<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Go Green School - Sekolah Hijau untuk Masa Depan. Program pendidikan lingkungan untuk generasi peduli bumi.">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Go Green School - Sekolah Hijau untuk Masa Depan')</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="{{ asset('css/gogreen.css') }}">
    @stack('styles')
</head>

<body>
    {{-- Preloader --}}
    <div class="preloader" id="preloader">
        <div class="preloader-icon">
            <img src="{{ asset('images/logo.png') }}" alt="Logo Go Green School" loading="eager">
        </div>
        <div class="preloader-text">GO GREEN SCHOOL</div>
        <div class="preloader-bar">
            <div class="preloader-bar-inner"></div>
        </div>
    </div>

    {{-- Scroll Progress Bar --}}
    <div class="scroll-progress" id="scrollProgress"></div>

    {{-- Toast Container --}}
    <div class="toast-container" id="toastContainer"></div>

    {{-- Dark Mode Toggle --}}
    <button class="dark-toggle" id="darkToggle" title="Mode Gelap" aria-label="Toggle dark mode">
        <i class="fas fa-moon"></i>
    </button>

    {{-- Language Toggle --}}
    <button class="lang-toggle" id="langToggle" title="Ganti Bahasa" aria-label="Toggle language">
        <i class="fas fa-language"></i>
        <span class="lang-toggle-text">ID</span>
    </button>
    <div id="google_translate_element" class="google-translate-element" aria-hidden="true"></div>

    {{-- Top Bar --}}
    {{-- Top Bar --}}
    <div class="top-bar">
        <div class="container">
            <div class="date-info">
                <i class="far fa-calendar-alt"></i>
                <span id="currentDate">{{ now()->locale('id')->translatedFormat('l, j F Y') }}</span>
                <span class="live-clock" id="liveClock"><i class="far fa-clock"></i> --:--:--</span>
            </div>
            <div class="quick-links">
                <a href="{{ route('contact') }}#contact"><i class="fas fa-phone-alt"></i> Hubungi Kami</a>
                <a href="#"><i class="fas fa-question-circle"></i> FAQ</a>
            </div>
        </div>
    </div>


    {{-- Header --}}
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
                    <li><a href="{{ route('home') }}"
                            class="{{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a></li>
                    <li><a href="{{ route('programs') }}">Program</a></li>
                    <li><a href="{{ route('gallery') }}">Galeri</a></li>
                    <li><a href="{{ route('news') }}">Berita</a></li>
                    <li><a href="{{ route('information') }}">Informasi</a></li>
                    <li><a href="{{ route('procedure') }}">Prosedur</a></li>
                    <li><a href="{{ route('contact') }}">Kontak</a></li>
                    <li><a href="{{ route('waste-calculator') }}">Kalkulator Sampah</a></li>
                </ul>
            </nav>

            <div class="nav-right">
                <button class="hamburger" id="hamburger" aria-label="Toggle menu">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
    </header>


    {{-- Main Content --}}
    <main>





        {{-- Hero Section --}}
        {{-- Hero Section --}}
        @php
            $heroImages = [
                'https://images.unsplash.com/photo-1425913397330-cf8af2ff40a1?auto=format&fit=crop&w=1800&q=80',
                'https://images.unsplash.com/photo-1473448912268-2022ce9509d8?auto=format&fit=crop&w=1800&q=80',
                'https://images.unsplash.com/photo-1497250681960-ef046c08a56e?auto=format&fit=crop&w=1800&q=80',
            ];
        @endphp
        <section class="hero">
            <canvas class="leaves-canvas" id="leavesCanvas"></canvas>
            <div class="hero-bg-shapes">
                <div class="shape"></div>
                <div class="shape"></div>
                <div class="shape"></div>
            </div>

            <div class="hero-slider">
                @foreach ($slides as $index => $slide)
                    <div class="hero-slide {{ $index === 0 ? 'active' : '' }}"
                        style="background-image: url('{{ $heroImages[$index % count($heroImages)] }}');">
                        <div class="hero-content">
                            <div class="container">
                                <div class="hero-left">
                                    <h2>{{ $slide['title'] }} <span>{{ $slide['accent'] }}</span></h2>
                                    <p>{{ $slide['desc'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Hero Dots --}}
            <div class="hero-dots">
                @foreach ($slides as $index => $slide)
                    <div class="hero-dot {{ $index === 0 ? 'active' : '' }}" data-slide="{{ $index }}"></div>
                @endforeach
            </div>
            <div class="swipe-hint"><i class="fas fa-hand-point-up"></i> Geser untuk slide berikutnya</div>
        </section>

        {{-- Description / Tentang Section --}}
        <section class="about-section" style="padding: 80px 0; background: #ffffff;">
            <div class="container">
                <div style="display: flex; flex-wrap: wrap; align-items: center; gap: 50px;">
                    <div class="about-content fade-in" style="flex: 1; min-width: 300px;">
                        <div class="section-title" style="text-align: left; margin-bottom: 20px;">
                            <h2 style="margin-bottom: 10px;">Tentang Go Green School</h2>
                            <div
                                style="width: 80px; height: 4px; background: var(--primary-color, #2e7d32); border-radius: 2px;">
                            </div>
                        </div>
                        <p style="font-size: 1.1rem; line-height: 1.8; color: #555; margin-bottom: 20px;">
                            <strong>Go Green School</strong> Go Green School adalah platform digital edukatif yang
                            dirancang untuk mendukung transformasi sekolah menjadi institusi yang lebih sadar dan
                            bertanggung jawab terhadap lingkungan. Melalui penyediaan berbagai literasi, panduan
                            praktis, dan sumber daya informatif, kami membantu guru serta siswa untuk merancang
                            sekaligus mengembangkan program lingkungan yang efektif dan berdampak nyata bagi seluruh
                            komunitas sekolah.
                        </p>
                        <p style="font-size: 1.1rem; line-height: 1.8; color: #555; margin-bottom: 30px;">
                            Kami berkomitmen menciptakan ekosistem belajar yang mengintegrasikan nilai-nilai ekologis ke
                            dalam rutinitas harian melalui penerapan prinsip 4R yaitu Reduce, Reuse, Recycle, dan
                            Replant yang bertujuan untuk efisiensi energi. Dengan menggabungkan teori akademik dan aksi
                            nyata, Go Green School bertujuan untuk melahirkan generasi yang tidak hanya unggul dalam
                            pengetahuan, tetapi juga memiliki karakter dan kebiasaan hidup berkelanjutan demi menjaga
                            kelestarian bumi.
                        </p>
                        <a href="{{ route('information') }}" class="btn-primary"
                            style="display: inline-flex; align-items: center; gap: 8px;">
                            <i class="fas fa-info-circle"></i> Pelajari Lebih Lanjut
                        </a>
                    </div>
                    <div class="about-visual fade-in" style="flex: 1; min-width: 300px;">
                        <div class="hover-lift"
                            style="background: linear-gradient(145deg, #f1f8e9, #e8f5e9); padding: 40px; border-radius: 20px; text-align: center; position: relative; overflow: hidden; border: 1px solid rgba(46,125,50,0.1);">
                            <i class="fas fa-globe-asia"
                                style="font-size: 5rem; color: var(--primary-color, #2e7d32); margin-bottom: 20px;"></i>
                            <h3 style="font-size: 1.5rem; color: #333; margin-bottom: 15px;">Visi Hijau Kami</h3>
                            <p style="color: #666; line-height: 1.6; position: relative; z-index: 2;">
                                Menciptakan ekosistem pendidikan yang harmonis dengan alam, mencetak pemimpin masa depan
                                yang proaktif, peduli, dan bertanggung jawab terhadap lingkungan sekitarnya.
                            </p>
                            <!-- Decorative Elements -->
                            <div
                                style="position: absolute; top: -30px; right: -30px; width: 120px; height: 120px; background: rgba(129,199,132,0.3); border-radius: 50%; filter: blur(20px);">
                            </div>
                            <div
                                style="position: absolute; bottom: -30px; left: -30px; width: 120px; height: 120px; background: rgba(46,125,50,0.2); border-radius: 50%; filter: blur(20px);">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- Programs Section --}}
        {{-- Programs Section --}}
        <section class="programs-section" id="programs">
            <div class="container">
                <div class="section-title">
                    <div>
                        <h2>Program Unggulan</h2>
                        <p>Program lingkungan yang dijalankan di sekolah kami</p>
                    </div>
                    <a href="{{ route('programs') }}" class="see-all">Lihat Semua <i
                            class="fas fa-arrow-right"></i></a>
                </div>

                <div class="programs-tabs">
                    <button class="tab active">Semua</button>
                    <button class="tab">Penghijauan</button>
                    <button class="tab">Konservasi</button>
                    <button class="tab">Daur Ulang</button>
                    <button class="tab">Edukasi</button>
                </div>

                <div class="programs-grid">
                    @foreach ($programs as $program)
                        <a href="{{ route('programs', ['program' => $program['title']]) }}"
                            class="program-card hover-lift fade-in"
                            data-category="{{ strtolower($program['category']) }}"
                            style="text-decoration:none; color:inherit;">
                            <div class="program-card-img" style="background-image: url('{{ $program['image'] }}')">
                                <span class="tag"
                                    style="background: {{ $program['tag_bg'] ?? 'var(--primary-color)' }}">{{ $program['category'] }}</span>
                            </div>
                            <div class="program-card-body">
                                <h3>{{ $program['title'] }}</h3>
                                <p>{{ $program['desc'] }}</p>
                                <div class="program-card-footer">
                                    <span class="date"><i class="{{ $program['icon'] ?? 'far fa-calendar' }}"></i>
                                        {{ $program['schedule'] ?? 'Setiap Hari' }}</span>
                                    <span class="read-more">Selengkapnya <i class="fas fa-arrow-right"></i></span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
        {{-- Gallery Section --}}
        <section class="gallery-section" id="gallery">
            <div class="container">
                <div class="section-title">
                    <div>
                        <h2>Galeri Kegiatan</h2>
                        <p>Dokumentasi kegiatan lingkungan di sekolah</p>
                    </div>
                    <a href="{{ route('gallery') }}" class="see-all">Lihat Semua <i
                            class="fas fa-arrow-right"></i></a>
                </div>

                <div class="gallery-grid">
                    @foreach ($gallery as $item)
                        <div class="gallery-item hover-lift fade-in">
                            <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" loading="lazy">
                            <div class="overlay">
                                <h4>{{ $item['title'] }}</h4>
                                <span>{{ $item['cat'] ?? ($item['date'] ?? '') }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>


        {{-- Quick Access --}}
        {{-- Quick Access Section --}}
        <section class="quick-access" id="access">
            <div class="container">
                <div class="section-title">
                    <div>
                        <h2>Akses Informasi</h2>
                        <p>Akses cepat ke berbagai layanan dan informasi</p>
                    </div>
                </div>

                <div class="quick-grid">
                    @foreach ($quickAccess as $item)
                        <a href="{{ route($item['route'] ?? 'information') }}" class="quick-item hover-lift fade-in">
                            <div class="icon" style="background: {{ $item['gradient'] }};">
                                <i class="{{ $item['icon'] }}"></i>
                            </div>
                            <h4>{{ $item['title'] }}</h4>
                            <p>{{ $item['desc'] }}</p>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>


        {{-- News Section --}}
        {{-- News Section --}}
        <section class="news-section" id="news">
            <div class="container">
                <div class="section-title">
                    <div>
                        <h2>Berita Terbaru</h2>
                        <p>Berita dan kegiatan terkini dari Go Green School</p>
                    </div>
                    <a href="{{ route('news') }}" class="see-all">Lihat Semua <i class="fas fa-arrow-right"></i></a>
                </div>

                <div class="news-tabs">
                    <button class="tab active">Berita Utama</button>
                    <button class="tab">Kegiatan</button>
                    <button class="tab">Prestasi</button>
                </div>

                <div class="news-layout">
                    {{-- Featured News --}}
                    <a href="{{ route('news') }}" class="news-featured hover-lift fade-in"
                        style="display:block; text-decoration:none; color:inherit;">
                        <img src="{{ $news['featured']['image'] }}" alt="{{ $news['featured']['title'] }}"
                            loading="lazy">
                        <div class="content">
                            <div class="date"><i class="far fa-calendar"></i> {{ $news['featured']['date'] }}</div>
                            <h3>{{ $news['featured']['title'] }}</h3>
                            <p>{{ $news['featured']['desc'] }}</p>
                        </div>
                    </a>

                    {{-- News List --}}
                    <div class="news-list">
                        @foreach ($news['items'] as $item)
                            <a href="{{ route('news') }}" class="news-item hover-lift fade-in">
                                <div class="news-item-img">
                                    <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" loading="lazy">
                                </div>
                                <div class="news-item-body">
                                    <div class="date">{{ $item['date'] }}</div>
                                    <h4>{{ $item['title'] }}</h4>
                                    <p>{{ $item['desc'] }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>


        {{-- Partners Section --}}
        {{-- Partners Section --}}
        <section class="partners-section">
            <div class="container">
                <h3>Didukung Oleh</h3>
                <div class="partners-logos">
                    @foreach ($partners as $partner)
                        <div class="partner-logo hover-lift">
                            <span class="tooltip-custom">{{ $partner['name'] }}</span>
                            <i class="{{ $partner['icon'] }}"></i>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>



    </main>

    {{-- Footer --}}
    @include('partials.footer')


    {{-- Back To Top --}}
    <button class="back-to-top" id="backToTop" aria-label="Back to top">
        <i class="fas fa-chevron-up"></i>
    </button>

    {{-- Lightbox Modal --}}
    <div class="lightbox" id="lightbox" role="dialog" aria-modal="true" aria-label="Image lightbox">
        <span class="lightbox-counter" id="lightboxCounter">1 / 6</span>
        <button class="lightbox-close" id="lightboxClose" aria-label="Close lightbox"><i
                class="fas fa-times"></i></button>
        <button class="lightbox-nav lightbox-prev" id="lightboxPrev" aria-label="Previous image"><i
                class="fas fa-chevron-left"></i></button>
        <button class="lightbox-nav lightbox-next" id="lightboxNext" aria-label="Next image"><i
                class="fas fa-chevron-right"></i></button>
        <img id="lightboxImg" src="" alt="Gallery image">
        <div class="lightbox-caption" id="lightboxCaption">
            <h4></h4><span></span>
        </div>
    </div>

    <script src="{{ asset('js/gogreen.js') }}"></script>
    @stack('scripts')
</body>

</html>

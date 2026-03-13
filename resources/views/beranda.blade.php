<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Go Green School - Sekolah Hijau untuk Masa Depan. Program pendidikan lingkungan untuk generasi peduli bumi.">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Go Green School - Sekolah Hijau untuk Masa Depan')</title>
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
        <div class="preloader-icon"><i class="fas fa-leaf"></i></div>
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
                <a href="#contact"><i class="fas fa-phone-alt"></i> Hubungi Kami</a>
                <a href="mailto:info@gogreenschool.id"><i class="fas fa-envelope"></i> Email</a>
                <a href="#"><i class="fas fa-question-circle"></i> FAQ</a>
            </div>
        </div>
    </div>


    {{-- Header --}}
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
                    <li><a href="{{ route('home') }}"
                            class="{{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a></li>
                    <li><a href="{{ route('programs') }}">Program</a></li>
                    <li><a href="{{ route('gallery') }}">Galeri</a></li>
                    <li><a href="{{ route('news') }}">Berita</a></li>
                    <li><a href="{{ route('information') }}">Informasi</a></li>
                    <li><a href="{{ route('contact') }}">Kontak</a></li>
                    <li><a href="{{ route('waste-calculator') }}">Kalkulator Sampah</a></li>
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


    {{-- Main Content --}}
    <main>





        {{-- Hero Section --}}
        {{-- Hero Section --}}
        <section class="hero">
            <canvas class="leaves-canvas" id="leavesCanvas"></canvas>
            <div class="hero-bg-shapes">
                <div class="shape"></div>
                <div class="shape"></div>
                <div class="shape"></div>
            </div>

            <div class="hero-slider">
                @foreach ($slides as $index => $slide)
                    <div class="hero-slide {{ $index === 0 ? 'active' : '' }}">
                        <div class="hero-content">
                            <div class="container">
                                <div class="hero-left">
                                    <div class="hero-badge">
                                        <i class="{{ $slide['badge']['icon'] }}"></i>&nbsp;
                                        {{ $slide['badge']['text'] }}
                                    </div>
                                    <h2>{{ $slide['title'] }} <span>{{ $slide['accent'] }}</span></h2>
                                    <p>{{ $slide['desc'] }}</p>
                                    <div class="hero-buttons">
                                        @foreach ($slide['buttons'] as $btn)
                                            <a href="{{ $btn['href'] }}" class="{{ $btn['class'] }}">
                                                <i class="{{ $btn['icon'] }}"></i> {{ $btn['text'] }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="hero-right">
                                    <div class="hero-card">
                                        <h3><i class="{{ $slide['card']['icon'] }}"></i> {{ $slide['card']['title'] }}
                                        </h3>
                                        @foreach ($slide['card']['stats'] as $stat)
                                            <div class="eco-stat">
                                                <div class="eco-stat-icon" style="background:{{ $stat['color'] }}">
                                                    <i class="{{ $stat['icon'] }}"></i>
                                                </div>
                                                <div class="eco-stat-info">
                                                    <h4>{{ $stat['value'] }}</h4>
                                                    <span>{{ $stat['label'] }}</span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
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
                            <div style="width: 80px; height: 4px; background: var(--primary-color, #2e7d32); border-radius: 2px;"></div>
                        </div>
                        <p style="font-size: 1.1rem; line-height: 1.8; color: #555; margin-bottom: 20px;">
                            <strong>Go Green School</strong> adalah inisiatif pendidikan berkelanjutan yang didedikasikan untuk menanamkan kesadaran lingkungan pada generasi muda. Kami percaya bahwa sekolah bukan hanya tempat belajar akademis, tetapi juga laboratorium hidup untuk mempraktikkan gaya hidup ramah lingkungan.
                        </p>
                        <p style="font-size: 1.1rem; line-height: 1.8; color: #555; margin-bottom: 30px;">
                            Melalui berbagai program terpadu seperti pengelolaan sampah, efisiensi energi, dan pelestarian ruang terbuka hijau, kami mengajak seluruh warga sekolah untuk mengambil peran aktif dalam menjaga kelestarian bumi demi masa depan yang lebih baik.
                        </p>
                        <a href="{{ route('information') }}" class="btn-primary" style="display: inline-flex; align-items: center; gap: 8px;">
                            <i class="fas fa-info-circle"></i> Pelajari Lebih Lanjut
                        </a>
                    </div>
                    <div class="about-visual fade-in" style="flex: 1; min-width: 300px;">
                        <div class="hover-lift" style="background: linear-gradient(145deg, #f1f8e9, #e8f5e9); padding: 40px; border-radius: 20px; text-align: center; position: relative; overflow: hidden; border: 1px solid rgba(46,125,50,0.1);">
                            <i class="fas fa-globe-asia" style="font-size: 5rem; color: var(--primary-color, #2e7d32); margin-bottom: 20px;"></i>
                            <h3 style="font-size: 1.5rem; color: #333; margin-bottom: 15px;">Visi Hijau Kami</h3>
                            <p style="color: #666; line-height: 1.6; position: relative; z-index: 2;">
                                Menciptakan ekosistem pendidikan yang harmonis dengan alam, mencetak pemimpin masa depan yang proaktif, peduli, dan bertanggung jawab terhadap lingkungan sekitarnya.
                            </p>
                            <!-- Decorative Elements -->
                            <div style="position: absolute; top: -30px; right: -30px; width: 120px; height: 120px; background: rgba(129,199,132,0.3); border-radius: 50%; filter: blur(20px);"></div>
                            <div style="position: absolute; bottom: -30px; left: -30px; width: 120px; height: 120px; background: rgba(46,125,50,0.2); border-radius: 50%; filter: blur(20px);"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        {{-- Eco Stats Strip --}}
        {{-- Eco Stats Strip --}}
        <section class="eco-strip">
            <div class="container">
                @foreach ($ecoStats as $stat)
                    <div class="eco-strip-item">
                        <div class="eco-strip-icon {{ $stat['color'] }}"><i class="{{ $stat['icon'] }}"></i></div>
                        <div class="eco-strip-info">
                            <h4>{{ $stat['value'] }}</h4>
                            <span>{{ $stat['label'] }}</span>
                        </div>
                    </div>
                @endforeach
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
                    <button class="tab">Energi</button>
                    <button class="tab">Daur Ulang</button>
                    <button class="tab">Edukasi</button>
                </div>

                <div class="programs-grid">
                    @foreach ($programs as $program)
                        <a href="{{ route('programs') }}" class="program-card fade-in"
                            data-category="{{ $program['category'] }}" style="text-decoration:none; color:inherit;">
                            <div class="program-card-img" style="background-image: url('{{ $program['image'] }}')">
                                <span class="tag">{{ $program['tag'] }}</span>
                            </div>
                            <div class="program-card-body">
                                <h3>{{ $program['title'] }}</h3>
                                <p>{{ $program['desc'] }}</p>
                                <div class="program-card-footer">
                                    <span class="date"><i class="far fa-calendar"></i>
                                        {{ $program['date'] }}</span>
                                    <span class="read-more">Selengkapnya <i class="fas fa-arrow-right"></i></span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>


        {{-- Info Highlight --}}
        {{-- Info Highlight Section --}}
        <section class="info-highlight">
            <div class="container">
                <div class="section-title">
                    <div>
                        <h2>Status Lingkungan Sekolah</h2>
                        <p>Monitoring kondisi lingkungan terkini</p>
                    </div>
                    <a href="{{ route('information') }}" class="see-all">Detail Lengkap <i
                            class="fas fa-arrow-right"></i></a>
                </div>

                <div class="info-highlight-grid">
                    {{-- Main Card --}}
                    <div class="info-main-card fade-in">
                        <div class="label"><i class="fas fa-chart-bar"></i>&ensp;Indeks Lingkungan Sekolah</div>
                        <h3>Kualitas Lingkungan Sekolah Dalam Kondisi Sangat Baik</h3>
                        <p>{{ $envStatus['main']['desc'] }}</p>
                        <div class="info-stats-row">
                            <div class="info-stat-item">
                                <div class="val">{{ $envStatus['main']['score'] }}</div>
                                <div class="lbl">Skor Lingkungan</div>
                            </div>
                            <div class="info-stat-item">
                                <div class="val">{{ $envStatus['main']['grade'] }}</div>
                                <div class="lbl">Grade Kebersihan</div>
                            </div>
                            <div class="info-stat-item">
                                <div class="val">{{ $envStatus['main']['airQuality'] }}</div>
                                <div class="lbl">Kualitas Udara</div>
                            </div>
                        </div>
                        <a href="{{ route('information') }}" class="btn-primary"
                            style="font-size:13px; padding:10px 22px;">
                            <i class="fas fa-file-pdf"></i> Unduh Laporan Lengkap
                        </a>
                    </div>

                    {{-- Side Cards --}}
                    <div class="info-side-cards fade-in">
                        @foreach ($envStatus['cards'] as $card)
                            <div class="info-side-card">
                                <div class="icon-box"
                                    style="background:{{ $card['iconBg'] }}; color:{{ $card['iconColor'] }};">
                                    <i class="{{ $card['icon'] }}"></i>
                                </div>
                                <div>
                                    <h4>{{ $card['title'] }}</h4>
                                    <p>{{ $card['desc'] }}</p>
                                    <span class="badge {{ $card['badgeClass'] }}">{{ $card['badge'] }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>


        {{-- Gallery Section --}}
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
                        <div class="gallery-item fade-in">
                            <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" loading="lazy">
                            <div class="overlay">
                                <h4>{{ $item['title'] }}</h4>
                                <span>{{ $item['date'] }}</span>
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
                        <a href="{{ route('information') }}" class="quick-item fade-in">
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
                    <a href="{{ route('news') }}" class="news-featured fade-in"
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
                            <a href="{{ route('news') }}" class="news-item fade-in">
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


        {{-- CTA Section --}}
        {{-- CTA Section --}}
        <section class="cta-section">
            <div class="container">
                <h2>Mari Bersama Menjaga Bumi Kita</h2>
                <p>Bergabunglah dengan gerakan Go Green School. Setiap langkah kecil yang kita lakukan hari ini akan
                    menciptakan perubahan besar untuk masa depan bumi.</p>
                <div class="cta-buttons">
                    <a href="#" class="btn-primary"><i class="fas fa-user-plus"></i> Daftar Sekarang</a>
                    <a href="#contact" class="btn-outline"><i class="fas fa-envelope"></i> Hubungi Kami</a>
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
                        <div class="partner-logo">
                            <span class="tooltip-custom">{{ $partner['name'] }}</span>
                            <i class="{{ $partner['icon'] }}"></i>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>



    </main>

    {{-- Footer --}}
    {{-- Footer --}}
    <footer class="footer" id="contact">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-about">
                    <div class="logo-footer">
                        <div class="icon"><i class="fas fa-leaf"></i></div>
                        <h3>Go Green School</h3>
                    </div>
                    <p>Go Green School adalah program sekolah hijau yang bertujuan membangun kesadaran lingkungan sejak
                        dini melalui pendidikan, aksi nyata, dan kolaborasi seluruh warga sekolah untuk masa depan bumi
                        yang lebih baik.</p>
                    <div class="footer-social">
                        <a href="#" title="YouTube" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                        <a href="#" title="Facebook" aria-label="Facebook"><i
                                class="fab fa-facebook-f"></i></a>
                        <a href="#" title="Twitter" aria-label="Twitter"><i class="fab fa-x-twitter"></i></a>
                        <a href="#" title="Instagram" aria-label="Instagram"><i
                                class="fab fa-instagram"></i></a>
                        <a href="#" title="TikTok" aria-label="TikTok"><i class="fab fa-tiktok"></i></a>
                    </div>
                </div>

                <div>
                    <h4>Tautan Cepat</h4>
                    <ul class="footer-links">
                        <li><a href="{{ route('home') }}">Beranda</a></li>
                        <li><a href="{{ route('programs') }}">Program Lingkungan</a></li>
                        <li><a href="{{ route('gallery') }}">Galeri Kegiatan</a></li>
                        <li><a href="{{ route('news') }}">Berita & Artikel</a></li>
                        <li><a href="{{ route('contact') }}">Tentang Kami</a></li>
                    </ul>
                </div>

                <div>
                    <h4>Program</h4>
                    <ul class="footer-links">
                        <li><a href="{{ route('programs') }}">Penghijauan Sekolah</a></li>
                        <li><a href="{{ route('programs') }}">Bank Sampah</a></li>
                        <li><a href="{{ route('programs') }}">Energi Terbarukan</a></li>
                        <li><a href="{{ route('programs') }}">Konservasi Air</a></li>
                        <li><a href="{{ route('programs') }}">Edukasi Lingkungan</a></li>
                    </ul>
                </div>

                <div>
                    <h4>Kontak Kami</h4>
                    <ul class="footer-links footer-contact">
                        <li>
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Jl. Pendidikan Hijau No. 10, Jakarta Selatan 12345</span>
                        </li>
                        <li>
                            <i class="fas fa-phone-alt"></i>
                            <span>(021) 1234-5678</span>
                        </li>
                        <li>
                            <i class="fas fa-envelope"></i>
                            <span>info@gogreenschool.id</span>
                        </li>
                        <li>
                            <i class="far fa-clock"></i>
                            <span>Senin - Jumat: 07.00 - 16.00 WIB</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                &copy; {{ date('Y') }} Go Green School &mdash; Sekolah Hijau untuk Masa Depan. All Rights Reserved.
            </div>
        </div>
    </footer>


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

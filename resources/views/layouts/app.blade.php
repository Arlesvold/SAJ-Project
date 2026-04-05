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
    @include('partials.topbar')

    {{-- Header --}}
    @include('partials.header')

    {{-- Main Content --}}
    <main>
        @yield('content')
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

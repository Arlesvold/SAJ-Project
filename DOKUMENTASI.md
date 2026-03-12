# Dokumentasi Proyek Go Green School

## Ringkasan

Proyek **Go Green School** adalah website landing page bertema lingkungan yang dibangun menggunakan **Laravel 10** dengan PHP 8.1. Seluruh data bersifat statis (tanpa database) sesuai ketentuan proyek. Website ini menampilkan program sekolah hijau, berita, galeri, dan berbagai informasi lingkungan dengan desain responsif dan interaktif.

---

## Teknologi yang Digunakan

| Komponen | Teknologi |
|---|---|
| Framework | Laravel 10.50.2 |
| PHP | 8.1.10 (Laragon) |
| CSS | Custom CSS (tanpa framework) |
| JavaScript | Vanilla JS (tanpa library) |
| Font | Google Fonts — Poppins (300–800) |
| Ikon | Font Awesome 6.5.1 (CDN) |
| Database | **Tidak ada** — Semua data statis dari Controller |
| Build Tools | Tidak ada — file CSS/JS langsung di `public/` |

---

## Struktur File yang Dibuat / Dimodifikasi

### 1. File Inti Laravel (Dimodifikasi untuk Laravel 10)

| File | Keterangan |
|---|---|
| `composer.json` | Diubah dari Laravel 12 ke Laravel 10 (`php: ^8.1`, `laravel/framework: ^10.0`) |
| `bootstrap/app.php` | Ditulis ulang dari format L12 (`Application::configure()`) ke format L10 (Kernel-based) |
| `public/index.php` | Ditulis ulang dari `$app->handleRequest()` ke `Kernel::handle()` |
| `artisan` | Ditulis ulang dari `$app->handleCommand()` ke `Console\Kernel::handle()` |
| `.env` | Dibuat dengan konfigurasi: session file, cache file, tanpa database aktif |

### 2. File Aplikasi (Dibuat Baru)

#### Controller

| File | Keterangan |
|---|---|
| `app/Http/Controllers/HomeController.php` | Controller utama yang menyajikan semua data statis untuk halaman landing page. Berisi method `index()` dengan try-catch, dan 9 method private untuk data: `getSlides()`, `getEcoStats()`, `getPrograms()`, `getEnvironmentStatus()`, `getGallery()`, `getQuickAccess()`, `getNews()`, `getPartners()`, `getDefaultData()` |

#### Kernel & Handler (Laravel 10 Required)

| File | Keterangan |
|---|---|
| `app/Http/Kernel.php` | HTTP Kernel dengan middleware stack (CORS, CSRF, Session, dll.) |
| `app/Console/Kernel.php` | Console Kernel untuk artisan commands & scheduling |
| `app/Exceptions/Handler.php` | Exception handler untuk error reporting |
| `app/Http/Controllers/Controller.php` | Base controller — ditambahkan trait `AuthorizesRequests` & `ValidatesRequests` |

#### Providers

| File | Keterangan |
|---|---|
| `app/Providers/RouteServiceProvider.php` | Dibuat untuk me-load route `web.php` dengan middleware group `web` |

#### Config

| File | Keterangan |
|---|---|
| `config/app.php` | Diubah — ditambahkan array `providers` dan `aliases`, timezone `Asia/Jakarta`, locale `id` |
| `config/view.php` | Dibuat baru — mendaftarkan path view (`resources/views`) dan compiled path |

#### Routes

| File | Keterangan |
|---|---|
| `routes/web.php` | Route utama: `GET /` mengarah ke `HomeController@index` dengan nama `home` |

---

### 3. Blade Views (16 file)

#### Layout

| File | Keterangan |
|---|---|
| `resources/views/layouts/app.blade.php` | Layout utama — berisi `<head>` (meta, font, CSS), preloader, scroll progress bar, toast container, dark mode toggle, back-to-top button, lightbox modal, link ke CSS & JS |

#### Partials (Komponen yang dipakai di semua halaman)

| File | Keterangan |
|---|---|
| `resources/views/partials/topbar.blade.php` | Top bar — tanggal real-time (format Indonesia), jam digital, quick links (Hubungi Kami, Email, FAQ) |
| `resources/views/partials/header.blade.php` | Navbar — logo "Go Green School", menu navigasi (6 item), search box, tombol hamburger untuk mobile |
| `resources/views/partials/footer.blade.php` | Footer — 4 kolom: Tentang Kami, Tautan Cepat, Program Kami, Hubungi Kami + copyright |

#### Halaman Utama

| File | Keterangan |
|---|---|
| `resources/views/home.blade.php` | Halaman utama — extends layout, include 9 section |

#### Sections (9 bagian halaman)

| File | Keterangan |
|---|---|
| `resources/views/sections/hero.blade.php` | **Hero Slider** — 3 slide dengan badge, judul, deskripsi, 2 tombol, dan kartu statistik. Dilengkapi dots navigation dan swipe hint |
| `resources/views/sections/eco-strip.blade.php` | **Eco Strip** — 4 item statistik lingkungan (Pohon Ditanam, Penghematan Air, Energi Terbarukan, Sampah Didaur Ulang) dengan ikon warna-warni |
| `resources/views/sections/programs.blade.php` | **Program** — 6 kartu program dengan sistem tab filtering (Semua, Penghijauan, Energi, Daur Ulang, Edukasi). Setiap kartu: gambar, tag kategori, judul, deskripsi, tanggal |
| `resources/views/sections/info-highlight.blade.php` | **Info Highlight** — Dashboard status lingkungan: skor utama (92/A+), kualitas udara, dan 4 kartu info (Kualitas Udara, Penampungan Air Hujan, Penggunaan Energi, Kebun Sekolah) |
| `resources/views/sections/gallery.blade.php` | **Galeri** — 6 item galeri dengan gambar lazy-loaded, overlay judul & tanggal, lightbox untuk melihat gambar penuh |
| `resources/views/sections/quick-access.blade.php` | **Akses Cepat** — 5 kartu shortcut berwarna gradient (Penghijauan, Konservasi Air, Energi Bersih, Daur Ulang, Edukasi) |
| `resources/views/sections/news.blade.php` | **Berita** — 3 tab (Terbaru, Populer, Agenda), 1 berita utama (featured) dengan gambar besar + 4 berita list dengan thumbnail |
| `resources/views/sections/cta.blade.php` | **Call to Action** — Section ajakan bergabung dengan 2 tombol (Daftar Sekarang, Hubungi Kami) |
| `resources/views/sections/partners.blade.php` | **Mitra** — 6 logo mitra (Kementerian LHK, Dinas Pendidikan, WWF Indonesia, WALHI, PLN Green, Komunitas Peduli Lingkungan) dengan tooltip |

---

### 4. Asset Files

#### CSS

| File | Keterangan |
|---|---|
| `public/css/gogreen.css` | Stylesheet lengkap (~1200+ baris) mencakup: |

**Isi gogreen.css:**
- **CSS Variables** — Warna tema hijau, spacing, font, shadow, transition
- **Reset & Base** — Box-sizing, smooth scroll, font Poppins
- **Preloader** — Animasi loading saat halaman dimuat
- **Top Bar** — Styling bar atas dengan tanggal dan clock
- **Header/Navbar** — Navigasi fixed dengan efek shrink saat scroll
- **Hero Slider** — Layout slider full-width dengan overlay gradient, kartu statistik, parallax shapes
- **Eco Strip** — Grid 4 kolom dengan ikon berwarna
- **Programs** — Grid kartu program dengan tab filter, efek hover
- **Info Highlight** — Dashboard card dengan skor lingkaran, badge status
- **Gallery** — Grid responsif dengan overlay hover
- **Quick Access** — Kartu gradient dengan ikon besar
- **News** — Layout 2 kolom (featured + list)
- **CTA** — Background gradient dengan tombol aksi
- **Partners** — Grid logo mitra
- **Footer** — 4 kolom grid, link hover effects
- **Lightbox** — Modal overlay untuk gambar galeri
- **Toast** — Notifikasi popup
- **Dark Mode** — Semua komponen memiliki styling `body.dark-mode` (background gelap, teks terang, kartu gelap)
- **Responsive Design** — 3 breakpoint:
  - `@media (max-width: 1024px)` — Tablet
  - `@media (max-width: 768px)` — Mobile
  - `@media (max-width: 480px)` — Small mobile
- **Animasi** — Keyframes: `heroFadeIn`, `preloaderPulse`, `preloaderLoad`, `blink`, `rippleEffect`

#### JavaScript

| File | Keterangan |
|---|---|
| `public/js/gogreen.js` | JavaScript lengkap (~1170+ baris) dengan 24 fitur interaktif |

**Semua fitur dibungkus `safeExecute()` (try-catch wrapper):**

| No | Fitur | Keterangan |
|---|---|---|
| 1 | **Preloader** | Animasi loading hilang setelah halaman dimuat |
| 2 | **DateTime** | Jam digital real-time di topbar (update setiap detik) |
| 3 | **ScrollProgress** | Progress bar horizontal di atas halaman mengikuti scroll |
| 4 | **Header/Scroll** | Header mengecil (shrink) dan berubah shadow saat scroll ke bawah |
| 5 | **MobileMenu** | Menu hamburger untuk navigasi mobile dengan animasi open/close |
| 6 | **HeroSlider** | Slider otomatis (5 detik) dengan kontrol dots, swipe gesture (touch), dan keyboard (Arrow Left/Right) |
| 7 | **ScrollAnimations** | Elemen muncul dengan animasi fade-in saat masuk viewport (IntersectionObserver) |
| 8 | **CounterAnimation** | Angka statistik eco-strip beranimasi naik dari 0 ke nilai target |
| 9 | **ProgramTabs** | Filter program berdasarkan kategori dengan animasi show/hide |
| 10 | **NewsTabs** | Switching tab berita (Terbaru, Populer, Agenda) |
| 11 | **GalleryLightbox** | Klik gambar galeri membuka lightbox modal, navigasi lewat keyboard (Escape, Arrow), klik luar untuk tutup |
| 12 | **DarkMode** | Toggle mode gelap/terang, disimpan di `localStorage` agar persisten |
| 13 | **ToastInit** | Sistem notifikasi popup (toast) yang bisa dipanggil via `window.showToast()` |
| 14 | **SmoothScroll** | Scroll halus ke section saat klik link navigasi, highlight menu aktif sesuai posisi scroll |
| 15 | **SearchFunctionality** | Pencarian teks di halaman — highlight elemen yang cocok, scroll ke hasil pertama |
| 16 | **FloatingLeaves** | Animasi daun-daun mengambang di canvas sebagai background dekoratif |
| 17 | **TypingEffect** | Efek mengetik pada teks hero accent (judul berubah-ubah) |
| 18 | **ConfettiEffect** | Animasi confetti saat tombol CTA diklik |
| 19 | **RippleEffect** | Efek ripple (gelombang) saat tombol diklik |
| 20 | **EcoStripHover** | Efek interaktif saat hover pada item eco strip |
| 21 | **BadgePulse** | Animasi pulse pada badge hero |
| 22 | **PartnerLogos** | Animasi hover pada logo mitra |
| 23 | **SectionReveal** | Animasi reveal section saat scroll |
| 24 | **KeyboardShortcuts** | Shortcut keyboard: `D` (dark mode), `S` (search), `Home` (scroll atas) |

---

## Alur Kerja Aplikasi

```
Browser Request (GET /)
        │
        ▼
  routes/web.php
        │
        ▼
  HomeController@index()
        │
        ├── getSiteData() ── mengumpulkan semua data statis
        │     ├── getSlides()            → 3 slide hero
        │     ├── getEcoStats()          → 4 statistik lingkungan
        │     ├── getPrograms()          → 6 program
        │     ├── getEnvironmentStatus() → dashboard lingkungan
        │     ├── getGallery()           → 6 item galeri
        │     ├── getQuickAccess()       → 5 akses cepat
        │     ├── getNews()              → 1 featured + 4 berita
        │     └── getPartners()          → 6 mitra
        │
        ▼
  return view('home', $data)
        │
        ▼
  home.blade.php
        │
        ├── @extends('layouts.app')      → Layout utama
        │     ├── partials/topbar        → Bar atas
        │     ├── partials/header        → Navigasi
        │     └── partials/footer        → Footer
        │
        └── @section('content')
              ├── sections/hero
              ├── sections/eco-strip
              ├── sections/programs
              ├── sections/info-highlight
              ├── sections/gallery
              ├── sections/quick-access
              ├── sections/news
              ├── sections/cta
              └── sections/partners
```

---

## Data Statis (Tanpa Database)

Semua data disajikan sebagai **array PHP** dari `HomeController`. Tidak ada Eloquent Model, Migration, atau Query Builder yang digunakan. Ini sesuai dengan ketentuan proyek yang **tidak menggunakan database**.

| Data | Jumlah | Sumber Method |
|---|---|---|
| Hero Slides | 3 slide | `getSlides()` |
| Eco Statistics | 4 item | `getEcoStats()` |
| Programs | 6 program | `getPrograms()` |
| Environment Status | 1 main + 4 cards | `getEnvironmentStatus()` |
| Gallery | 6 foto | `getGallery()` |
| Quick Access | 5 shortcut | `getQuickAccess()` |
| News | 1 featured + 4 list | `getNews()` |
| Partners | 6 mitra | `getPartners()` |

---

## Error Handling (Try-Catch)

### PHP (Server-side)
- `HomeController@index()` dibungkus `try-catch(\Throwable $e)` — jika ada error, halaman tetap tampil dengan data default kosong via `getDefaultData()`

### JavaScript (Client-side)
- Semua 24 fitur dibungkus fungsi `safeExecute(fn, context)` yang melakukan try-catch dan log error ke console tanpa menghentikan fitur lain

---

## Responsif Design

Website memiliki 3 breakpoint utama:

| Breakpoint | Target | Perubahan Utama |
|---|---|---|
| `≤ 1024px` | Tablet | Grid 2 kolom, font lebih kecil |
| `≤ 768px` | Mobile | Grid 1 kolom, hamburger menu, hero slider vertikal |
| `≤ 480px` | Small Mobile | Padding minimal, font lebih kecil lagi |

---

## Cara Menjalankan

```bash
# 1. Pastikan PHP ada di PATH
$env:PATH = "C:\laragon\bin\php\php-8.1.10-Win32-vs16-x64;$env:PATH"

# 2. Masuk ke folder proyek
cd c:\laragon\www\SAJ-Project

# 3. Jalankan server
php artisan serve

# 4. Buka browser
# http://127.0.0.1:8000
```

Atau cukup akses melalui Laragon virtual host jika sudah dikonfigurasi.

---

## Catatan Migrasi Laravel 12 → Laravel 10

Proyek awalnya dibuat dengan struktur Laravel 12, namun karena PHP yang tersedia adalah 8.1.10 (Laravel 12 membutuhkan PHP 8.2+), maka dilakukan downgrade ke Laravel 10 dengan perubahan:

1. **bootstrap/app.php** — Dari `Application::configure()->withRouting()->withMiddleware()->create()` ke traditional Kernel binding
2. **public/index.php** — Dari `$app->handleRequest()` ke `Kernel::handle()`
3. **artisan** — Dari `$app->handleCommand()` ke `Console\Kernel::handle()`
4. **Kernel files** — Dibuat `Http\Kernel.php` dan `Console\Kernel.php` (tidak ada di L12)
5. **Exception Handler** — Dibuat `Exceptions\Handler.php` (tidak ada di L12)
6. **RouteServiceProvider** — Dibuat untuk me-load routes (otomatis di L12)
7. **config/app.php** — Ditambahkan `providers` dan `aliases` array (otomatis di L12)
8. **config/view.php** — Dibuat (auto-resolved di L12)

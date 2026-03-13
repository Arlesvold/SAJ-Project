@extends('layouts.app')

@section('title', 'Galeri Kegiatan - Go Green School')

@section('content')
    <section class="page-hero">
        <div class="page-hero-shapes">
            <div class="shape"></div>
            <div class="shape"></div>
            <div class="shape"></div>
            <div class="shape"></div>
            <div class="shape"></div>
        </div>
        <div class="page-hero-particles">
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
        </div>
        <canvas class="leaves-canvas" id="leavesCanvas"></canvas>
        <div class="page-hero-content">
            <div class="container">
                <div class="page-hero-icon">
                    <i class="fas fa-images"></i>
                </div>
                <div class="page-hero-badge">
                    <i class="fas fa-circle"></i> Dokumentasi Kegiatan
                </div>
                <h1>Galeri <span class="highlight">Kegiatan</span> Lingkungan</h1>
                <div class="page-hero-decor-line"></div>
                <p class="page-hero-desc">
                    Dokumentasi berbagai aktivitas dan program lingkungan sehat yang telah dijalankan warga sekolah dalam mewujudkan sekolah hijau.
                </p>
                <div class="page-hero-breadcrumb">
                    <a href="{{ route('home') }}"><i class="fas fa-home"></i> Beranda</a>
                    <span class="separator"><i class="fas fa-chevron-right"></i></span>
                    <span class="current">Galeri</span>
                </div>
            </div>
        </div>
    </section>

    <section class="gallery-page-section" style="padding: 60px 0; background: #fff;">
        <div class="container">

            <div class="gallery-filters"
                style="display:flex; justify-content:center; gap:10px; margin-bottom: 40px; flex-wrap: wrap;">
                <button class="btn-primary" style="border-radius:30px;">Semua</button>
                <button class="btn-outline" style="border-radius:30px;">Penanaman Pohon</button>
                <button class="btn-outline" style="border-radius:30px;">Daur Ulang</button>
                <button class="btn-outline" style="border-radius:30px;">Edukasi</button>
                <button class="btn-outline" style="border-radius:30px;">Kebersihan</button>
            </div>

            <div class="gallery-grid"
                style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">

                {{-- Gallery Items --}}
                @php
                    $galleries = [
                        [
                            'img' =>
                                'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                            'title' => 'Aksi Tanam Pohon Baru',
                            'cat' => 'Penanaman Pohon',
                        ],
                        [
                            'img' =>
                                'https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                            'title' => 'Pengolahan Bank Sampah',
                            'cat' => 'Daur Ulang',
                        ],
                        [
                            'img' =>
                                'https://images.unsplash.com/photo-1497435334941-8c899ee9e8e9?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                            'title' => 'Workshop Lingkungan Bebas Plastik',
                            'cat' => 'Edukasi',
                        ],
                        [
                            'img' =>
                                'https://images.unsplash.com/photo-1518531933037-91b2f5f229cc?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                            'title' => 'Sistem Pemanenan Air Hujan',
                            'cat' => 'Fasilitas',
                        ],
                        [
                            'img' =>
                                'https://images.unsplash.com/photo-1466692476868-aef1dfb1e735?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                            'title' => 'Panen Sayur Hidroponik Kantin',
                            'cat' => 'Edukasi',
                        ],
                        [
                            'img' =>
                                'https://images.unsplash.com/photo-1611284446314-60a58ac0deb9?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                            'title' => 'Kerja Bakti Jumat Bersih',
                            'cat' => 'Kebersihan',
                        ],
                        [
                            'img' =>
                                'https://images.unsplash.com/photo-1540420773420-3366772f4999?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                            'title' => 'Kreasi Daur Ulang Kertas',
                            'cat' => 'Daur Ulang',
                        ],
                        [
                            'img' =>
                                'https://images.unsplash.com/photo-1418065460487-3e41a6c8e1e4?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                            'title' => 'Eksplorasi Keanekaragaman Hayati',
                            'cat' => 'Edukasi',
                        ],
                        [
                            'img' =>
                                'https://images.unsplash.com/photo-1503596476-1c12a8ba09a9?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                            'title' => 'Lomba Fotografi Alam',
                            'cat' => 'Kompetisi',
                        ],
                    ];
                @endphp

                @foreach ($galleries as $g)
                    <div class="gallery-item fade-in"
                        style="position: relative; border-radius: 12px; overflow: hidden; aspect-ratio: 4/3; cursor: pointer;">
                        <img src="{{ $g['img'] }}" alt="{{ $g['title'] }}"
                            style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;">
                        <div class="overlay"
                            style="position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,0.8), transparent 60%); opacity: 0; transition: opacity 0.3s ease; display: flex; flex-direction: column; justify-content: flex-end; padding: 20px;">
                            <span
                                style="color: var(--accent); font-size: 0.8rem; font-weight: 600; text-transform: uppercase; margin-bottom: 5px;">{{ $g['cat'] }}</span>
                            <h4
                                style="color: white; margin: 0; font-size: 1.1rem; transform: translateY(10px); transition: transform 0.3s ease;">
                                {{ $g['title'] }}</h4>
                        </div>
                    </div>
                @endforeach

            </div>

            <div style="text-align: center; margin-top: 50px;">
                <button class="btn-outline">Muat Lebih Banyak...</button>
            </div>

        </div>
    </section>

    {{-- Pastikan ada style sedikit untuk interaksi hover di page gallery --}}
    <style>
        .gallery-item:hover img {
            transform: scale(1.1);
        }

        .gallery-item:hover .overlay {
            opacity: 1;
        }

        .gallery-item:hover .overlay h4 {
            transform: translateY(0);
        }
    </style>
@endsection

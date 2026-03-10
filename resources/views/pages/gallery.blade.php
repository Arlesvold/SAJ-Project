@extends('layouts.app')

@section('title', 'Galeri Kegiatan - Go Green School')

@section('content')
    <section class="hero" style="min-height: 350px; padding: 100px 0 60px; margin-top: 60px;">
        <canvas class="leaves-canvas" id="leavesCanvas"></canvas>
        <div class="hero-bg-shapes">
            <div class="shape"></div>
            <div class="shape"></div>
            <div class="shape"></div>
        </div>
        <div class="hero-content" style="position: relative; z-index: 2;">
            <div class="container" style="text-align: center; display: flex; flex-direction: column; align-items: center;">
                <h1 style="font-size: 2.8rem; margin-bottom: 20px; color: white; font-weight: 800; text-align: center;">
                    Galeri Kegiatan Lingkungan</h1>
                <p
                    style="font-size: 1.1rem; opacity: 0.9; max-width: 600px; line-height: 1.6; color: rgba(255,255,255,0.85); text-align: center;">
                    Dokumentasi berbagai aktivitas dan program lingkungan sehat yang telah dijalankan warga sekolah dalam
                    mewujudkan sekolah hijau.</p>
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

@extends('layouts.app')

@section('title', 'Galeri Kegiatan - Go Green School')

@push('styles')
    <style>
        /* ===== GALLERY PAGE STYLES ===== */
        .gallery-page-section {
            padding: 80px 0;
            background: #fbfdfb;
        }

        /* Filter Buttons */
        .gallery-filters {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-bottom: 50px;
            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 10px 24px;
            border: 2px solid #e8f5e9;
            background: #fff;
            color: #555;
            border-radius: 30px;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'Poppins', sans-serif;
        }

        .filter-btn:hover,
        .filter-btn.active {
            background: var(--primary-color, #2e7d32);
            color: #fff;
            border-color: var(--primary-color, #2e7d32);
            box-shadow: 0 4px 15px rgba(46, 125, 50, 0.2);
            transform: translateY(-2px);
        }

        /* Grid Layout */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 25px;
        }

        /* Gallery Item */
        .gallery-item {
            position: relative;
            border-radius: 16px;
            overflow: hidden;
            aspect-ratio: 4/3;
            cursor: pointer;
            background: #eee;
            /* The hover-lift class from global css will handle the lift effect */
        }

        .gallery-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .gallery-item:hover .gallery-img {
            transform: scale(1.08);
        }

        /* Overlay */
        .gallery-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(26, 92, 42, 0.9) 0%, rgba(26, 92, 42, 0.3) 60%, transparent 100%);
            opacity: 1;
            transition: all 0.4s ease;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 25px;
            z-index: 1;
        }

        .gallery-item:hover .gallery-overlay {
            background: linear-gradient(to top, rgba(26, 92, 42, 0.9) 0%, rgba(26, 92, 42, 0.5) 100%);
        }

        /* Zoom Icon */
        .gallery-overlay-icon {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0.5);
            color: #fff;
            font-size: 2.5rem;
            opacity: 0;
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .gallery-item:hover .gallery-overlay-icon {
            opacity: 1;
            transform: translate(-50%, -50%) scale(1);
        }

        /* Category Badge */
        .gallery-cat {
            display: inline-block;
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
            color: #fff;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 5px 14px;
            border-radius: 20px;
            margin-bottom: 12px;
            align-self: flex-start;
            transform: translateY(0);
            opacity: 1;
            transition: all 0.4s ease;
        }

        /* Title */
        .gallery-title {
            color: #fff;
            margin: 0;
            font-size: 1.25rem;
            font-weight: 700;
            transform: translateY(0);
            opacity: 1;
            transition: all 0.4s ease;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
            line-height: 1.4;
        }

        .gallery-item:hover .gallery-cat,
        .gallery-item:hover .gallery-title {
            transform: translateY(-5px);
        }

        /* Load More Button */
        .load-more-container {
            text-align: center;
            margin-top: 60px;
        }

        .btn-load-more {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 35px;
            font-size: 1.05rem;
            font-weight: 600;
            border-radius: 30px;
            background: #fff;
            color: var(--primary-color, #2e7d32);
            border: 2px solid var(--primary-color, #2e7d32);
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'Poppins', sans-serif;
        }

        .btn-load-more:hover {
            background: var(--primary-color, #2e7d32);
            color: #fff;
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(46, 125, 50, 0.2);
        }

        /* Pagination Styles */
        .pagination-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            margin-top: 60px;
        }

        .page-btn {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            border: 1px solid #c8e6c9;
            background: #fff;
            color: #2e7d32;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .page-btn:hover:not(:disabled) {
            background: #e8f5e9;
            color: #1b5e20;
        }

        .page-btn.active {
            background: #2e7d32;
            color: #fff;
            border-color: #2e7d32;
            box-shadow: 0 4px 10px rgba(46, 125, 50, 0.2);
        }

        .page-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            background: #f5f5f5;
            border-color: #e0e0e0;
            color: #999;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .gallery-page-section {
                padding: 60px 0;
            }

            .gallery-filters {
                gap: 8px;
                margin-bottom: 35px;
            }

            .filter-btn {
                padding: 8px 18px;
                font-size: 0.85rem;
            }

            .gallery-grid {
                grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
                gap: 20px;
            }

            .gallery-overlay {
                padding: 20px;
            }

            .gallery-title {
                font-size: 1.15rem;
            }
        }
    </style>
@endpush

@section('content')
    <section class="page-hero"
        style="background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.7)), url('https://images.unsplash.com/photo-1466692476868-aef1dfb1e735?auto=format&fit=crop&w=1800&q=80'); background-size: cover; background-position: center; background-attachment: fixed; position: relative;">
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
        <div class="page-hero-content" style="position: relative; z-index: 10; color: white; text-align: center;">
            <div class="container">
                <div class="page-hero-icon"
                    style="background: rgba(255,255,255,0.2); backdrop-filter: blur(5px); color: #fff; width: 80px; height: 80px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2.5rem; margin: 0 auto 20px;">
                    <i class="fas fa-images"></i>
                </div>
                <div class="page-hero-badge"
                    style="background: rgba(76, 175, 80, 0.8); color: white; border: none; padding: 8px 20px; font-weight: bold; border-radius: 30px; display: inline-block; margin-bottom: 20px;">
                    <i class="fas fa-circle" style="color: #c8e6c9;"></i> Dokumentasi Kegiatan
                </div>
                <h1 style="color: white; font-size: 3.5rem; font-weight: 800; text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">
                    Galeri&nbsp;<span class="highlight"
                        style="color: #a5d6a7; text-shadow: none;">Kegiatan</span>&nbsp;Lingkungan
                </h1>
                <div class="page-hero-decor-line" style="background: #a5d6a7; height: 4px; width: 60px; margin: 20px auto;">
                </div>
                <p class="page-hero-desc"
                    style="color: #e0e0e0; font-size: 1.2rem; max-width: 600px; margin: 0 auto 30px; text-shadow: 1px 1px 3px rgba(0,0,0,0.5);">
                    Dokumentasi berbagai aktivitas dan program lingkungan sehat yang telah dijalankan warga sekolah dalam
                    mewujudkan sekolah hijau.
                </p>
                <div class="page-hero-breadcrumb"
                    style="background: rgba(0,0,0,0.4); padding: 10px 20px; border-radius: 20px; display: inline-flex; gap: 10px;">
                    <a href="{{ route('home') }}" style="color: #a5d6a7; text-decoration: none;"><i class="fas fa-home"></i>
                        Beranda</a>
                    <span class="separator" style="color: #999;"><i class="fas fa-chevron-right"></i></span>
                    <span class="current" style="color: white;">Galeri</span>
                </div>
            </div>
        </div>
    </section>

    <section class="gallery-page-section">
        <div class="container">

            <div class="gallery-filters fade-in">
                <button class="filter-btn active" data-filter="all">Semua</button>
                <button class="filter-btn" data-filter="Penanaman Pohon">Penanaman Pohon</button>
                <button class="filter-btn" data-filter="Daur Ulang">Daur Ulang</button>
                <button class="filter-btn" data-filter="Edukasi">Edukasi</button>
                <button class="filter-btn" data-filter="Kebersihan">Kebersihan</button>
            </div>

            <div class="gallery-grid">

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
                                'https://images.unsplash.com/photo-1536147116438-62679a5e01f2?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
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
                    <div class="gallery-item fade-in" data-category="{{ $g['cat'] }}">
                        <img src="{{ $g['img'] }}" alt="{{ $g['title'] }}" class="gallery-img" loading="lazy">
                        <div class="gallery-overlay">
                            <i class="fas fa-search-plus gallery-overlay-icon"></i>
                            <span class="gallery-cat">{{ $g['cat'] }}</span>
                            <h4 class="gallery-title">{{ $g['title'] }}</h4>
                        </div>
                    </div>
                @endforeach

            </div>

            <div class="pagination-container fade-in" id="paginationControls">
                <!-- Pagination buttons will be generated by JS -->
            </div>

        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filterBtns = document.querySelectorAll('.filter-btn');
            const galleryItems = document.querySelectorAll('.gallery-item');
            const paginationControls = document.getElementById('paginationControls');

            const ITEMS_PER_PAGE = 6;
            let currentFilter = 'all';
            let currentPage = 1;
            let filteredItems = Array.from(galleryItems); // Initially all items

            function renderGallery() {
                // Determine which items match the filter
                filteredItems = Array.from(galleryItems).filter(item => {
                    return currentFilter === 'all' || item.getAttribute('data-category') === currentFilter;
                });

                const totalPages = Math.ceil(filteredItems.length / ITEMS_PER_PAGE);

                // Adjust current page if it exceeds new max
                if (currentPage > totalPages) currentPage = totalPages || 1;

                // Hide all items first
                galleryItems.forEach(item => {
                    item.style.display = 'none';
                    item.style.opacity = '0';
                });

                // Calculate range
                const startIndex = (currentPage - 1) * ITEMS_PER_PAGE;
                const endIndex = startIndex + ITEMS_PER_PAGE;

                // Show items for the current page
                const itemsToShow = filteredItems.slice(startIndex, endIndex);

                itemsToShow.forEach((item, index) => {
                    item.style.display = 'block';
                    setTimeout(() => {
                        item.style.transition = 'opacity 0.4s ease';
                        item.style.opacity = '1';
                    }, 50 * index); // Stagger animation slightly
                });

                renderPagination(totalPages);
            }

            function renderPagination(totalPages) {
                paginationControls.innerHTML = '';

                if (totalPages <= 1) return; // No pagination needed

                // Prev button
                const prevBtn = document.createElement('button');
                prevBtn.innerHTML = '<i class="fas fa-chevron-left"></i>';
                prevBtn.classList.add('page-btn');
                if (currentPage === 1) prevBtn.disabled = true;
                prevBtn.addEventListener('click', () => {
                    if (currentPage > 1) {
                        currentPage--;
                        renderGallery();
                    }
                });
                paginationControls.appendChild(prevBtn);

                // Number buttons
                for (let i = 1; i <= totalPages; i++) {
                    const btn = document.createElement('button');
                    btn.classList.add('page-btn');
                    if (i === currentPage) btn.classList.add('active');
                    btn.textContent = i;
                    btn.addEventListener('click', () => {
                        currentPage = i;
                        renderGallery();
                    });
                    paginationControls.appendChild(btn);
                }

                // Next button
                const nextBtn = document.createElement('button');
                nextBtn.innerHTML = '<i class="fas fa-chevron-right"></i>';
                nextBtn.classList.add('page-btn');
                if (currentPage === totalPages) nextBtn.disabled = true;
                nextBtn.addEventListener('click', () => {
                    if (currentPage < totalPages) {
                        currentPage++;
                        renderGallery();
                    }
                });
                paginationControls.appendChild(nextBtn);
            }

            filterBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    // Update UI
                    filterBtns.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');

                    // Reset variables & render
                    currentFilter = this.getAttribute('data-filter');
                    currentPage = 1; // Always return to page 1 on filter
                    renderGallery();
                });
            });

            // Initial render
            renderGallery();
        });
    </script>
@endpush

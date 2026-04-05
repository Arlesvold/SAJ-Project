@extends('layouts.app')

@section('title', 'Program Lingkungan - Go Green School')

@section('content')
    @php
        $programsData = [
            [
                'title' => 'Satu Siswa Satu Pohon',
                'category' => 'Penghijauan',
                'desc' =>
                    'Program wajib bagi seluruh siswa baru untuk menanam dan merawat satu pohon selama masa studi mereka di sekolah. Tujuannya adalah menanamkan rasa memiliki dan tanggung jawab terhadap lingkungan sekitar.',
                'schedule' => 'Rutin Tahunan',
                'icon' => 'far fa-calendar-check',
                'image' =>
                    'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'tag_bg' => 'var(--primary, #2e7d32)',
            ],
            [
                'title' => 'Bank Sampah Sekolah',
                'category' => 'Daur Ulang',
                'desc' =>
                    'Sistem pengelolaan sampah terpadu dimana siswa dapat menyetorkan sampah anorganik terpilah dan menukarkannya dengan poin yang bisa digunakan untuk membeli buku.',
                'schedule' => 'Setiap Jumat',
                'icon' => 'fas fa-sync-alt',
                'image' =>
                    'https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'tag_bg' => 'var(--accent, #f39c12)',
            ],
            [
                'title' => 'Workshop Eco-Enzyme',
                'category' => 'Edukasi',
                'desc' =>
                    'Pelatihan rutin pembuatan cairan serbaguna pembersih ramah lingkungan dari sisa buah dan sayuran kantin untuk mengurangi volume limbah organik.',
                'schedule' => 'Program Bulanan',
                'icon' => 'fas fa-flask',
                'image' =>
                    'https://images.unsplash.com/photo-1497435334941-8c899ee9e8e9?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'tag_bg' => '#e67e22',
            ],
            [
                'title' => 'Pemanenan Air Hujan',
                'category' => 'Konservasi',
                'desc' =>
                    'Sistem canggih penampungan dan penyaringan air hujan untuk keperluan non-konsumsi, seperti menyiram taman, mencuci kendaraan, dan flushing toilet.',
                'schedule' => 'Infrastruktur Pasif',
                'icon' => 'fas fa-tint',
                'image' =>
                    'https://images.unsplash.com/photo-1518531933037-91b2f5f229cc?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'tag_bg' => '#9b59b6',
            ],
            [
                'title' => 'Kebun Hidroponik & TOGA',
                'category' => 'Edukasi',
                'desc' =>
                    'Pembelajaran life-skill siswa di mana mereka belajar bercocok tanam tanpa tanah (hidroponik) dan merawat Tanaman Obat Keluarga (TOGA).',
                'schedule' => 'Ekstrakurikuler',
                'icon' => 'fas fa-seedling',
                'image' =>
                    'https://images.unsplash.com/photo-1466692476868-aef1dfb1e735?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'tag_bg' => 'var(--primary-dark, #1b5e20)',
            ],
            [
                'title' => 'Taman Vertikal Dinding',
                'category' => 'Penghijauan',
                'desc' =>
                    'Pemanfaatan dinding-dinding kosong di sekitar sekolah untuk dijadikan taman vertikal menggunakan botol plastik bekas sebagai pot tanaman hias dan penyerap polutan.',
                'schedule' => 'Diterapkan Harian',
                'icon' => 'fas fa-leaf',
                'image' =>
                    'https://images.unsplash.com/photo-1534008897995-27a23e859048?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'tag_bg' => 'var(--primary, #2e7d32)',
            ],
            [
                'title' => 'Kompos Organik Mandiri',
                'category' => 'Daur Ulang',
                'desc' =>
                    'Pengolahan sampah daun kering dari halaman sekolah dan sisa makanan dari kantin menjadi pupuk kompos yang digunakan untuk menyuburkan tanaman di sekolah.',
                'schedule' => 'Setiap Hari',
                'icon' => 'fas fa-recycle',
                'image' =>
                    'https://images.unsplash.com/photo-1581578731548-c64695cc6952?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'tag_bg' => 'var(--accent, #f39c12)',
            ],
            [
                'title' => 'Penghijauan Atap Sekolah',
                'category' => 'Penghijauan',
                'desc' =>
                    'Mengubah atap gedung sekolah menjadi area hijau yang berfungsi menyerap panas, menurunkan suhu bangunan, serta menjadi lahan praktik botani.',
                'schedule' => 'Proyek Tahunan',
                'icon' => 'fas fa-tree',
                'image' =>
                    'https://images.unsplash.com/photo-1463936575829-25148e1db1b8?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'tag_bg' => 'var(--primary, #2e7d32)',
            ],
            [
                'title' => 'Duta Lingkungan Kelas',
                'category' => 'Edukasi',
                'desc' =>
                    'Pemilihan perwakilan siswa dari setiap kelas untuk memantau dan memotivasi teman-temannya dalam menjaga kebersihan dan ketertiban lingkungan kelas.',
                'schedule' => 'Rutin Mingguan',
                'icon' => 'fas fa-user-check',
                'image' =>
                    'https://images.unsplash.com/photo-1577563908411-5077b6dc7624?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'tag_bg' => '#e67e22',
            ],
            [
                'title' => 'Hemat Energi Listrik',
                'category' => 'Konservasi',
                'desc' =>
                    'Gerakan mematikan lampu dan alat elektronik saat tidak digunakan, serta pemanfaatan cahaya matahari sebagai penerangan utama di kelas.',
                'schedule' => 'Setiap Hari',
                'icon' => 'fas fa-lightbulb',
                'image' =>
                    'https://images.unsplash.com/photo-1473341304170-971dccb5ac1e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'tag_bg' => '#9b59b6',
            ],
        ];
    @endphp

    <section class="page-hero"
        style="background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.7)), url('https://images.unsplash.com/photo-1509391366360-2e959784a276?auto=format&fit=crop&w=1800&q=80'); background-size: cover; background-position: center; background-attachment: fixed; position: relative;">
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
                    <i class="fas fa-seedling"></i>
                </div>
                <div class="page-hero-badge"
                    style="background: rgba(76, 175, 80, 0.8); color: white; border: none; padding: 8px 20px; font-weight: bold; border-radius: 30px; display: inline-block; margin-bottom: 20px;">
                    <i class="fas fa-circle" style="color: #c8e6c9;"></i> Keberlanjutan Lingkungan
                </div>
                <h1 style="color: white; font-size: 3.5rem; font-weight: 800; text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">
                    Program&nbsp;<span class="highlight"
                        style="color: #a5d6a7; text-shadow: none;">Unggulan</span>&nbsp;Sekolah</h1>
                <div class="page-hero-decor-line" style="background: #a5d6a7; height: 4px; width: 60px; margin: 20px auto;">
                </div>
                <p class="page-hero-desc"
                    style="color: #e0e0e0; font-size: 1.2rem; max-width: 600px; margin: 0 auto 30px; text-shadow: 1px 1px 3px rgba(0,0,0,0.5);">
                    Kami memiliki berbagai program keberlanjutan yang melibatkan seluruh warga sekolah untuk menciptakan
                    lingkungan yang lebih bersih dan sehat.
                </p>
                <div class="page-hero-breadcrumb"
                    style="background: rgba(0,0,0,0.4); padding: 10px 20px; border-radius: 20px; display: inline-flex; gap: 10px;">
                    <a href="{{ route('home') }}" style="color: #a5d6a7; text-decoration: none;"><i class="fas fa-home"></i>
                        Beranda</a>
                    <span class="separator" style="color: #999;"><i class="fas fa-chevron-right"></i></span>
                    <span class="current" style="color: white;">Program</span>
                </div>
            </div>
        </div>
    </section>

    <section class="programs-section" style="padding: 60px 0; background: #f9fcfa;">
        <div class="container">

            <div class="programs-tabs"
                style="display: flex; gap: 15px; margin-bottom: 40px; justify-content: center; flex-wrap: wrap;"
                id="programFilters">
                <button class="btn-filter active" data-filter="all"
                    style="padding: 8px 20px; border: 2px solid var(--primary-color, #2e7d32); border-radius: 25px; background: var(--primary-color, #2e7d32); color: white; cursor: pointer; transition: all 0.3s; font-weight: 600;">Semua
                    Program</button>
                <button class="btn-filter" data-filter="Penghijauan"
                    style="padding: 8px 20px; border: 2px solid var(--primary-color, #2e7d32); border-radius: 25px; background: transparent; color: var(--primary-color, #2e7d32); cursor: pointer; transition: all 0.3s; font-weight: 600;">Penghijauan</button>
                <button class="btn-filter" data-filter="Daur Ulang"
                    style="padding: 8px 20px; border: 2px solid var(--primary-color, #2e7d32); border-radius: 25px; background: transparent; color: var(--primary-color, #2e7d32); cursor: pointer; transition: all 0.3s; font-weight: 600;">Daur
                    Ulang</button>
                <button class="btn-filter" data-filter="Edukasi"
                    style="padding: 8px 20px; border: 2px solid var(--primary-color, #2e7d32); border-radius: 25px; background: transparent; color: var(--primary-color, #2e7d32); cursor: pointer; transition: all 0.3s; font-weight: 600;">Edukasi</button>
                <button class="btn-filter" data-filter="Konservasi"
                    style="padding: 8px 20px; border: 2px solid var(--primary-color, #2e7d32); border-radius: 25px; background: transparent; color: var(--primary-color, #2e7d32); cursor: pointer; transition: all 0.3s; font-weight: 600;">Konservasi</button>
            </div>

            <div class="programs-grid" id="programsGrid"
                style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 30px;">

                @foreach ($programsData as $p)
                    <div class="program-card hover-lift" data-category="{{ $p['category'] }}"
                        data-program-title="{{ $p['title'] }}"
                        onclick="openProgramModal(`{{ addslashes($p['title']) }}`, `{{ addslashes($p['category']) }}`, `{{ addslashes($p['desc']) }}`, `{{ addslashes($p['schedule']) }}`, `{{ addslashes($p['image']) }}`)"
                        style="cursor: pointer; background: #fff; border-radius: 15px; overflow: hidden; box-shadow: 0 5px 20px rgba(0,0,0,0.03); transition: transform 0.3s ease, box-shadow 0.3s ease;">
                        <div class="program-card-img"
                            style="background-image: url('{{ $p['image'] }}'); height: 220px; background-size: cover; background-position: center; position: relative;">
                            <span class="tag"
                                style="position: absolute; top: 15px; left: 15px; background: {{ $p['tag_bg'] }}; color: white; padding: 5px 15px; border-radius: 20px; font-size: 0.85rem; font-weight: 600; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">{{ $p['category'] }}</span>
                        </div>
                        <div class="program-card-body" style="padding: 25px;">
                            <h3 style="margin-bottom: 15px; color: var(--dark); font-size: 1.3rem;">{{ $p['title'] }}
                            </h3>
                            <p
                                style="color: var(--gray); margin-bottom: 20px; line-height: 1.6; font-size: 0.95rem; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                                {{ $p['desc'] }}</p>
                            <div
                                style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #eee; padding-top: 15px;">
                                <span style="color: var(--primary, #2e7d32); font-weight: 500; font-size: 0.9rem;"><i
                                        class="{{ $p['icon'] }}"></i> {{ $p['schedule'] }}</span>
                                <span style="color: var(--primary, #2e7d32); font-size: 0.9rem; font-weight: 600;">Detail <i
                                        class="fas fa-arrow-right"></i></span>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

            {{-- Pagination Controls --}}
            <div id="paginationControls" style="display: flex; justify-content: center; gap: 10px; margin-top: 50px;">
                <!-- Buttons injected by JS -->
            </div>

        </div>

        {{-- Program Modal --}}
        <div id="programModal" class="modal"
            style="display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.6); opacity: 0; transition: opacity 0.3s ease;">
            <div class="modal-content"
                style="background-color: #fefefe; margin: 5% auto; padding: 0; border: 1px solid #888; width: 90%; max-width: 700px; border-radius: 15px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.25); transform: translateY(-50px); transition: transform 0.3s ease;">
                <div class="modal-header" id="modalHeaderBg"
                    style="height: 250px; background-size: cover; background-position: center; position: relative;">
                    <span class="close-modal" onclick="closeProgramModal()"
                        style="position: absolute; top: 15px; right: 20px; color: white; font-size: 35px; font-weight: bold; cursor: pointer; text-shadow: 0 2px 4px rgba(0,0,0,0.5); z-index: 10;">&times;</span>
                    <span id="modalCategory" class="tag"
                        style="position: absolute; bottom: 20px; left: 25px; background: var(--primary-color, #2e7d32); color: white; padding: 6px 18px; border-radius: 20px; font-size: 0.9rem; font-weight: 600; box-shadow: 0 4px 10px rgba(0,0,0,0.2);"></span>
                </div>
                <div class="modal-body" style="padding: 30px;">
                    <h2 id="modalTitle" style="color: var(--dark); font-size: 1.8rem; margin-bottom: 20px;"></h2>
                    <div
                        style="display: flex; align-items: center; margin-bottom: 25px; padding-bottom: 15px; border-bottom: 1px solid #eee;">
                        <span style="color: var(--primary-color, #2e7d32); font-weight: 500; font-size: 1rem;"><i
                                class="far fa-calendar-check" style="margin-right: 8px;"></i> <span
                                id="modalSchedule"></span></span>
                    </div>
                    <h4 style="font-size: 1.1rem; color: #444; margin-bottom: 10px;">Deskripsi Program:</h4>
                    <p id="modalDescription" style="color: #555; line-height: 1.8; font-size: 1.05rem;"></p>
                </div>
                <div class="modal-footer"
                    style="padding: 20px 30px; background: #f9f9f9; text-align: right; border-top: 1px solid #eee;">
                    <button onclick="closeProgramModal()"
                        style="padding: 10px 25px; background: var(--primary-color, #2e7d32); color: white; border: none; border-radius: 25px; cursor: pointer; font-weight: 600; font-size: 0.95rem; transition: background 0.3s;">Tutup</button>
                </div>
            </div>
        </div>

    </section>

    @push('scripts')
        <script>
            // Modal functions
            function openProgramModal(title, category, description, schedule, image) {
                try {
                    document.getElementById('modalTitle').innerText = title;
                    document.getElementById('modalCategory').innerText = category;
                    document.getElementById('modalDescription').innerText = description;
                    document.getElementById('modalSchedule').innerText = schedule;
                    document.getElementById('modalHeaderBg').style.backgroundImage =
                        'linear-gradient(to bottom, rgba(0,0,0,0.1), rgba(0,0,0,0.6)), url(' + image + ')';

                    const modal = document.getElementById('programModal');
                    const modalContent = modal.querySelector('.modal-content');

                    modal.style.display = "block";

                    // For fade-in animation
                    setTimeout(() => {
                        modal.style.opacity = "1";
                        modalContent.style.transform = "translateY(0)";
                    }, 10);

                    // Prevent body scroll
                    document.body.style.overflow = "hidden";
                } catch (e) {
                    console.error("Error opening modal: ", e);
                }
            }

            function closeProgramModal() {
                try {
                    const modal = document.getElementById('programModal');
                    const modalContent = modal.querySelector('.modal-content');

                    modal.style.opacity = "0";
                    modalContent.style.transform = "translateY(-50px)";

                    setTimeout(() => {
                        modal.style.display = "none";
                        document.body.style.overflow = "auto";
                    }, 300);
                } catch (e) {
                    console.error("Error closing modal: ", e);
                }
            }

            // Close modal when clicking outside
            window.onclick = function(event) {
                const modal = document.getElementById('programModal');
                if (event.target == modal) {
                    closeProgramModal();
                }
            }

            // Filter & Pagination functionality
            document.addEventListener('DOMContentLoaded', function() {
                try {
                    const selectedProgramTitle = @json(request()->query('program'));
                    const filterBtns = document.querySelectorAll('.btn-filter');
                    const programCards = Array.from(document.querySelectorAll('.program-card'));
                    const paginationControls = document.getElementById('paginationControls');

                    const itemsPerPage = 6;
                    let currentPage = 1;
                    let currentFilter = 'all';

                    function updatePagination() {
                        const filteredCards = programCards.filter(card => {
                            if (currentFilter === 'all') return true;
                            return card.getAttribute('data-category') === currentFilter;
                        });

                        const totalPages = Math.ceil(filteredCards.length / itemsPerPage);

                        // Handle empty states or single page
                        if (totalPages <= 1) {
                            paginationControls.innerHTML = '';
                        } else {
                            let paginationHTML = '';

                            paginationHTML +=
                                `<button class="page-btn nav-btn" data-page="prev" ${currentPage === 1 ? 'disabled' : ''} style="padding: 8px 15px; border: 1px solid #ddd; background: ${currentPage === 1 ? '#f5f5f5' : 'white'}; color: ${currentPage === 1 ? '#aaa' : '#333'}; border-radius: 5px; cursor: ${currentPage === 1 ? 'not-allowed' : 'pointer'};"><i class="fas fa-chevron-left"></i></button>`;

                            for (let i = 1; i <= totalPages; i++) {
                                const isActive = i === currentPage;
                                paginationHTML +=
                                    `<button class="page-btn" data-page="${i}" style="padding: 8px 15px; border: 1px solid ${isActive ? 'var(--primary-color, #2e7d32)' : '#ddd'}; background: ${isActive ? 'var(--primary-color, #2e7d32)' : 'white'}; color: ${isActive ? 'white' : '#333'}; border-radius: 5px; cursor: pointer; transition: all 0.3s;">${i}</button>`;
                            }

                            paginationHTML +=
                                `<button class="page-btn nav-btn" data-page="next" ${currentPage === totalPages ? 'disabled' : ''} style="padding: 8px 15px; border: 1px solid #ddd; background: ${currentPage === totalPages ? '#f5f5f5' : 'white'}; color: ${currentPage === totalPages ? '#aaa' : '#333'}; border-radius: 5px; cursor: ${currentPage === totalPages ? 'not-allowed' : 'pointer'};"><i class="fas fa-chevron-right"></i></button>`;

                            paginationControls.innerHTML = paginationHTML;

                            // Add event listeners
                            document.querySelectorAll('.page-btn').forEach(btn => {
                                btn.addEventListener('click', function() {
                                    if (this.disabled) return;

                                    const action = this.getAttribute('data-page');
                                    if (action === 'prev') {
                                        currentPage = Math.max(1, currentPage - 1);
                                    } else if (action === 'next') {
                                        currentPage = Math.min(totalPages, currentPage + 1);
                                    } else {
                                        currentPage = parseInt(action);
                                    }

                                    renderCards();

                                    // Scroll to top of section
                                    document.querySelector('.programs-section').scrollIntoView({
                                        behavior: 'smooth'
                                    });
                                });
                            });
                        }
                    }

                    function renderCards() {
                        const filteredCards = programCards.filter(card => {
                            if (currentFilter === 'all') return true;
                            return card.getAttribute('data-category') === currentFilter;
                        });

                        const startIndex = (currentPage - 1) * itemsPerPage;
                        const endIndex = startIndex + itemsPerPage;

                        // Hide all
                        programCards.forEach(card => {
                            card.style.display = 'none';
                            card.style.opacity = '0';
                            card.style.transform = '';
                        });

                        // Show paginated subset
                        const cardsToShow = filteredCards.slice(startIndex, endIndex);
                        cardsToShow.forEach((card, index) => {
                            card.style.display = 'block';
                            setTimeout(() => {
                                card.style.opacity = '1';
                                card.style.transform = '';
                            }, 50 * index); // Staggered
                        });

                        updatePagination();
                    }

                    filterBtns.forEach(btn => {
                        btn.addEventListener('click', function() {
                            filterBtns.forEach(b => {
                                b.classList.remove('active');
                                b.style.background = 'transparent';
                                b.style.color = 'var(--primary-color, #2e7d32)';
                            });

                            this.classList.add('active');
                            this.style.background = 'var(--primary-color, #2e7d32)';
                            this.style.color = 'white';

                            currentFilter = this.getAttribute('data-filter');
                            currentPage = 1; // Reset to page 1

                            renderCards();
                        });
                    });

                    // Initial load
                    renderCards();

                    // Auto-open modal for selected program from beranda card click
                    if (selectedProgramTitle) {
                        const targetCard = programCards.find(card => card.getAttribute('data-program-title') ===
                            selectedProgramTitle);

                        if (targetCard) {
                            const targetIndex = programCards.indexOf(targetCard);
                            currentFilter = 'all';
                            currentPage = Math.floor(targetIndex / itemsPerPage) + 1;

                            filterBtns.forEach(b => {
                                b.classList.remove('active');
                                b.style.background = 'transparent';
                                b.style.color = 'var(--primary-color, #2e7d32)';
                            });

                            const allBtn = document.querySelector('.btn-filter[data-filter="all"]');
                            if (allBtn) {
                                allBtn.classList.add('active');
                                allBtn.style.background = 'var(--primary-color, #2e7d32)';
                                allBtn.style.color = 'white';
                            }

                            renderCards();

                            setTimeout(() => {
                                targetCard.scrollIntoView({
                                    behavior: 'smooth',
                                    block: 'center'
                                });
                                targetCard.click();
                            }, 250);

                            if (window.history.replaceState) {
                                window.history.replaceState({}, document.title, window.location.pathname);
                            }
                        }
                    }

                } catch (e) {
                    console.error("Error setting up filters and pagination: ", e);
                }
            });
        </script>
    @endpush
@endsection

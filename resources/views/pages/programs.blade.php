@extends('layouts.app')

@section('title', 'Program Lingkungan - Go Green School')

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
                    <i class="fas fa-seedling"></i>
                </div>
                <div class="page-hero-badge">
                    <i class="fas fa-circle"></i> Keberlanjutan Lingkungan
                </div>
                <h1>Program <span class="highlight">Unggulan</span> Sekolah</h1>
                <div class="page-hero-decor-line"></div>
                <p class="page-hero-desc">
                    Kami memiliki berbagai program keberlanjutan yang melibatkan seluruh warga sekolah untuk menciptakan lingkungan yang lebih bersih dan sehat.
                </p>
                <div class="page-hero-breadcrumb">
                    <a href="{{ route('home') }}"><i class="fas fa-home"></i> Beranda</a>
                    <span class="separator"><i class="fas fa-chevron-right"></i></span>
                    <span class="current">Program</span>
                </div>
            </div>
        </div>
    </section>

    <section class="programs-section" style="padding: 60px 0; background: #f9fcfa;">
        <div class="container">

            <div class="programs-tabs" style="margin-bottom: 40px; justify-content: center;">
                <button class="tab active">Semua Program</button>
                <button class="tab">Penghijauan</button>
                <button class="tab">Daur Ulang</button>
                <button class="tab">Edukasi</button>
            </div>

            <div class="programs-grid"
                style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 30px;">

                {{-- Program 1 --}}
                <div class="program-card fade-in"
                    style="background: white; border-radius: 15px; overflow: hidden;">
                    <div class="program-card-img"
                        style="background-image: url('https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'); height: 220px; background-size: cover; background-position: center; position: relative;">
                        <span class="tag"
                            style="position: absolute; top: 15px; left: 15px; background: var(--primary); color: white; padding: 5px 15px; border-radius: 20px; font-size: 0.85rem; font-weight: 600; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">Penghijauan</span>
                    </div>
                    <div class="program-card-body" style="padding: 25px;">
                        <h3 style="margin-bottom: 15px; color: var(--dark); font-size: 1.3rem;">Satu Siswa Satu Pohon</h3>
                        <p style="color: var(--gray); margin-bottom: 20px; line-height: 1.6; font-size: 0.95rem;">Program
                            wajib bagi seluruh siswa baru untuk menanam dan merawat satu pohon selama masa studi mereka di
                            sekolah. Tujuannya adalah menanamkan rasa memiliki dan tanggung jawab.</p>
                        <div
                            style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #eee; padding-top: 15px;">
                            <span style="color: var(--primary); font-weight: 500; font-size: 0.9rem;"><i
                                    class="far fa-calendar-check"></i> Rutin Tahunan</span>
                        </div>
                    </div>
                </div>

                {{-- Program 2 --}}
                <div class="program-card fade-in"
                    style="background: white; border-radius: 15px; overflow: hidden;">
                    <div class="program-card-img"
                        style="background-image: url('https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'); height: 220px; background-size: cover; background-position: center; position: relative;">
                        <span class="tag"
                            style="position: absolute; top: 15px; left: 15px; background: var(--accent); color: white; padding: 5px 15px; border-radius: 20px; font-size: 0.85rem; font-weight: 600; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">Daur
                            Ulang</span>
                    </div>
                    <div class="program-card-body" style="padding: 25px;">
                        <h3 style="margin-bottom: 15px; color: var(--dark); font-size: 1.3rem;">Bank Sampah Sekolah</h3>
                        <p style="color: var(--gray); margin-bottom: 20px; line-height: 1.6; font-size: 0.95rem;">Sistem
                            pengelolaan sampah terpadu dimana siswa dapat menyetorkan sampah anorganik terpilah dan
                            menukarkannya dengan poin yang bisa digunakan untuk membeli buku.</p>
                        <div
                            style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #eee; padding-top: 15px;">
                            <span style="color: var(--primary); font-weight: 500; font-size: 0.9rem;"><i
                                    class="fas fa-sync-alt"></i> Setiap Jumat</span>
                        </div>
                    </div>
                </div>

                {{-- Program 3 --}}
                <div class="program-card fade-in"
                    style="background: white; border-radius: 15px; overflow: hidden;">
                    <div class="program-card-img"
                        style="background-image: url('https://images.unsplash.com/photo-1497435334941-8c899ee9e8e9?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'); height: 220px; background-size: cover; background-position: center; position: relative;">
                        <span class="tag"
                            style="position: absolute; top: 15px; left: 15px; background: #e67e22; color: white; padding: 5px 15px; border-radius: 20px; font-size: 0.85rem; font-weight: 600; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">Edukasi</span>
                    </div>
                    <div class="program-card-body" style="padding: 25px;">
                        <h3 style="margin-bottom: 15px; color: var(--dark); font-size: 1.3rem;">Workshop Eco-Enzyme</h3>
                        <p style="color: var(--gray); margin-bottom: 20px; line-height: 1.6; font-size: 0.95rem;">Pelatihan
                            rutin pembuatan cairan serbaguna pembersih ramah lingkungan dari sisa buah dan sayuran kantin
                            untuk mengurangi volume limbah organik.</p>
                        <div
                            style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #eee; padding-top: 15px;">
                            <span style="color: var(--primary); font-weight: 500; font-size: 0.9rem;"><i
                                    class="fas fa-flask"></i> Program Bulanan</span>
                        </div>
                    </div>
                </div>

                {{-- Program 4 --}}
                <div class="program-card fade-in"
                    style="background: white; border-radius: 15px; overflow: hidden;">
                    <div class="program-card-img"
                        style="background-image: url('https://images.unsplash.com/photo-1548611716-e414c2f6d0f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'); height: 220px; background-size: cover; background-position: center; position: relative;">
                        <span class="tag"
                            style="position: absolute; top: 15px; left: 15px; background: #3498db; color: white; padding: 5px 15px; border-radius: 20px; font-size: 0.85rem; font-weight: 600; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">Kebijakan</span>
                    </div>
                    <div class="program-card-body" style="padding: 25px;">
                        <h3 style="margin-bottom: 15px; color: var(--dark); font-size: 1.3rem;">Kantin Bebas Plastik</h3>
                        <p style="color: var(--gray); margin-bottom: 20px; line-height: 1.6; font-size: 0.95rem;">Kantin
                            sekolah menerapkan 100% bebas kemasan plastik sekali pakai. Seluruh siswa dan guru diwajibkan
                            membawa bekal atau alat makan sendiri.</p>
                        <div
                            style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #eee; padding-top: 15px;">
                            <span style="color: var(--primary); font-weight: 500; font-size: 0.9rem;"><i
                                    class="fas fa-ban"></i> Diterapkan Harian</span>
                        </div>
                    </div>
                </div>

                {{-- Program 5 --}}
                <div class="program-card fade-in"
                    style="background: white; border-radius: 15px; overflow: hidden;">
                    <div class="program-card-img"
                        style="background-image: url('https://images.unsplash.com/photo-1518531933037-91b2f5f229cc?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'); height: 220px; background-size: cover; background-position: center; position: relative;">
                        <span class="tag"
                            style="position: absolute; top: 15px; left: 15px; background: #9b59b6; color: white; padding: 5px 15px; border-radius: 20px; font-size: 0.85rem; font-weight: 600; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">Konservasi</span>
                    </div>
                    <div class="program-card-body" style="padding: 25px;">
                        <h3 style="margin-bottom: 15px; color: var(--dark); font-size: 1.3rem;">Pemanenan Air Hujan</h3>
                        <p style="color: var(--gray); margin-bottom: 20px; line-height: 1.6; font-size: 0.95rem;">Sistem
                            canggih penampungan dan penyaringan air hujan untuk keperluan non-konsumsi, seperti menyiram
                            taman, mencuci kendaraan, dan flushing toilet.</p>
                        <div
                            style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #eee; padding-top: 15px;">
                            <span style="color: var(--primary); font-weight: 500; font-size: 0.9rem;"><i
                                    class="fas fa-tint"></i> Infrastruktur Pasif</span>
                        </div>
                    </div>
                </div>

                {{-- Program 6 --}}
                <div class="program-card fade-in"
                    style="background: white; border-radius: 15px; overflow: hidden;">
                    <div class="program-card-img"
                        style="background-image: url('https://images.unsplash.com/photo-1466692476868-aef1dfb1e735?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'); height: 220px; background-size: cover; background-position: center; position: relative;">
                        <span class="tag"
                            style="position: absolute; top: 15px; left: 15px; background: var(--primary-dark); color: white; padding: 5px 15px; border-radius: 20px; font-size: 0.85rem; font-weight: 600; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">Edukasi</span>
                    </div>
                    <div class="program-card-body" style="padding: 25px;">
                        <h3 style="margin-bottom: 15px; color: var(--dark); font-size: 1.3rem;">Kebun Hidroponik & TOGA</h3>
                        <p style="color: var(--gray); margin-bottom: 20px; line-height: 1.6; font-size: 0.95rem;">
                            Pembelajaran life-skill siswa di mana mereka belajar bercocok tanam tanpa tanah (hidroponik) dan
                            merawat Tanaman Obat Keluarga (TOGA).</p>
                        <div
                            style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #eee; padding-top: 15px;">
                            <span style="color: var(--primary); font-weight: 500; font-size: 0.9rem;"><i
                                    class="fas fa-seedling"></i> Ekstrakurikuler</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

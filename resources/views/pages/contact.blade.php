@extends('layouts.app')

@section('title', 'Kontak - Go Green School')

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
                    <i class="fas fa-envelope"></i>
                </div>
                <div class="page-hero-badge">
                    <i class="fas fa-circle"></i> Go Green School
                </div>
                <h1><span class="highlight">Hubungi</span> Kami</h1>
                <div class="page-hero-decor-line"></div>
                <p class="page-hero-desc">
                    Punya pertanyaan, ide kolaborasi, atau butuh informasi pendaftaran? Jangan ragu untuk menghubungi tim Go Green School.
                </p>
                <div class="page-hero-breadcrumb">
                    <a href="{{ route('home') }}"><i class="fas fa-home"></i> Beranda</a>
                    <span class="separator"><i class="fas fa-chevron-right"></i></span>
                    <span class="current">Hubungi Kami</span>
                </div>
            </div>
        </div>
    </section>

    <section class="contact-section" style="padding: 60px 0; background: #fff;">
        <div class="container">

            <div style="display: flex; flex-wrap: wrap; gap: 50px;">

                {{-- Contact Info --}}
                <div class="contact-info-card" style="flex: 1 1 40%;">
                    <h2 style="font-size: 2rem; color: var(--dark); margin-bottom: 20px;">Informasi Kontak</h2>
                    <p style="color: var(--gray); line-height: 1.6; margin-bottom: 40px;">Kami senang mendengar dari Anda!
                        Silakan kunjung sekolah kami di jam kerja atau hubungi kami melalui kanal di bawah ini.</p>

                    <div style="display: flex; flex-direction: column; gap: 30px;">
                        <div style="display: flex; gap: 20px; align-items: flex-start;">
                            <div
                                style="width: 50px; height: 50px; background: #e8f5e9; color: var(--primary); display: flex; align-items: center; justify-content: center; border-radius: 50%; font-size: 1.2rem; flex-shrink: 0;">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div>
                                <h4 style="color: var(--dark); margin-bottom: 8px;">Alamat Sekolah</h4>
                                <p style="color: var(--gray); margin: 0; line-height: 1.5;">Jalan Pendidikan Hijau No.
                                    10,<br>Kecamatan Lestari, Jakarta Selatan 12345</p>
                            </div>
                        </div>

                        <div style="display: flex; gap: 20px; align-items: flex-start;">
                            <div
                                style="width: 50px; height: 50px; background: #fdf2e9; color: var(--accent); display: flex; align-items: center; justify-content: center; border-radius: 50%; font-size: 1.2rem; flex-shrink: 0;">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div>
                                <h4 style="color: var(--dark); margin-bottom: 8px;">Email Resmi</h4>
                                <p style="color: var(--gray); margin: 0; line-height: 1.5;">
                                    info@gogreenschool.id<br>admissions@gogreenschool.id</p>
                            </div>
                        </div>

                        <div style="display: flex; gap: 20px; align-items: flex-start;">
                            <div
                                style="width: 50px; height: 50px; background: #ebf5fb; color: #3498db; display: flex; align-items: center; justify-content: center; border-radius: 50%; font-size: 1.2rem; flex-shrink: 0;">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <div>
                                <h4 style="color: var(--dark); margin-bottom: 8px;">Telepon & WhatsApp</h4>
                                <p style="color: var(--gray); margin: 0; line-height: 1.5;">(021) 1234-5678<br>+62
                                    812-3456-7890</p>
                            </div>
                        </div>
                    </div>

                    <div style="margin-top: 40px;">
                        <h4 style="color: var(--dark); margin-bottom: 15px;">Ikuti Sosial Media Kami</h4>
                        <div style="display: flex; gap: 15px;">
                            <a href="#"
                                style="width: 40px; height: 40px; background: var(--primary); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none;"><i
                                    class="fab fa-instagram"></i></a>
                            <a href="#"
                                style="width: 40px; height: 40px; background: var(--primary); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none;"><i
                                    class="fab fa-facebook-f"></i></a>
                            <a href="#"
                                style="width: 40px; height: 40px; background: var(--primary); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none;"><i
                                    class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>

                {{-- Contact Form --}}
                <div class="contact-form-card"
                    style="flex: 1 1 50%; background: #f9fcfa; padding: 40px; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
                    <h3 style="font-size: 1.5rem; color: var(--dark); margin-bottom: 25px;">Kirim Pesan Langsung</h3>
                    <form action="#" method="POST">
                        <div style="display: flex; gap: 20px; margin-bottom: 20px; flex-wrap: wrap;">
                            <div style="flex: 1 1 calc(50% - 10px);">
                                <label
                                    style="display: block; color: var(--dark); margin-bottom: 8px; font-weight: 500;">Nama
                                    Lengkap</label>
                                <input type="text" placeholder="Masukkan nama..."
                                    style="width: 100%; padding: 12px 15px; border: 1px solid #ddd; border-radius: 8px; outline: none; font-family: inherit;">
                            </div>
                            <div style="flex: 1 1 calc(50% - 10px);">
                                <label
                                    style="display: block; color: var(--dark); margin-bottom: 8px; font-weight: 500;">Email
                                    Aktif</label>
                                <input type="email" placeholder="contoh@email.com"
                                    style="width: 100%; padding: 12px 15px; border: 1px solid #ddd; border-radius: 8px; outline: none; font-family: inherit;">
                            </div>
                        </div>

                        <div style="margin-bottom: 20px;">
                            <label style="display: block; color: var(--dark); margin-bottom: 8px; font-weight: 500;">Subjek
                                Pesan</label>
                            <select
                                style="width: 100%; padding: 12px 15px; border: 1px solid #ddd; border-radius: 8px; outline: none; font-family: inherit; background: white;">
                                <option>Informasi Pendaftaran</option>
                                <option>Pertanyaan Program Lingkungan</option>
                                <option>Tawaran Kolaborasi / Sponsor</option>
                                <option>Lainnya</option>
                            </select>
                        </div>

                        <div style="margin-bottom: 25px;">
                            <label style="display: block; color: var(--dark); margin-bottom: 8px; font-weight: 500;">Pesan
                                Anda</label>
                            <textarea rows="5" placeholder="Tuliskan pesan detail Anda di sini..."
                                style="width: 100%; padding: 12px 15px; border: 1px solid #ddd; border-radius: 8px; outline: none; font-family: inherit; resize: vertical;"></textarea>
                        </div>

                        <button type="submit" class="btn-primary"
                            style="width: 100%; border: none; padding: 15px; font-size: 1.1rem; cursor: pointer; border-radius: 8px;">Kirim
                            Pesan Sekarang</button>
                        <p style="text-align: center; margin-top: 15px; font-size: 0.85rem; color: var(--gray);">Tim kami
                            akan membalas pesan Anda maksimal 1x24 jam kerja.</p>
                    </form>
                </div>

            </div>

        </div>
    </section>
@endsection

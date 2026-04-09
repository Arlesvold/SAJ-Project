@extends('layouts.app')

@section('title', 'Prosedur Daur Ulang - Go Green School')

@push('styles')
    <style>
        .procedure-content {
            padding: 72px 0;
            background:
                radial-gradient(circle at 12% 18%, rgba(129, 199, 132, .2), transparent 34%),
                radial-gradient(circle at 88% 84%, rgba(46, 125, 50, .12), transparent 36%),
                linear-gradient(180deg, #f8fcf8 0%, #f2f8f2 100%);
        }

        .procedure-layout {
            display: grid;
            gap: 24px;
        }

        .procedure-top-grid {
            display: grid;
            grid-template-columns: minmax(0, 1fr);
            gap: 24px;
        }

        .procedure-top-grid .procedure-panel {
            width: 100%;
            max-width: 100%;
        }

        .procedure-panel {
            position: relative;
            background: linear-gradient(145deg, #ffffff 0%, #f6fbf7 100%);
            border: 1px solid rgba(46, 125, 50, .12);
            border-radius: 22px;
            padding: 28px;
            box-shadow: 0 16px 38px rgba(17, 53, 30, .1);
            overflow: hidden;
        }

        .procedure-panel::before {
            content: '';
            position: absolute;
            top: -70px;
            right: -80px;
            width: 170px;
            height: 170px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(129, 199, 132, .24), rgba(129, 199, 132, 0));
            pointer-events: none;
        }

        .procedure-panel-title {
            margin: 0 0 18px;
            color: #174927;
            font-size: 1.45rem;
            font-weight: 800;
            letter-spacing: .01em;
        }

        .procedure-list {
            list-style: none;
            margin: 0;
            padding: 0;
            display: grid;
            gap: 12px;
        }

        .procedure-list li {
            position: relative;
            padding: 12px 14px 12px 42px;
            border-radius: 12px;
            background: rgba(232, 245, 233, .65);
            border: 1px solid rgba(76, 175, 80, .12);
            color: #2d4934;
            line-height: 1.65;
            font-weight: 500;
        }

        .procedure-list li::before {
            content: '';
            position: absolute;
            left: 16px;
            top: 50%;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            transform: translateY(-50%);
            background: linear-gradient(135deg, #2e7d32, #66bb6a);
            box-shadow: 0 0 0 4px rgba(102, 187, 106, .24);
        }

        .steps-list {
            display: grid;
            gap: 16px;
            margin: 0;
            padding: 0;
        }

        .step-card {
            display: grid;
            grid-template-columns: 58px minmax(0, 1fr);
            gap: 14px;
            align-items: start;
            padding: 16px;
            border-radius: 14px;
            background: rgba(255, 255, 255, .82);
            border: 1px solid rgba(46, 125, 50, .14);
            transition: transform .22s ease, box-shadow .22s ease, border-color .22s ease;
        }

        .step-card:hover {
            transform: translateY(-2px);
            border-color: rgba(46, 125, 50, .28);
            box-shadow: 0 10px 24px rgba(22, 66, 36, .14);
        }

        .step-badge {
            width: 58px;
            height: 58px;
            border-radius: 16px;
            display: grid;
            place-items: center;
            font-size: 1.25rem;
            font-weight: 800;
            color: #fff;
            background: linear-gradient(135deg, #2e7d32, #66bb6a);
            box-shadow: 0 8px 18px rgba(46, 125, 50, .32);
        }

        .step-text {
            margin: 0;
            color: #304e38;
            line-height: 1.75;
            font-weight: 500;
        }

        .procedure-panel-tips {
            background: linear-gradient(145deg, #f8fff9 0%, #ecf9ee 100%);
            border-color: rgba(46, 125, 50, .2);
            box-shadow: 0 18px 36px rgba(21, 72, 36, .12);
        }

        .procedure-panel-tips .procedure-panel-title {
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .procedure-panel-tips .procedure-panel-title::before {
            content: '✓';
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: .95rem;
            color: #fff;
            background: linear-gradient(135deg, #2e7d32, #66bb6a);
            box-shadow: 0 6px 14px rgba(46, 125, 50, .3);
        }

        @media (max-width: 992px) {
            .procedure-top-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .procedure-content {
                padding: 54px 0;
            }

            .procedure-panel {
                padding: 22px;
                border-radius: 18px;
            }

            .procedure-panel-title {
                font-size: 1.25rem;
            }

            .step-card {
                grid-template-columns: 48px minmax(0, 1fr);
                gap: 12px;
            }

            .step-badge {
                width: 48px;
                height: 48px;
                border-radius: 12px;
                font-size: 1.05rem;
            }
        }

        body.dark-mode .procedure-content {
            background:
                radial-gradient(circle at 12% 18%, rgba(76, 175, 80, .16), transparent 34%),
                radial-gradient(circle at 88% 84%, rgba(102, 187, 106, .08), transparent 36%),
                linear-gradient(180deg, #0f1610 0%, #121a13 100%);
        }

        body.dark-mode .procedure-panel {
            background: linear-gradient(145deg, #152018 0%, #132217 100%);
            border-color: #1f2e22;
            box-shadow: 0 16px 38px rgba(0, 0, 0, .42);
        }

        body.dark-mode .procedure-panel-title {
            color: #d6ead9;
        }

        body.dark-mode .procedure-list li {
            background: rgba(19, 34, 23, .82);
            border-color: #2b3d30;
            color: #c2d5c6;
        }

        body.dark-mode .step-card {
            background: rgba(19, 34, 23, .88);
            border-color: #2b3d30;
        }

        body.dark-mode .procedure-panel-tips {
            background: linear-gradient(145deg, #142016 0%, #17261a 100%);
            border-color: #35503c;
            box-shadow: 0 18px 36px rgba(0, 0, 0, .44);
        }

        body.dark-mode .step-text {
            color: #c2d5c6;
        }
    </style>
@endpush

@section('content')
    <section class="page-hero"
        style="background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.7)), url('https://images.unsplash.com/photo-1604187351574-c75ca79f5807?auto=format&fit=crop&w=1800&q=80'); background-size: cover; background-position: center; background-attachment: fixed; position: relative;">
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
                    <i class="fas fa-recycle"></i>
                </div>
                <div class="page-hero-badge"
                    style="background: rgba(76, 175, 80, 0.8); color: white; border: none; padding: 8px 20px; font-weight: bold; border-radius: 30px; display: inline-block; margin-bottom: 20px;">
                    <i class="fas fa-circle" style="color: #c8e6c9;"></i> Daur Ulang & Pengelolaan Sampah
                </div>
                <h1 style="color: white; font-size: 3.5rem; font-weight: 800; text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">
                    Prosedur&nbsp;<span class="highlight" style="color: #a5d6a7; text-shadow: none;">Daur Ulang</span></h1>
                <div class="page-hero-decor-line" style="background: #a5d6a7; height: 4px; width: 60px; margin: 20px auto;">
                </div>
                <p class="page-hero-desc"
                    style="color: #e0e0e0; font-size: 1.2rem; max-width: 600px; margin: 0 auto 30px; text-shadow: 1px 1px 3px rgba(0,0,0,0.5);">
                    Pelajari langkah-langkah penting dalam proses daur ulang untuk menjaga lingkungan tetap bersih dan
                    hijau. Mari bersama-sama berkontribusi untuk bumi yang lebih baik.
                </p>
                <div class="page-hero-breadcrumb"
                    style="background: rgba(0,0,0,0.4); padding: 10px 20px; border-radius: 20px; display: inline-flex; gap: 10px;">
                    <a href="{{ route('home') }}" style="color: #a5d6a7; text-decoration: none;"><i class="fas fa-home"></i>
                        Beranda</a>
                    <span class="separator" style="color: #999;"><i class="fas fa-chevron-right"></i></span>
                    <span class="current" style="color: white;">Prosedur</span>
                </div>
            </div>
        </div>
    </section>

    <section class="procedure-content">
        <div class="container">
            <div class="procedure-layout">
                <div class="procedure-top-grid">
                    <article class="procedure-panel">
                        <h2 class="procedure-panel-title">Bahan yang dibutuhkan:</h2>
                        <ul class="procedure-list">
                            <li><strong>Tiga tempat sampah terpisah:</strong> Membedakan jenis sampah organik, anorganik,
                                dan kertas agar mudah didaur ulang.</li>
                            <li><strong>Label atau stiker:</strong> Menjadi penanda visual agar warga sekolah membuang
                                sampah pada tempat yang tepat.</li>
                            <li><strong>Sarung tangan keamanan:</strong> Melindungi tangan dari kotoran dan bakteri saat
                                melakukan proses pemilahan sampah.</li>
                            <li><strong>Wadah khusus komposter:</strong> Menampung sisa sampah organik untuk difermentasi
                                menjadi pupuk kompos alami.</li>
                        </ul>
                    </article>
                </div>

                <article class="procedure-panel">
                    <h2 class="procedure-panel-title">Langkah-langkah:</h2>
                    <div class="steps-list">
                        <div class="step-card">
                            <div class="step-badge">1</div>
                            <p class="step-text">Pertama, kategorikan tempat sampah dengan memberi label yang jelas:
                                "Organik" untuk sisa makanan, "Anorganik" untuk plastik/kaleng, dan "Kertas" untuk buku
                                tulis atau kardus.</p>
                        </div>
                        <div class="step-card">
                            <div class="step-badge">2</div>
                            <p class="step-text">Kedua, kumpulkan sampah setiap hari dan pastikan benda anorganik, seperti
                                botol plastik atau kotak susu, dibilas dan dikeringkan untuk mencegah bau dan bakteri.</p>
                        </div>
                        <div class="step-card">
                            <div class="step-badge">3</div>
                            <p class="step-text">Ketiga, pindahkan sampah organik ke area pengomposan atau ke wadah kompos
                                untuk diproses menjadi pupuk alami bagi kebun sekolah.</p>
                        </div>
                        <div class="step-card">
                            <div class="step-badge">4</div>
                            <p class="step-text">Selanjutnya, sortir sampah anorganik. Benda yang masih dalam kondisi baik
                                dapat di-"upcycle" menjadi kerajinan atau dekorasi sekolah.</p>
                        </div>
                        <div class="step-card">
                            <div class="step-badge">5</div>
                            <p class="step-text">Terakhir, kirim sisa material yang dapat didaur ulang (seperti kertas dan
                                plastik bersih) ke pusat daur ulang setempat atau ke "Bank Sampah".</p>
                        </div>
                    </div>
                </article>

                <article class="procedure-panel procedure-panel-tips">
                    <h2 class="procedure-panel-title">Tips untuk Sukses:</h2>
                    <ul class="procedure-list">
                        <li>Konsisten: Selalu periksa tempat sampah untuk memastikan tidak ada "kontaminasi silang"
                            (misalnya plastik di tempat sampah organik).</li>
                        <li>Kurangi Terlebih Dahulu: Ingat bahwa daur ulang adalah pilihan terakhir; cara terbaik untuk
                            membantu adalah mengurangi sampah dari awal.</li>
                        <li>Kolaborasi: Bekerja sama dengan kantin sekolah untuk meminimalkan penggunaan kemasan plastik
                            dalam pelayanannya.</li>
                    </ul>
                </article>
            </div>
        </div>
    </section>
@endsection

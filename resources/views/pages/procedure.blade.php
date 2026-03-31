@extends('layouts.app')

@section('title', 'Prosedur Daur Ulang - Go Green School')

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
                    <i class="fas fa-recycle"></i>
                </div>
                <div class="page-hero-badge">
                    <i class="fas fa-circle"></i> Daur Ulang & Pengelolaan Sampah
                </div>
                <h1>Prosedur <span class="highlight">Daur Ulang</span></h1>
                <div class="page-hero-decor-line"></div>
                <p class="page-hero-desc">
                    Pelajari langkah-langkah penting dalam proses daur ulang untuk menjaga lingkungan tetap bersih dan
                    hijau. Mari bersama-sama berkontribusi untuk bumi yang lebih baik.
                </p>
                <div class="page-hero-breadcrumb">
                    <a href="{{ route('home') }}"><i class="fas fa-home"></i> Beranda</a>
                    <span class="separator"><i class="fas fa-chevron-right"></i></span>
                    <span class="current">Prosedur</span>
                </div>
            </div>
        </div>
    </section>

    <section class="procedure-section" style="padding: 60px 0; background: #fbfdfb;">
        <div class="container">

            <div style="text-align: center; margin-bottom: 50px;">
                <h2 style="color: var(--dark); font-size: 2rem; margin-bottom: 15px;">Langkah-Langkah Daur Ulang</h2>
                <p style="color: var(--gray); max-width: 600px; margin: 0 auto;">Pelajari proses daur ulang yang benar untuk
                    berkontribusi pada lingkungan yang lebih bersih</p>
            </div>

            <div class="procedure-steps"
                style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px; margin-bottom: 60px;">
                <div class="procedure-step"
                    style="background: #fff; border-radius: 15px; padding: 30px; box-shadow: 0 5px 20px rgba(0,0,0,0.08); border: 1px solid #e8f5e9;  cursor: pointer; text-align: center;"
                    
                    >
                    <div class="step-number"
                        style="width: 60px; height: 60px; background: var(--primary-color, #2e7d32); color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; font-weight: 700; margin: 0 auto 20px; box-shadow: 0 4px 15px rgba(46, 125, 50, 0.3); transition: all 0.3s ease;">
                        1</div>
                    <div class="step-icon"
                        style="font-size: 2rem; color: var(--primary-color, #2e7d32); margin-bottom: 15px; transition: all 0.3s ease;">
                        <i class="fas fa-recycle"></i></div>
                    <h3 class="step-title"
                        style="font-size: 1.3rem; font-weight: 600; color: #333; margin-bottom: 15px; transition: color 0.3s ease;">
                        Pengumpulan</h3>
                    <p class="step-description"
                        style="color: #666; line-height: 1.6; font-size: 0.95rem; transition: color 0.3s ease;">Kumpulkan
                        sampah yang dapat didaur ulang seperti plastik, kertas, kaca, dan logam dari rumah, sekolah, atau
                        lingkungan sekitar.</p>
                </div>

                <div class="procedure-step"
                    style="background: #fff; border-radius: 15px; padding: 30px; box-shadow: 0 5px 20px rgba(0,0,0,0.08); border: 1px solid #e8f5e9;  cursor: pointer; text-align: center;"
                    
                    >
                    <div class="step-number"
                        style="width: 60px; height: 60px; background: var(--primary-color, #2e7d32); color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; font-weight: 700; margin: 0 auto 20px; box-shadow: 0 4px 15px rgba(46, 125, 50, 0.3); transition: all 0.3s ease;">
                        2</div>
                    <div class="step-icon"
                        style="font-size: 2rem; color: var(--primary-color, #2e7d32); margin-bottom: 15px; transition: all 0.3s ease;">
                        <i class="fas fa-sort"></i></div>
                    <h3 class="step-title"
                        style="font-size: 1.3rem; font-weight: 600; color: #333; margin-bottom: 15px; transition: color 0.3s ease;">
                        Pemisahan</h3>
                    <p class="step-description"
                        style="color: #666; line-height: 1.6; font-size: 0.95rem; transition: color 0.3s ease;">Pisahkan
                        sampah berdasarkan jenis materialnya. Pastikan plastik, kertas, kaca, dan logam dipisahkan dengan
                        benar untuk memudahkan proses selanjutnya.</p>
                </div>

                <div class="procedure-step"
                    style="background: #fff; border-radius: 15px; padding: 30px; box-shadow: 0 5px 20px rgba(0,0,0,0.08); border: 1px solid #e8f5e9;  cursor: pointer; text-align: center;"
                    
                    >
                    <div class="step-number"
                        style="width: 60px; height: 60px; background: var(--primary-color, #2e7d32); color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; font-weight: 700; margin: 0 auto 20px; box-shadow: 0 4px 15px rgba(46, 125, 50, 0.3); transition: all 0.3s ease;">
                        3</div>
                    <div class="step-icon"
                        style="font-size: 2rem; color: var(--primary-color, #2e7d32); margin-bottom: 15px; transition: all 0.3s ease;">
                        <i class="fas fa-hand-sparkles"></i></div>
                    <h3 class="step-title"
                        style="font-size: 1.3rem; font-weight: 600; color: #333; margin-bottom: 15px; transition: color 0.3s ease;">
                        Pembersihan</h3>
                    <p class="step-description"
                        style="color: #666; line-height: 1.6; font-size: 0.95rem; transition: color 0.3s ease;">Bersihkan
                        sampah dari kotoran, makanan, atau bahan lain yang menempel. Cuci plastik dan kaca hingga bersih
                        sebelum didaur ulang.</p>
                </div>

                <div class="procedure-step"
                    style="background: #fff; border-radius: 15px; padding: 30px; box-shadow: 0 5px 20px rgba(0,0,0,0.08); border: 1px solid #e8f5e9;  cursor: pointer; text-align: center;"
                    
                    >
                    <div class="step-number"
                        style="width: 60px; height: 60px; background: var(--primary-color, #2e7d32); color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; font-weight: 700; margin: 0 auto 20px; box-shadow: 0 4px 15px rgba(46, 125, 50, 0.3); transition: all 0.3s ease;">
                        4</div>
                    <div class="step-icon"
                        style="font-size: 2rem; color: var(--primary-color, #2e7d32); margin-bottom: 15px; transition: all 0.3s ease;">
                        <i class="fas fa-cogs"></i></div>
                    <h3 class="step-title"
                        style="font-size: 1.3rem; font-weight: 600; color: #333; margin-bottom: 15px; transition: color 0.3s ease;">
                        Pengolahan</h3>
                    <p class="step-description"
                        style="color: #666; line-height: 1.6; font-size: 0.95rem; transition: color 0.3s ease;">Proses
                        material daur ulang melalui mesin penghancur, pencairan, atau pemrosesan lainnya untuk mengubahnya
                        menjadi bahan baku baru.</p>
                </div>

                <div class="procedure-step"
                    style="background: #fff; border-radius: 15px; padding: 30px; box-shadow: 0 5px 20px rgba(0,0,0,0.08); border: 1px solid #e8f5e9;  cursor: pointer; text-align: center;"
                    
                    >
                    <div class="step-number"
                        style="width: 60px; height: 60px; background: var(--primary-color, #2e7d32); color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; font-weight: 700; margin: 0 auto 20px; box-shadow: 0 4px 15px rgba(46, 125, 50, 0.3); transition: all 0.3s ease;">
                        5</div>
                    <div class="step-icon"
                        style="font-size: 2rem; color: var(--primary-color, #2e7d32); margin-bottom: 15px; transition: all 0.3s ease;">
                        <i class="fas fa-box-open"></i></div>
                    <h3 class="step-title"
                        style="font-size: 1.3rem; font-weight: 600; color: #333; margin-bottom: 15px; transition: color 0.3s ease;">
                        Pembuatan Produk Baru</h3>
                    <p class="step-description"
                        style="color: #666; line-height: 1.6; font-size: 0.95rem; transition: color 0.3s ease;">Gunakan
                        bahan daur ulang untuk membuat produk baru seperti kertas, botol plastik, atau barang lainnya yang
                        dapat digunakan kembali.</p>
                </div>

                <div class="procedure-step"
                    style="background: #fff; border-radius: 15px; padding: 30px; box-shadow: 0 5px 20px rgba(0,0,0,0.08); border: 1px solid #e8f5e9;  cursor: pointer; text-align: center;"
                    
                    >
                    <div class="step-number"
                        style="width: 60px; height: 60px; background: var(--primary-color, #2e7d32); color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; font-weight: 700; margin: 0 auto 20px; box-shadow: 0 4px 15px rgba(46, 125, 50, 0.3); transition: all 0.3s ease;">
                        6</div>
                    <div class="step-icon"
                        style="font-size: 2rem; color: var(--primary-color, #2e7d32); margin-bottom: 15px; transition: all 0.3s ease;">
                        <i class="fas fa-truck"></i></div>
                    <h3 class="step-title"
                        style="font-size: 1.3rem; font-weight: 600; color: #333; margin-bottom: 15px; transition: color 0.3s ease;">
                        Distribusi</h3>
                    <p class="step-description"
                        style="color: #666; line-height: 1.6; font-size: 0.95rem; transition: color 0.3s ease;">
                        Distribusikan produk daur ulang ke pasar atau gunakan kembali dalam kehidupan sehari-hari untuk
                        melanjutkan siklus daur ulang yang berkelanjutan.</p>
                </div>
            </div>

            <div class="procedure-tips"
                style="background: linear-gradient(135deg, #e8f5e9, #f1f8e9); border-radius: 15px; padding: 40px; text-align: center; border: 2px solid #c8e6c9;">
                <h3
                    style="color: var(--primary-color, #2e7d32); font-size: 1.8rem; margin-bottom: 20px; font-weight: 600;">
                    <i class="fas fa-lightbulb"></i> Tips Daur Ulang</h3>
                <ul
                    style="list-style: none; padding: 0; display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; text-align: left;">
                    <li
                        style="padding: 15px; background: rgba(255, 255, 255, 0.8); border-radius: 10px; border-left: 4px solid var(--primary-color, #2e7d32); font-weight: 500; color: #555;">
                        Cuci kemasan sebelum membuangnya</li>
                    <li
                        style="padding: 15px; background: rgba(255, 255, 255, 0.8); border-radius: 10px; border-left: 4px solid var(--primary-color, #2e7d32); font-weight: 500; color: #555;">
                        Pisahkan sampah organik dan anorganik</li>
                    <li
                        style="padding: 15px; background: rgba(255, 255, 255, 0.8); border-radius: 10px; border-left: 4px solid var(--primary-color, #2e7d32); font-weight: 500; color: #555;">
                        Gunakan kembali barang sebanyak mungkin</li>
                    <li
                        style="padding: 15px; background: rgba(255, 255, 255, 0.8); border-radius: 10px; border-left: 4px solid var(--primary-color, #2e7d32); font-weight: 500; color: #555;">
                        Belajar mengenali simbol daur ulang</li>
                    <li
                        style="padding: 15px; background: rgba(255, 255, 255, 0.8); border-radius: 10px; border-left: 4px solid var(--primary-color, #2e7d32); font-weight: 500; color: #555;">
                        Ajari teman dan keluarga tentang pentingnya daur ulang</li>
                    <li
                        style="padding: 15px; background: rgba(255, 255, 255, 0.8); border-radius: 10px; border-left: 4px solid var(--primary-color, #2e7d32); font-weight: 500; color: #555;">
                        Ikuti program daur ulang di sekolah</li>
                </ul>
            </div>
        </div>
    </section>
@endsection

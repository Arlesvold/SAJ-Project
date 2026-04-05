@extends('layouts.app')

@section('title', 'Visi Misi - Go Green School')

@push('styles')
    <style>
        .faq-modern-container {
            max-width: 860px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .faq-modern-item {
            background: #ffffff;
            border: 1px solid rgba(46, 125, 50, 0.15);
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.02);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .faq-modern-item:hover {
            border-color: rgba(46, 125, 50, 0.4);
        }

        .faq-modern-item.active {
            border-color: #66bb6a;
            box-shadow: 0 8px 25px rgba(46, 125, 50, 0.1);
        }

        .faq-question {
            padding: 22px 25px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
            font-weight: 600;
            color: #1f4e2f;
            font-size: 1.1rem;
            user-select: none;
            gap: 20px;
        }

        .faq-question:hover {
            color: #2e7d32;
        }

        .faq-icon-wrapper {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #e8f5e9;
            color: #2e7d32;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.3s ease, background 0.3s ease, color 0.3s ease;
            flex-shrink: 0;
        }

        .faq-modern-item.active .faq-icon-wrapper {
            transform: rotate(180deg);
            background: #2e7d32;
            color: #ffffff;
        }

        .faq-answer {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s ease;
        }

        .faq-answer-inner {
            padding: 0 25px 25px;
            color: #556b5d;
            line-height: 1.7;
            font-size: 0.98rem;
        }

        .faq-header-badge {
            display: inline-flex;
            padding: 6px 16px;
            background: #e8f5e9;
            color: #2e7d32;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 700;
            margin-bottom: 15px;
            align-items: center;
            gap: 8px;
        }

        #faq-tanya-jawab {
            scroll-margin-top: 120px;
        }
    </style>
@endpush

@section('content')
    <section class="page-hero"
        style="background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.7)), url('https://images.unsplash.com/photo-1518531933037-91b2f5f229cc?auto=format&fit=crop&w=1800&q=80'); background-size: cover; background-position: center; background-attachment: fixed; position: relative;">
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
                    <i class="fas fa-leaf"></i>
                </div>
                <div class="page-hero-badge"
                    style="background: rgba(76, 175, 80, 0.8); color: white; border: none; padding: 8px 20px; font-weight: bold; border-radius: 30px; display: inline-block; margin-bottom: 20px;">
                    <i class="fas fa-circle" style="color: #c8e6c9;"></i> Tentang Sekolah
                </div>
                <h1 style="color: white; font-size: 3.5rem; font-weight: 800; text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">
                    Visi & Misi&nbsp;<span class="highlight" style="color: #a5d6a7; text-shadow: none;">Hijau</span></h1>
                <div class="page-hero-decor-line" style="background: #a5d6a7; height: 4px; width: 60px; margin: 20px auto;">
                </div>
                <p class="page-hero-desc"
                    style="color: #e0e0e0; font-size: 1.2rem; max-width: 600px; margin: 0 auto 30px; text-shadow: 1px 1px 3px rgba(0,0,0,0.5);">
                    Komitmen kami membangun ekosistem pendidikan berkelanjutan yang berwawasan lingkungan untuk masa depan
                    bumi yang lebih baik.
                </p>
                <div class="page-hero-breadcrumb"
                    style="background: rgba(0,0,0,0.4); padding: 10px 20px; border-radius: 20px; display: inline-flex; gap: 10px;">
                    <a href="{{ route('home') }}" style="color: #a5d6a7; text-decoration: none;"><i class="fas fa-home"></i>
                        Beranda</a>
                    <span class="separator" style="color: #999;"><i class="fas fa-chevron-right"></i></span>
                    <span class="current" style="color: white;">Visi Misi</span>
                </div>
            </div>
        </div>
    </section>

    <section class="info-section" style="padding: 60px 0; background: #fff;">
        <div class="container">

            <div style="display: flex; flex-wrap: wrap; gap: 30px; margin-bottom: 70px;">
                <div class="about-visual fade-in" style="flex: 1; min-width: 300px;">
                    <div class="hover-lift"
                        style="background: linear-gradient(145deg, #f1f8e9, #e8f5e9); padding: 40px; border-radius: 20px; text-align: center; position: relative; overflow: hidden; border: 1px solid rgba(46,125,50,0.1); height: 100%;">
                        <i class="fas fa-globe-asia"
                            style="font-size: 5rem; color: var(--primary-color, #2e7d32); margin-bottom: 20px;"></i>
                        <h3 style="font-size: 1.5rem; color: #333; margin-bottom: 15px;">Visi Hijau Kami</h3>
                        <p style="color: #666; line-height: 1.6; position: relative; z-index: 2; text-align: left;">
                            Menciptakan ekosistem pendidikan yang harmonis dengan alam, mencetak pemimpin masa depan
                            yang proaktif, peduli, dan bertanggung jawab terhadap lingkungan sekitarnya. Kami memimpikan
                            sebuah generasi yang tidak hanya cerdas secara akademis, tetapi juga memiliki kesadaran ekologis
                            yang tinggi, menginspirasi aksi nyata, dan menjadi agen perubahan positif dalam mewujudkan bumi
                            yang lebih hijau, sehat, dan lestari untuk generasi mendatang.
                        </p>
                        <!-- Decorative Elements -->
                        <div
                            style="position: absolute; top: -30px; right: -30px; width: 120px; height: 120px; background: rgba(129,199,132,0.3); border-radius: 50%; filter: blur(20px);">
                        </div>
                        <div
                            style="position: absolute; bottom: -30px; left: -30px; width: 120px; height: 120px; background: rgba(46,125,50,0.2); border-radius: 50%; filter: blur(20px);">
                        </div>
                    </div>
                </div>

                <div class="about-visual fade-in" style="flex: 1; min-width: 300px;">
                    <div class="hover-lift"
                        style="background: linear-gradient(145deg, #f1f8e9, #e8f5e9); padding: 40px; border-radius: 20px; text-align: center; position: relative; overflow: hidden; border: 1px solid rgba(46,125,50,0.1); height: 100%;">
                        <i class="fas fa-bullseye"
                            style="font-size: 5rem; color: var(--primary-color, #2e7d32); margin-bottom: 20px;"></i>
                        <h3 style="font-size: 1.5rem; color: #333; margin-bottom: 15px;">Misi Sekolah Hijau</h3>
                        <ul
                            style="color: #666; line-height: 1.6; position: relative; z-index: 2; text-align: left; padding-left: 20px; margin: 0;">
                            <li style="margin-bottom: 10px;">Mengintegrasikan pendidikan lingkungan hidup ke dalam kurikulum
                                dan kegiatan siswa.</li>
                            <li style="margin-bottom: 10px;">Membudayakan pengelolaan sampah melalui prinsip 3R dan bank
                                sampah.</li>
                            <li style="margin-bottom: 10px;">Melaksanakan penghematan energi, air, dan sumber daya sekolah.
                            </li>
                            <li>Menjalin kemitraan dengan masyarakat dan instansi untuk pelestarian lingkungan.</li>
                        </ul>
                        <!-- Decorative Elements -->
                        <div
                            style="position: absolute; top: -30px; right: -30px; width: 120px; height: 120px; background: rgba(129,199,132,0.3); border-radius: 50%; filter: blur(20px);">
                        </div>
                        <div
                            style="position: absolute; bottom: -30px; left: -30px; width: 120px; height: 120px; background: rgba(46,125,50,0.2); border-radius: 50%; filter: blur(20px);">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Teks Eksplanasi Section -->
            <div class="explanation-box fade-in"
                style="margin: 60px 0; background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%); border-radius: 20px; padding: 40px; box-shadow: 0 10px 30px rgba(46, 125, 50, 0.1); position: relative; overflow: hidden;">
                <div style="position: absolute; top: -20px; right: -20px; opacity: 0.1; font-size: 15rem; color: #2e7d32;">
                    <i class="fas fa-recycle"></i>
                </div>
                <div style="position: relative; z-index: 2;">
                    <div
                        style="display: inline-block; background: #2e7d32; color: #fff; padding: 6px 15px; border-radius: 20px; font-size: 0.85rem; font-weight: 600; margin-bottom: 20px; text-transform: uppercase; letter-spacing: 1px;">
                        <i class="fas fa-info-circle" style="margin-right: 5px;"></i> Teks Eksplanasi Lingkungan
                    </div>
                    <h3 style="color: #1b5e20; font-size: 2rem; margin-bottom: 25px; font-weight: 800;">Mengapa Kami
                        Memerangi Sampah?</h3>

                    <div style="margin-bottom: 20px; border-left: 4px solid #4caf50; padding-left: 20px;">
                        <h4 style="color: #2e7d32; font-size: 1.2rem; margin-bottom: 10px;">Pernyataan Umum</h4>
                        <p style="color: #555; line-height: 1.7; font-size: 1.05rem; margin: 0;">
                            Sampah di lingkungan sekolah terdiri dari limbah organik yang mudah terurai secara alami, serta
                            sampah anorganik dan plastik yang sulit didekomposisi oleh tanah. Perbedaan sifat ini menuntut
                            pengelolaan yang tepat agar tidak mengganggu keseimbangan ekosistem dan kesehatan di area
                            pendidikan.
                        </p>
                    </div>

                    <div style="margin-bottom: 20px; border-left: 4px solid #4caf50; padding-left: 20px;">
                        <h4 style="color: #2e7d32; font-size: 1.2rem; margin-bottom: 10px;">Deretan Penjelasan
                            (Sebab-Akibat)</h4>
                        <p style="color: #555; line-height: 1.7; font-size: 1.05rem; margin: 0;">
                            Sampah organik yang menumpuk tanpa pengelolaan dapat membusuk dan menimbulkan bau, sedangkan
                            sampah plastik serta anorganik yang tertimbun akan merusak struktur tanah dan menghambat resapan
                            air. Jika sampah-sampah ini dibakar, mereka akan melepaskan senyawa kimia beracun ke udara yang
                            sangat membahayakan sistem pernapasan warga sekolah serta memperburuk kualitas lingkungan.
                        </p>
                    </div>

                    <div
                        style="background: rgba(255, 255, 255, 0.6); padding: 20px; border-radius: 12px; margin-top: 30px; border: 1px solid rgba(255,255,255, 0.9);">
                        <h4 style="color: #1b5e20; font-size: 1.1rem; margin-bottom: 10px;"><i class="fas fa-check-circle"
                                style="color: #4caf50; margin-right: 8px;"></i> Interpretasi (Simpulan)</h4>
                        <p style="color: #444; line-height: 1.7; font-size: 1.05rem; margin: 0; font-weight: 500;">
                            Oleh karena itu, kebijakan pemilahan sampah dan pengurangan plastik di sekolah merupakan langkah
                            strategis yang sangat krusial. Upaya ini bukan sekadar mengikuti tren lingkungan, melainkan
                            tanggung jawab bersama untuk memastikan kesehatan dan keberlanjutan tempat belajar bagi generasi
                            mendatang.
                        </p>
                    </div>
                </div>
            </div>

            <div id="faq-tanya-jawab" class="faq-section"
                style="margin-top: 80px; padding: 60px 0; background: #fafdfb; border-radius: 30px;">
                <div style="text-align: center; margin-bottom: 50px; padding: 0 20px;">
                    <br>
                    <span class="faq-header-badge"><i class="fas fa-question-circle"></i> FAQ Lingkungan</span>
                    <h3 style="color: #173d25; font-size: 2.2rem; font-weight: 800; margin-bottom: 15px;">Tanya Jawab
                        Seputar Sekolah Hijau</h3>
                    <p style="color: #556b5d; font-size: 1.1rem; max-width: 600px; margin: 0 auto;">Temukan jawaban dari
                        pertanyaan yang paling sering diajukan terkait komitmen perlindungan lingkungan dan aksi
                        keberlanjutan di Go Green School.</p>
                </div>

                <div class="faq-modern-container">

                    <div class="faq-modern-item">
                        <div class="faq-question">
                            <span>Bagaimana cara siswa berpartisipasi dalam program Bank Sampah?</span>
                            <div class="faq-icon-wrapper"><i class="fas fa-chevron-down"></i></div>
                        </div>
                        <div class="faq-answer">
                            <div class="faq-answer-inner">
                                Setiap siswa terdaftar akan mendapatkan Buku Tabungan Bank Sampah. Setiap hari Jumat pada
                                jam istirahat, siswa dapat menyetorkan sampah anorganik terpilah (plastik bersih, kertas,
                                botol minuman) ke posko sekolah. Setiap 1 kg sampah memiliki nilai poin yang dapat
                                dikumpulkan dan ditukarkan dengan alat tulis atau bibit tanaman gratis.
                            </div>
                        </div>
                    </div>

                    <div class="faq-modern-item">
                        <div class="faq-question">
                            <span>Apakah ada aturan khusus terkait bekal atau jajan di area sekolah?</span>
                            <div class="faq-icon-wrapper"><i class="fas fa-chevron-down"></i></div>
                        </div>
                        <div class="faq-answer">
                            <div class="faq-answer-inner">
                                Betul. Go Green School menerapkan kawasan <strong>"Zero Single-Use Plastic"</strong>. Siswa
                                diwajibkan membawa tumbler dan kotak makanan (Tupperware) sendiri dari rumah. Kantin sekolah
                                kami tidak menyediakan kantong kresek, sedotan plastik, maupun kemasan stirofoam. Makanan
                                dibungkus menggunakan daun pisang atau kertas yang mudah terurai (biodegradable).
                            </div>
                        </div>
                    </div>

                    <div class="faq-modern-item">
                        <div class="faq-question">
                            <span>Apa saja kegiatan rutin Go Green School untuk pelestarian lingkungan?</span>
                            <div class="faq-icon-wrapper"><i class="fas fa-chevron-down"></i></div>
                        </div>
                        <div class="faq-answer">
                            <div class="faq-answer-inner">
                                Kami rutin mengadakan kegiatan seperti <strong>Kerja Bakti Ekologis (Clean-up Day)</strong>
                                di area sekitar sekolah setiap 2 bulan sekali, <strong>Jumat Bercocok Tanam
                                    (Replant)</strong>, pembuatan pupuk kompos dari limbah sampah daun sekolah, dan seminar
                                duta lingkungan yang mengundang aktivis pemuda peduli sampah dari daerah setempat.
                            </div>
                        </div>
                    </div>

                    <div class="faq-modern-item">
                        <div class="faq-question">
                            <span>Bagaimana pihak sekolah mengajarkan efisiensi energi dan air?</span>
                            <div class="faq-icon-wrapper"><i class="fas fa-chevron-down"></i></div>
                        </div>
                        <div class="faq-answer">
                            <div class="faq-answer-inner">
                                Sekolah kami membangun Instalasi Pemanenan Air Hujan (Rainwater Harvesting) untuk
                                dimanfaatkan menyiram kebun botani dan toilet sekolah. Untuk efisiensi energi, desain ruang
                                kelas kami memiliki jendela lebar yang memaksimalkan pencahayaan alami serta mematikan
                                pendingin ruangan (AC/Kipas) sebelum jam 09.00 pagi.
                            </div>
                        </div>
                    </div>

                    <div class="faq-modern-item">
                        <div class="faq-question">
                            <span>Apakah orang tua dapat ikut serta dalam program hijau ini?</span>
                            <div class="faq-icon-wrapper"><i class="fas fa-chevron-down"></i></div>
                        </div>
                        <div class="faq-answer">
                            <div class="faq-answer-inner">
                                Sangat dianjurkan! Kami memiliki kumpulan <strong>Komite Hijau Orang Tua</strong>. Orang tua
                                dapat berpartisipasi dengan menerapkan pedoman pemilahan sampah "Pilah dari Rumah",
                                memberikan donasi berupa bibit tanaman, hingga ikut serta sebagai relawan saat kegiatan
                                peringatan Hari Lingkungan Hidup Nasional bersama anak-anak.
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const faqItems = document.querySelectorAll('.faq-modern-item');

            faqItems.forEach(item => {
                const question = item.querySelector('.faq-question');

                question.addEventListener('click', () => {
                    const isActive = item.classList.contains('active');

                    // Menutup semua accordion
                    faqItems.forEach(faq => {
                        faq.classList.remove('active');
                        if (faq.querySelector('.faq-answer')) {
                            faq.querySelector('.faq-answer').style.maxHeight = null;
                        }
                    });

                    // Membuka yang sedang di-klik (jika sebelumnya tidak aktif)
                    if (!isActive) {
                        item.classList.add('active');
                        const answer = item.querySelector('.faq-answer');
                        answer.style.maxHeight = answer.scrollHeight + 'px';
                    }
                });
            });
        });
    </script>
@endpush

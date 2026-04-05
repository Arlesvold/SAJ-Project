@extends('layouts.app')

@section('title', 'Visi Misi - Go Green School')

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

            <div style="margin-top: 60px;">
                <h3 style="color: var(--dark); font-size: 1.8rem; margin-bottom: 30px; text-align: center;">Tanya Jawab
                    Seputar Lingkungan Sekolah (FAQ)</h3>
                <div style="max-width: 800px; margin: 0 auto; display: flex; flex-direction: column; gap: 15px;">

                    <div class="faq-card" style="border: 1px solid #eee; border-radius: 10px; padding: 20px;">
                        <h4 style="margin-bottom: 10px; color: var(--primary);">Apakah kantin benar-benar tidak menyediakan
                            plastik?</h4>
                        <p style="color: var(--gray); font-size: 0.95rem; margin:0;">Benar. Kami bekerja sama dengan vendor
                            kantin untuk hanya menggunakan piring/gelas kaca atau siswa membawa tumbler/kotak bekal sendiri.
                            Jajanan dibungkus menggunakan daun pisang atau kertas food-grade yang bio-degradable.</p>
                    </div>

                    <div class="faq-card" style="border: 1px solid #eee; border-radius: 10px; padding: 20px;">
                        <h4 style="margin-bottom: 10px; color: var(--primary);">Bagaimana sistem poin Bank Sampah bekerja?
                        </h4>
                        <p style="color: var(--gray); font-size: 0.95rem; margin:0;">Setiap 1 kg sampah anorganik terpilah
                            dihargai 10 poin. Poin tersebut tercatat di buku tabungan siswa dan jika mencapai 100 poin bisa
                            ditukarkan dengan alat tulis atau diskon buku di koperasi sekolah.</p>
                    </div>

                    <div class="faq-card" style="border: 1px solid #eee; border-radius: 10px; padding: 20px;">
                        <h4 style="margin-bottom: 10px; color: var(--primary);">Apakah orang tua dijinkan ikut serta?</h4>
                        <p style="color: var(--gray); font-size: 0.95rem; margin:0;">Tentu sangat dianjurkan! Kami memiliki
                            Komite Hijau Orang Tua yang pertemuannya diadakan sebulan sekali untuk menyukseskan
                            program-program kebun dan pemilahan sampah dari rumah.</p>
                    </div>

                </div>
            </div>

        </div>
    </section>
@endsection

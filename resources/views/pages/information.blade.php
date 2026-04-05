@extends('layouts.app')

@section('title', 'Visi Misi - Go Green School')

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
                    <i class="fas fa-leaf"></i>
                </div>
                <div class="page-hero-badge">
                    <i class="fas fa-circle"></i> Tentang Sekolah
                </div>
                <h1>Visi & Misi <span class="highlight">Hijau</span></h1>
                <div class="page-hero-decor-line"></div>
                <p class="page-hero-desc">
                    Komitmen kami membangun ekosistem pendidikan berkelanjutan yang berwawasan lingkungan untuk masa depan
                    bumi yang lebih baik.
                </p>
                <div class="page-hero-breadcrumb">
                    <a href="{{ route('home') }}"><i class="fas fa-home"></i> Beranda</a>
                    <span class="separator"><i class="fas fa-chevron-right"></i></span>
                    <span class="current">Visi Misi</span>
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

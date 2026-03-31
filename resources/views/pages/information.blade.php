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

            <div style="text-align: center; margin-bottom: 50px;">
                <h2 style="color: var(--dark); font-size: 2.2rem; margin-bottom: 15px;">Visi Hijau Kami</h2>
                <div style="width: 80px; height: 4px; background: var(--primary); margin: 0 auto 30px; border-radius: 2px;">
                </div>
                <p
                    style="color: var(--gray); font-size: 1.2rem; max-width: 800px; margin: 0 auto; line-height: 1.8; padding: 30px; background: #f9fcfa; border-left: 5px solid var(--primary); border-radius: 10px; box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
                    "Menciptakan ekosistem pendidikan yang harmonis dengan alam, mencetak pemimpin masa depan yang proaktif,
                    peduli, dan bertanggung jawab terhadap lingkungan sekitarnya."
                </p>
            </div>

            <div style="margin-bottom: 70px;">
                <h3 style="color: var(--dark); font-size: 1.8rem; margin-bottom: 30px; text-align: center;">Misi Sekolah
                    Hijau</h3>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 30px;">

                    <div style="background: white; padding: 30px; border-radius: 15px; border: 1px solid #eee; text-align: center; transition: transform 0.3s ease, box-shadow 0.3s ease; box-shadow: 0 5px 15px rgba(0,0,0,0.03);"
                        onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 15px 30px rgba(0,0,0,0.08)'"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 5px 15px rgba(0,0,0,0.03)'">
                        <div
                            style="width: 70px; height: 70px; background: #e8f5e9; color: #2e7d32; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.8rem; margin: 0 auto 20px;">
                            <i class="fas fa-book-open"></i>
                        </div>
                        <h4 style="font-size: 1.2rem; color: var(--dark); margin-bottom: 15px;">Edukasi Berkelanjutan</h4>
                        <p style="color: var(--gray); font-size: 0.95rem; line-height: 1.6;">Mengintegrasikan pendidikan
                            lingkungan hidup ke dalam kurikulum dan kegiatan ekstrakurikuler siswa secara aktif.</p>
                    </div>

                    <div style="background: white; padding: 30px; border-radius: 15px; border: 1px solid #eee; text-align: center; transition: transform 0.3s ease, box-shadow 0.3s ease; box-shadow: 0 5px 15px rgba(0,0,0,0.03);"
                        onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 15px 30px rgba(0,0,0,0.08)'"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 5px 15px rgba(0,0,0,0.03)'">
                        <div
                            style="width: 70px; height: 70px; background: #e3f2fd; color: #1565c0; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.8rem; margin: 0 auto 20px;">
                            <i class="fas fa-recycle"></i>
                        </div>
                        <h4 style="font-size: 1.2rem; color: var(--dark); margin-bottom: 15px;">Budaya Peduli Sampah</h4>
                        <p style="color: var(--gray); font-size: 0.95rem; line-height: 1.6;">Membudayakan pengelolaan sampah
                            melalui prinsip 3R (Reduce, Reuse, Recycle) dan bank sampah sekolah.</p>
                    </div>

                    <div style="background: white; padding: 30px; border-radius: 15px; border: 1px solid #eee; text-align: center; transition: transform 0.3s ease, box-shadow 0.3s ease; box-shadow: 0 5px 15px rgba(0,0,0,0.03);"
                        onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 15px 30px rgba(0,0,0,0.08)'"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 5px 15px rgba(0,0,0,0.03)'">
                        <div
                            style="width: 70px; height: 70px; background: #fff8e1; color: #f57f17; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.8rem; margin: 0 auto 20px;">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <h4 style="font-size: 1.2rem; color: var(--dark); margin-bottom: 15px;">Efisiensi Sumber Daya</h4>
                        <p style="color: var(--gray); font-size: 0.95rem; line-height: 1.6;">Melaksanakan penghematan
                            energi, air, dan sumber daya lainnya dalam setiap aspek operasional sekolah.</p>
                    </div>

                    <div style="background: white; padding: 30px; border-radius: 15px; border: 1px solid #eee; text-align: center; transition: transform 0.3s ease, box-shadow 0.3s ease; box-shadow: 0 5px 15px rgba(0,0,0,0.03);"
                        onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 15px 30px rgba(0,0,0,0.08)'"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 5px 15px rgba(0,0,0,0.03)'">
                        <div
                            style="width: 70px; height: 70px; background: #fbe9e7; color: #d84315; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.8rem; margin: 0 auto 20px;">
                            <i class="fas fa-hands-helping"></i>
                        </div>
                        <h4 style="font-size: 1.2rem; color: var(--dark); margin-bottom: 15px;">Sinergi Komunitas</h4>
                        <p style="color: var(--gray); font-size: 0.95rem; line-height: 1.6;">Menjalin kemitraan dengan orang
                            tua, masyarakat lokal, dan instansi terkait untuk pelestarian lingkungan.</p>
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

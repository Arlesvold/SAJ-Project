@extends('layouts.app')

@section('title', 'Informasi - Go Green School')

@section('content')
    <section class="hero" style="min-height: 350px; padding: 100px 0 60px; margin-top: 60px;">
        <canvas class="leaves-canvas" id="leavesCanvas"></canvas>
        <div class="hero-bg-shapes">
            <div class="shape"></div>
            <div class="shape"></div>
            <div class="shape"></div>
        </div>
        <div class="hero-content" style="position: relative; z-index: 2;">
            <div class="container" style="text-align: center; display: flex; flex-direction: column; align-items: center;">
                <h1 style="font-size: 2.8rem; margin-bottom: 20px; color: white; font-weight: 800; text-align: center;">
                    Pusat Informasi & Laporan</h1>
                <p
                    style="font-size: 1.1rem; opacity: 0.9; max-width: 600px; line-height: 1.6; color: rgba(255,255,255,0.85); text-align: center;">
                    Transparansi adalah kunci. Telusuri infografis, laporan status lingkungan sekolah, dan unduhan dokumen
                    standar lingkungan kami.</p>
            </div>
        </div>
    </section>

    <section class="info-section" style="padding: 60px 0; background: #fff;">
        <div class="container">

            <div style="text-align: center; margin-bottom: 50px;">
                <h2 style="color: var(--dark); font-size: 2rem; margin-bottom: 15px;">Dashboard Lingkungan Terkini</h2>
                <p style="color: var(--gray); max-width: 600px; margin: 0 auto;">Pembaruan data indikator kualitas udara,
                    penghematan energi, dan efisiensi air di area sekolah bulan ini.</p>
            </div>

            <div
                style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 30px; margin-bottom: 60px;">
                <div
                    style="background: #f9fcfa; padding: 30px; border-radius: 15px; border-top: 4px solid var(--primary); text-align: center; box-shadow: 0 5px 20px rgba(0,0,0,0.03);">
                    <div style="font-size: 3rem; color: var(--primary); margin-bottom: 15px;"><i class="fas fa-wind"></i>
                    </div>
                    <h3 style="font-size: 1.2rem; color: var(--dark); margin-bottom: 10px;">Kualitas Udara (AQI)</h3>
                    <div style="font-size: 2.5rem; font-weight: 700; color: #2ecc71; margin-bottom: 10px;">42</div>
                    <p style="color: var(--gray); font-size: 0.9rem;">Status: <strong>Sangat Baik</strong> (Optimal untuk
                        kegiatan luar ruangan anak-anak)</p>
                </div>

                <div
                    style="background: #f9fcfa; padding: 30px; border-radius: 15px; border-top: 4px solid var(--accent); text-align: center; box-shadow: 0 5px 20px rgba(0,0,0,0.03);">
                    <div style="font-size: 3rem; color: var(--accent); margin-bottom: 15px;"><i class="fas fa-bolt"></i>
                    </div>
                    <h3 style="font-size: 1.2rem; color: var(--dark); margin-bottom: 10px;">Penghematan Listrik</h3>
                    <div style="font-size: 2.5rem; font-weight: 700; color: #f39c12; margin-bottom: 10px;">25%</div>
                    <p style="color: var(--gray); font-size: 0.9rem;">Status: <strong>Target Tercapai</strong> (Dibanding
                        penggunaan bulan lalu)</p>
                </div>

                <div
                    style="background: #f9fcfa; padding: 30px; border-radius: 15px; border-top: 4px solid #3498db; text-align: center; box-shadow: 0 5px 20px rgba(0,0,0,0.03);">
                    <div style="font-size: 3rem; color: #3498db; margin-bottom: 15px;"><i class="fas fa-recycle"></i></div>
                    <h3 style="font-size: 1.2rem; color: var(--dark); margin-bottom: 10px;">Daur Ulang Sampah</h3>
                    <div style="font-size: 2.5rem; font-weight: 700; color: #3498db; margin-bottom: 10px;">420 <span
                            style="font-size: 1rem;">Kg</span></div>
                    <p style="color: var(--gray); font-size: 0.9rem;">Total sampah plastik & kertas terselamatkan bulan ini
                        via Bank Sampah.</p>
                </div>
            </div>

            <div
                style="background: #f4f6f5; padding: 40px; border-radius: 15px; display: flex; flex-wrap: wrap; gap: 30px; align-items: center; justify-content: space-between;">
                <div style="flex: 1 1 300px;">
                    <h3 style="color: var(--dark); font-size: 1.5rem; margin-bottom: 15px;">Laporan Tahunan Lingkungan
                        Sekolah</h3>
                    <p style="color: var(--gray); line-height: 1.6; margin-bottom: 0;">Unduh dokumen resmi komprehensif kami
                        mengenai capaian, audit keberlanjutan, serta progres program Adiwiyata tahun 2025.</p>
                </div>
                <div>
                    <a href="#" class="btn-primary"
                        style="display: inline-flex; align-items: center; gap: 10px; padding: 12px 25px;"><i
                            class="fas fa-file-pdf" style="font-size: 1.2rem;"></i> Unduh Laporan PDF (4.2 MB)</a>
                </div>
            </div>

            <div style="margin-top: 60px;">
                <h3 style="color: var(--dark); font-size: 1.8rem; margin-bottom: 30px; text-align: center;">Tanya Jawab
                    Seputar Lingkungan Sekolah (FAQ)</h3>
                <div style="max-width: 800px; margin: 0 auto; display: flex; flex-direction: column; gap: 15px;">

                    <div style="border: 1px solid #eee; border-radius: 10px; padding: 20px;">
                        <h4 style="margin-bottom: 10px; color: var(--primary);">Apakah kantin benar-benar tidak menyediakan
                            plastik?</h4>
                        <p style="color: var(--gray); font-size: 0.95rem; margin:0;">Benar. Kami bekerja sama dengan vendor
                            kantin untuk hanya menggunakan piring/gelas kaca atau siswa membawa tumbler/kotak bekal sendiri.
                            Jajanan dibungkus menggunakan daun pisang atau kertas food-grade yang bio-degradable.</p>
                    </div>

                    <div style="border: 1px solid #eee; border-radius: 10px; padding: 20px;">
                        <h4 style="margin-bottom: 10px; color: var(--primary);">Bagaimana sistem poin Bank Sampah bekerja?
                        </h4>
                        <p style="color: var(--gray); font-size: 0.95rem; margin:0;">Setiap 1 kg sampah anorganik terpilah
                            dihargai 10 poin. Poin tersebut tercatat di buku tabungan siswa dan jika mencapai 100 poin bisa
                            ditukarkan dengan alat tulis atau diskon buku di koperasi sekolah.</p>
                    </div>

                    <div style="border: 1px solid #eee; border-radius: 10px; padding: 20px;">
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

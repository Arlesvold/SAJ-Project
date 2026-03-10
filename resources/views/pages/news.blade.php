@extends('layouts.app')

@section('title', 'Berita & Artikel - Go Green School')

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
                    Berita & Artikel Lingkungan</h1>
                <p
                    style="font-size: 1.1rem; opacity: 0.9; max-width: 600px; line-height: 1.6; color: rgba(255,255,255,0.85); text-align: center;">
                    Dapatkan pembaruan terbaru seputar kegiatan, prestasi, serta artikel edukatif mengenai pelestarian
                    lingkungan di sekolah kami.</p>
            </div>
        </div>
    </section>

    <section class="news-page-section" style="padding: 60px 0; background: #f9fcfa;">
        <div class="container">

            <div class="row" style="display: flex; flex-wrap: wrap; gap: 40px;">

                {{-- Main Column --}}
                <div class="main-column" style="flex: 1 1 65%;">

                    {{-- Featured Big News --}}
                    <div class="news-card big-news"
                        style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.05); margin-bottom: 40px; transition: transform 0.3s;">
                        <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80"
                            alt="Penghargaan" style="width: 100%; height: 350px; object-fit: cover;">
                        <div style="padding: 30px;">
                            <div
                                style="display:flex; gap:15px; margin-bottom: 15px; font-size: 0.9rem; color: var(--gray);">
                                <span><i class="far fa-calendar text-primary"></i> 10 Maret 2026</span>
                                <span><i class="far fa-user text-primary"></i> Admin GGS</span>
                                <span
                                    style="background:var(--accent); color:white; padding: 2px 10px; border-radius:10px; font-size:0.8rem;">Prestasi</span>
                            </div>
                            <h2 style="margin-bottom: 15px; font-size: 1.8rem; color: var(--dark);">Sekolah Kami Meraih
                                Penghargaan Adiwiyata Tingkat Nasional 2026</h2>
                            <p style="color: var(--gray); line-height: 1.7; margin-bottom: 25px;">Penghargaan prestisius ini
                                diraih berkat konsistensi seluruh warga sekolah dalam menerapkan gaya hidup ramah lingkungan
                                dan pengelolaan sampah terpadu yang telah berjalan selama 5 tahun terakhir...</p>
                            <a href="#" class="btn-primary" style="padding: 8px 20px;">Baca Selengkapnya</a>
                        </div>
                    </div>

                    {{-- Other News Grid --}}
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px;">

                        @php
                            $articles = [
                                [
                                    'img' =>
                                        'https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                                    'title' => 'Gerakan 1000 Botol Plastik Disulap Menjadi Kursi Ecobrick',
                                    'date' => '05 Maret 2026',
                                ],
                                [
                                    'img' =>
                                        'https://images.unsplash.com/photo-1497435334941-8c899ee9e8e9?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                                    'title' => 'Edukasi: Keajaiban Eco-Enzyme bagi Tanah Tanam',
                                    'date' => '28 Feb 2026',
                                ],
                                [
                                    'img' =>
                                        'https://images.unsplash.com/photo-1518531933037-91b2f5f229cc?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                                    'title' => 'Siswa Kelas X Kreasikan Sampah Kertas Menjadi Kesenian',
                                    'date' => '20 Feb 2026',
                                ],
                                [
                                    'img' =>
                                        'https://images.unsplash.com/photo-1466692476868-aef1dfb1e735?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                                    'title' => 'Panen Perdana Kebun Hidroponik Kantin Sekolah',
                                    'date' => '15 Feb 2026',
                                ],
                            ];
                        @endphp

                        @foreach ($articles as $a)
                            <div class="news-card"
                                style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 5px 20px rgba(0,0,0,0.03);">
                                <img src="{{ $a['img'] }}" alt="Berita"
                                    style="width:100%; height: 200px; object-fit: cover;">
                                <div style="padding: 20px;">
                                    <span
                                        style="color: var(--gray); font-size: 0.85rem; display: block; margin-bottom: 10px;"><i
                                            class="far fa-clock"></i> {{ $a['date'] }}</span>
                                    <h3
                                        style="font-size: 1.2rem; margin-bottom: 15px; color: var(--dark); line-height: 1.4;">
                                        {{ $a['title'] }}</h3>
                                    <a href="#"
                                        style="color: var(--primary); font-weight: 600; text-decoration: none;">Baca
                                        Selengkapnya &rarr;</a>
                                </div>
                            </div>
                        @endforeach

                    </div>

                    {{-- Pagination --}}
                    <div style="margin-top: 50px; display: flex; justify-content: center; gap: 10px;">
                        <button
                            style="width: 40px; height: 40px; border-radius: 50%; border: 1px solid var(--primary); background: var(--primary); color: white;">1</button>
                        <button
                            style="width: 40px; height: 40px; border-radius: 50%; border: 1px solid #ddd; background: white; color: var(--dark);">2</button>
                        <button
                            style="width: 40px; height: 40px; border-radius: 50%; border: 1px solid #ddd; background: white; color: var(--dark);">3</button>
                        <button
                            style="width: 40px; height: 40px; border-radius: 50%; border: 1px solid #ddd; background: white; color: var(--dark);"><i
                                class="fas fa-chevron-right"></i></button>
                    </div>

                </div>

                {{-- Sidebar --}}
                <div class="sidebar-column" style="flex: 1 1 30%; max-width: 350px;">

                    {{-- Search --}}
                    <div
                        style="background: white; padding: 25px; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.03); margin-bottom: 30px;">
                        <h4 style="margin-bottom: 15px; border-left: 3px solid var(--primary); padding-left: 10px;">Cari
                            Berita</h4>
                        <div style="display:flex;">
                            <input type="text" placeholder="Kata kunci..."
                                style="width: 100%; padding: 10px 15px; border: 1px solid #ddd; border-radius: 5px 0 0 5px; outline:none;">
                            <button
                                style="background: var(--primary); color: white; border: none; padding: 0 15px; border-radius: 0 5px 5px 0; cursor:pointer;"><i
                                    class="fas fa-search"></i></button>
                        </div>
                    </div>

                    {{-- Categories --}}
                    <div
                        style="background: white; padding: 25px; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.03); margin-bottom: 30px;">
                        <h4 style="margin-bottom: 15px; border-left: 3px solid var(--primary); padding-left: 10px;">Kategori
                            Berita</h4>
                        <ul style="list-style: none; padding: 0; margin: 0;">
                            <li style="padding: 10px 0; border-bottom: 1px dashed #eee;"><a href="#"
                                    style="color: var(--gray); text-decoration: none; display: flex; justify-content: space-between;"><span>Prestasi</span>
                                    <span
                                        style="background: #f4f4f4; padding: 2px 8px; border-radius: 10px; font-size: 0.8rem;">12</span></a>
                            </li>
                            <li style="padding: 10px 0; border-bottom: 1px dashed #eee;"><a href="#"
                                    style="color: var(--gray); text-decoration: none; display: flex; justify-content: space-between;"><span>Edukasi</span>
                                    <span
                                        style="background: #f4f4f4; padding: 2px 8px; border-radius: 10px; font-size: 0.8rem;">24</span></a>
                            </li>
                            <li style="padding: 10px 0; border-bottom: 1px dashed #eee;"><a href="#"
                                    style="color: var(--primary); font-weight:600; text-decoration: none; display: flex; justify-content: space-between;"><span>Program
                                        Hijau</span> <span
                                        style="background: var(--primary); color:white; padding: 2px 8px; border-radius: 10px; font-size: 0.8rem;">38</span></a>
                            </li>
                            <li style="padding: 10px 0; border-bottom: 1px dashed #eee;"><a href="#"
                                    style="color: var(--gray); text-decoration: none; display: flex; justify-content: space-between;"><span>Pengumuman</span>
                                    <span
                                        style="background: #f4f4f4; padding: 2px 8px; border-radius: 10px; font-size: 0.8rem;">8</span></a>
                            </li>
                        </ul>
                    </div>

                    {{-- Popular Tags --}}
                    <div
                        style="background: white; padding: 25px; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.03);">
                        <h4 style="margin-bottom: 15px; border-left: 3px solid var(--primary); padding-left: 10px;">Tag
                            Populer</h4>
                        <div style="display: flex; flex-wrap: wrap; gap: 8px;">
                            <span
                                style="background: #f4f4f4; padding: 5px 12px; border-radius: 20px; font-size: 0.85rem; color: var(--gray); cursor: pointer;">#Adiwiyata</span>
                            <span
                                style="background: #f4f4f4; padding: 5px 12px; border-radius: 20px; font-size: 0.85rem; color: var(--gray); cursor: pointer;">#GoGreen</span>
                            <span
                                style="background: #f4f4f4; padding: 5px 12px; border-radius: 20px; font-size: 0.85rem; color: var(--gray); cursor: pointer;">#DaurUlang</span>
                            <span
                                style="background: #f4f4f4; padding: 5px 12px; border-radius: 20px; font-size: 0.85rem; color: var(--gray); cursor: pointer;">#BebasPlastik</span>
                            <span
                                style="background: #f4f4f4; padding: 5px 12px; border-radius: 20px; font-size: 0.85rem; color: var(--gray); cursor: pointer;">#Ecobrick</span>
                            <span
                                style="background: #f4f4f4; padding: 5px 12px; border-radius: 20px; font-size: 0.85rem; color: var(--gray); cursor: pointer;">#Hidroponik</span>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </section>
@endsection

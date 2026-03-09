{{-- Gallery Section --}}
<section class="gallery-section" id="gallery">
    <div class="container">
        <div class="section-title">
            <div>
                <h2>Galeri Kegiatan</h2>
                <p>Dokumentasi kegiatan lingkungan di sekolah</p>
            </div>
            <a href="#" class="see-all">Lihat Semua <i class="fas fa-arrow-right"></i></a>
        </div>

        <div class="gallery-grid">
            @foreach($gallery as $item)
            <div class="gallery-item fade-in">
                <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" loading="lazy">
                <div class="overlay">
                    <h4>{{ $item['title'] }}</h4>
                    <span>{{ $item['date'] }}</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

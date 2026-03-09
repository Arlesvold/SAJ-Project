{{-- News Section --}}
<section class="news-section" id="news">
    <div class="container">
        <div class="section-title">
            <div>
                <h2>Berita Terbaru</h2>
                <p>Berita dan kegiatan terkini dari Go Green School</p>
            </div>
            <a href="#" class="see-all">Lihat Semua <i class="fas fa-arrow-right"></i></a>
        </div>

        <div class="news-tabs">
            <button class="tab active">Berita Utama</button>
            <button class="tab">Kegiatan</button>
            <button class="tab">Prestasi</button>
        </div>

        <div class="news-layout">
            {{-- Featured News --}}
            <div class="news-featured fade-in">
                <img src="{{ $news['featured']['image'] }}" alt="{{ $news['featured']['title'] }}" loading="lazy">
                <div class="content">
                    <div class="date"><i class="far fa-calendar"></i> {{ $news['featured']['date'] }}</div>
                    <h3>{{ $news['featured']['title'] }}</h3>
                    <p>{{ $news['featured']['desc'] }}</p>
                </div>
            </div>

            {{-- News List --}}
            <div class="news-list">
                @foreach($news['items'] as $item)
                <a href="#" class="news-item fade-in">
                    <div class="news-item-img">
                        <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" loading="lazy">
                    </div>
                    <div class="news-item-body">
                        <div class="date">{{ $item['date'] }}</div>
                        <h4>{{ $item['title'] }}</h4>
                        <p>{{ $item['desc'] }}</p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</section>

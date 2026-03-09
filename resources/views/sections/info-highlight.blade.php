{{-- Info Highlight Section --}}
<section class="info-highlight">
    <div class="container">
        <div class="section-title">
            <div>
                <h2>Status Lingkungan Sekolah</h2>
                <p>Monitoring kondisi lingkungan terkini</p>
            </div>
            <a href="#" class="see-all">Detail Lengkap <i class="fas fa-arrow-right"></i></a>
        </div>

        <div class="info-highlight-grid">
            {{-- Main Card --}}
            <div class="info-main-card fade-in">
                <div class="label"><i class="fas fa-chart-bar"></i>&ensp;Indeks Lingkungan Sekolah</div>
                <h3>Kualitas Lingkungan Sekolah Dalam Kondisi Sangat Baik</h3>
                <p>{{ $envStatus['main']['desc'] }}</p>
                <div class="info-stats-row">
                    <div class="info-stat-item">
                        <div class="val">{{ $envStatus['main']['score'] }}</div>
                        <div class="lbl">Skor Lingkungan</div>
                    </div>
                    <div class="info-stat-item">
                        <div class="val">{{ $envStatus['main']['grade'] }}</div>
                        <div class="lbl">Grade Kebersihan</div>
                    </div>
                    <div class="info-stat-item">
                        <div class="val">{{ $envStatus['main']['airQuality'] }}</div>
                        <div class="lbl">Kualitas Udara</div>
                    </div>
                </div>
                <a href="#" class="btn-primary" style="font-size:13px; padding:10px 22px;">
                    <i class="fas fa-file-pdf"></i> Unduh Laporan Lengkap
                </a>
            </div>

            {{-- Side Cards --}}
            <div class="info-side-cards fade-in">
                @foreach($envStatus['cards'] as $card)
                <div class="info-side-card">
                    <div class="icon-box" style="background:{{ $card['iconBg'] }}; color:{{ $card['iconColor'] }};">
                        <i class="{{ $card['icon'] }}"></i>
                    </div>
                    <div>
                        <h4>{{ $card['title'] }}</h4>
                        <p>{{ $card['desc'] }}</p>
                        <span class="badge {{ $card['badgeClass'] }}">{{ $card['badge'] }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

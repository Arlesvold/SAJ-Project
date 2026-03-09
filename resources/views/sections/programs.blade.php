{{-- Programs Section --}}
<section class="programs-section" id="programs">
    <div class="container">
        <div class="section-title">
            <div>
                <h2>Program Unggulan</h2>
                <p>Program lingkungan yang dijalankan di sekolah kami</p>
            </div>
            <a href="#" class="see-all">Lihat Semua <i class="fas fa-arrow-right"></i></a>
        </div>

        <div class="programs-tabs">
            <button class="tab active">Semua</button>
            <button class="tab">Penghijauan</button>
            <button class="tab">Energi</button>
            <button class="tab">Daur Ulang</button>
            <button class="tab">Edukasi</button>
        </div>

        <div class="programs-grid">
            @foreach($programs as $program)
            <div class="program-card fade-in" data-category="{{ $program['category'] }}">
                <div class="program-card-img" style="background-image: url('{{ $program['image'] }}')">
                    <span class="tag">{{ $program['tag'] }}</span>
                </div>
                <div class="program-card-body">
                    <h3>{{ $program['title'] }}</h3>
                    <p>{{ $program['desc'] }}</p>
                    <div class="program-card-footer">
                        <span class="date"><i class="far fa-calendar"></i> {{ $program['date'] }}</span>
                        <a href="#" class="read-more">Selengkapnya <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Quick Access Section --}}
<section class="quick-access" id="access">
    <div class="container">
        <div class="section-title">
            <div>
                <h2>Akses Informasi</h2>
                <p>Akses cepat ke berbagai layanan dan informasi</p>
            </div>
        </div>

        <div class="quick-grid">
            @foreach($quickAccess as $item)
            <a href="#" class="quick-item fade-in">
                <div class="icon" style="background: {{ $item['gradient'] }};">
                    <i class="{{ $item['icon'] }}"></i>
                </div>
                <h4>{{ $item['title'] }}</h4>
                <p>{{ $item['desc'] }}</p>
            </a>
            @endforeach
        </div>
    </div>
</section>

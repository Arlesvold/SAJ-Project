{{-- Partners Section --}}
<section class="partners-section">
    <div class="container">
        <h3>Didukung Oleh</h3>
        <div class="partners-logos">
            @foreach($partners as $partner)
            <div class="partner-logo">
                <span class="tooltip-custom">{{ $partner['name'] }}</span>
                <i class="{{ $partner['icon'] }}"></i>
            </div>
            @endforeach
        </div>
    </div>
</section>

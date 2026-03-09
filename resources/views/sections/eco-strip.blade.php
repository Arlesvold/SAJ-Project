{{-- Eco Stats Strip --}}
<section class="eco-strip">
    <div class="container">
        @foreach($ecoStats as $stat)
        <div class="eco-strip-item">
            <div class="eco-strip-icon {{ $stat['color'] }}"><i class="{{ $stat['icon'] }}"></i></div>
            <div class="eco-strip-info">
                <h4>{{ $stat['value'] }}</h4>
                <span>{{ $stat['label'] }}</span>
            </div>
        </div>
        @endforeach
    </div>
</section>

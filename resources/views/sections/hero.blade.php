{{-- Hero Section --}}
<section class="hero">
    <canvas class="leaves-canvas" id="leavesCanvas"></canvas>
    <div class="hero-bg-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <div class="hero-slider">
        @foreach($slides as $index => $slide)
        <div class="hero-slide {{ $index === 0 ? 'active' : '' }}">
            <div class="hero-content">
                <div class="container">
                    <div class="hero-left">
                        <div class="hero-badge">
                            <i class="{{ $slide['badge']['icon'] }}"></i>&nbsp; {{ $slide['badge']['text'] }}
                        </div>
                        <h2>{{ $slide['title'] }} <span>{{ $slide['accent'] }}</span></h2>
                        <p>{{ $slide['desc'] }}</p>
                        <div class="hero-buttons">
                            @foreach($slide['buttons'] as $btn)
                            <a href="{{ $btn['href'] }}" class="{{ $btn['class'] }}">
                                <i class="{{ $btn['icon'] }}"></i> {{ $btn['text'] }}
                            </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="hero-right">
                        <div class="hero-card">
                            <h3><i class="{{ $slide['card']['icon'] }}"></i> {{ $slide['card']['title'] }}</h3>
                            @foreach($slide['card']['stats'] as $stat)
                            <div class="eco-stat">
                                <div class="eco-stat-icon" style="background:{{ $stat['color'] }}">
                                    <i class="{{ $stat['icon'] }}"></i>
                                </div>
                                <div class="eco-stat-info">
                                    <h4>{{ $stat['value'] }}</h4>
                                    <span>{{ $stat['label'] }}</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Hero Dots --}}
    <div class="hero-dots">
        @foreach($slides as $index => $slide)
        <div class="hero-dot {{ $index === 0 ? 'active' : '' }}" data-slide="{{ $index }}"></div>
        @endforeach
    </div>
    <div class="swipe-hint"><i class="fas fa-hand-point-up"></i> Geser untuk slide berikutnya</div>
</section>

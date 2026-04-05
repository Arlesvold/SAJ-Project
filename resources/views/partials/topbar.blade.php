{{-- Top Bar --}}
<div class="top-bar">
    <div class="container">
        <div class="date-info">
            <i class="far fa-calendar-alt"></i>
            <span id="currentDate">{{ now()->locale('id')->translatedFormat('l, j F Y') }}</span>
            <span class="live-clock" id="liveClock"><i class="far fa-clock"></i> --:--:--</span>
        </div>
        <div class="quick-links">
            <a href="{{ route('contact') }}#contact"><i class="fas fa-phone-alt"></i> Hubungi Kami</a>
            <a href="{{ route('information') }}#faq-tanya-jawab"><i class="fas fa-question-circle"></i> FAQ</a>
        </div>
    </div>
</div>

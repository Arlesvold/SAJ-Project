@extends('layouts.app')

@section('title', 'Kalkulator Sampah Kelas - Go Green School')

@push('styles')
<style>
    /* ===== Waste Calculator Page Styles ===== */
    .calc-section {
        padding: 60px 0 80px;
        background: linear-gradient(135deg, #f0f7f0 0%, #e8f5e9 100%);
        min-height: calc(100vh - 200px);
    }

    .calc-wrapper {
        max-width: 900px;
        margin: 0 auto;
    }

    .calc-card {
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 15px 40px rgba(26, 92, 42, 0.1);
        overflow: hidden;
    }

    .calc-card-header {
        background: linear-gradient(135deg, #1a5c2a 0%, #2e7d32 50%, #43a047 100%);
        padding: 35px 40px;
        text-align: center;
        color: #fff;
        position: relative;
        overflow: hidden;
    }

    .calc-card-header::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.08) 0%, transparent 60%);
        pointer-events: none;
    }

    .calc-card-header i {
        font-size: 2.5rem;
        margin-bottom: 12px;
        display: block;
        opacity: 0.9;
    }

    .calc-card-header h2 {
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .calc-card-header p {
        font-size: 0.95rem;
        opacity: 0.85;
    }

    .calc-card-body {
        padding: 40px;
    }

    /* Form Grid */
    .calc-form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-bottom: 30px;
    }

    .calc-form-grid .form-group.full-width {
        grid-column: 1 / -1;
    }

    .form-group label {
        display: block;
        font-size: 0.9rem;
        font-weight: 600;
        color: #2e7d32;
        margin-bottom: 8px;
    }

    .form-group label i {
        margin-right: 6px;
        width: 16px;
        text-align: center;
    }

    .form-group input {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        font-size: 1rem;
        font-family: 'Poppins', sans-serif;
        color: #333;
        transition: border-color 0.3s, box-shadow 0.3s;
        background: #fafffe;
    }

    .form-group input:focus {
        outline: none;
        border-color: #43a047;
        box-shadow: 0 0 0 3px rgba(67, 160, 71, 0.15);
    }

    .form-group input::placeholder {
        color: #aaa;
    }

    /* Input type number spinner styling */
    .form-group input[type="number"]::-webkit-inner-spin-button,
    .form-group input[type="number"]::-webkit-outer-spin-button {
        opacity: 1;
    }

    /* Waste type inputs with icon indicators */
    .waste-inputs {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        margin-bottom: 30px;
    }

    .waste-input-card {
        background: #f9fcfa;
        border: 2px solid #e8f5e9;
        border-radius: 12px;
        padding: 20px 16px;
        text-align: center;
        transition: border-color 0.3s, box-shadow 0.3s;
    }

    .waste-input-card:hover {
        border-color: #a5d6a7;
    }

    .waste-input-card .waste-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 12px;
        font-size: 1.3rem;
        color: #fff;
    }

    .waste-input-card.organik .waste-icon {
        background: linear-gradient(135deg, #4caf50, #66bb6a);
    }

    .waste-input-card.anorganik .waste-icon {
        background: linear-gradient(135deg, #ff9800, #ffa726);
    }

    .waste-input-card.plastik .waste-icon {
        background: linear-gradient(135deg, #f44336, #ef5350);
    }

    .waste-input-card label {
        display: block;
        font-size: 0.85rem;
        font-weight: 600;
        color: #555;
        margin-bottom: 10px;
    }

    .waste-input-card input {
        width: 100%;
        padding: 10px 12px;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        font-size: 1rem;
        font-family: 'Poppins', sans-serif;
        text-align: center;
        color: #333;
        transition: border-color 0.3s, box-shadow 0.3s;
        background: #fff;
    }

    .waste-input-card input:focus {
        outline: none;
        border-color: #43a047;
        box-shadow: 0 0 0 3px rgba(67, 160, 71, 0.15);
    }

    /* Calculate Button */
    .btn-calculate {
        display: block;
        width: 100%;
        padding: 15px;
        background: linear-gradient(135deg, #1a5c2a, #2e7d32);
        color: #fff;
        border: none;
        border-radius: 12px;
        font-size: 1.1rem;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
        cursor: pointer;
        transition: transform 0.2s, box-shadow 0.3s;
        box-shadow: 0 4px 15px rgba(26, 92, 42, 0.3);
    }

    .btn-calculate:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(26, 92, 42, 0.4);
    }

    .btn-calculate:active {
        transform: translateY(0);
    }

    .btn-calculate i {
        margin-right: 8px;
    }

    /* Results Area */
    .calc-results {
        display: none;
        margin-top: 35px;
        animation: fadeInUp 0.5s ease;
    }

    .calc-results.visible {
        display: block;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .results-title {
        text-align: center;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 2px solid #e8f5e9;
    }

    .results-title h3 {
        font-size: 1.3rem;
        color: #1a5c2a;
        font-weight: 700;
    }

    .results-title span {
        font-size: 0.9rem;
        color: #777;
    }

    .results-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
    }

    .result-item {
        background: linear-gradient(135deg, #f1f8e9, #e8f5e9);
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        border: 1px solid #c8e6c9;
        transition: transform 0.3s;
    }

    .result-item:hover {
        transform: translateY(-3px);
    }

    .result-item .result-icon {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background: linear-gradient(135deg, #1a5c2a, #2e7d32);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 10px;
        font-size: 1.1rem;
    }

    .result-item.organik .result-icon {
        background: linear-gradient(135deg, #4caf50, #66bb6a);
    }

    .result-item.anorganik .result-icon {
        background: linear-gradient(135deg, #ff9800, #ffa726);
    }

    .result-item.plastik .result-icon {
        background: linear-gradient(135deg, #f44336, #ef5350);
    }

    .result-item.prediksi .result-icon {
        background: linear-gradient(135deg, #1565c0, #42a5f5);
    }

    .result-item .result-label {
        font-size: 0.8rem;
        color: #777;
        font-weight: 500;
        margin-bottom: 4px;
    }

    .result-item .result-value {
        font-size: 1.4rem;
        font-weight: 700;
        color: #1a5c2a;
    }

    .result-item .result-unit {
        font-size: 0.8rem;
        color: #999;
        font-weight: 400;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .calc-card-body {
            padding: 25px 20px;
        }

        .calc-card-header {
            padding: 25px 20px;
        }

        .calc-card-header h2 {
            font-size: 1.4rem;
        }

        .calc-form-grid {
            grid-template-columns: 1fr;
        }

        .waste-inputs {
            grid-template-columns: 1fr;
        }

        .results-grid {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width: 480px) {
        .calc-section {
            padding: 40px 0 60px;
        }

        .results-grid {
            grid-template-columns: 1fr;
        }

        .charts-grid {
            grid-template-columns: 1fr !important;
        }
    }

    /* ===== Charts Section Styles ===== */
    .charts-section {
        display: none;
        margin-top: 35px;
        animation: fadeInUp 0.5s ease;
    }

    .charts-section.visible {
        display: block;
    }

    .charts-title {
        text-align: center;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 2px solid #e8f5e9;
    }

    .charts-title h3 {
        font-size: 1.3rem;
        color: #1a5c2a;
        font-weight: 700;
    }

    .charts-title p {
        font-size: 0.9rem;
        color: #777;
        margin-top: 4px;
    }

    .charts-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
        margin-bottom: 24px;
    }

    .chart-card {
        background: #fff;
        border-radius: 16px;
        padding: 24px;
        border: 1px solid #c8e6c9;
        box-shadow: 0 4px 15px rgba(26, 92, 42, 0.06);
        transition: transform 0.3s;
    }

    .chart-card:hover {
        transform: translateY(-3px);
    }

    .chart-card.full-width {
        grid-column: 1 / -1;
    }

    .chart-card-header {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 16px;
        padding-bottom: 12px;
        border-bottom: 1px solid #e8f5e9;
    }

    .chart-card-header .chart-icon {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 1rem;
    }

    .chart-icon.doughnut-icon {
        background: linear-gradient(135deg, #1a5c2a, #2e7d32);
    }

    .chart-icon.bar-icon {
        background: linear-gradient(135deg, #ff9800, #ffa726);
    }

    .chart-icon.line-icon {
        background: linear-gradient(135deg, #1565c0, #42a5f5);
    }

    .chart-card-header h4 {
        font-size: 1rem;
        color: #333;
        font-weight: 600;
    }

    .chart-card-header h4 small {
        display: block;
        font-size: 0.75rem;
        color: #999;
        font-weight: 400;
        margin-top: 2px;
    }

    .chart-container {
        position: relative;
        width: 100%;
        max-height: 320px;
    }

    .chart-container canvas {
        width: 100% !important;
        max-height: 320px;
    }

    @media (max-width: 768px) {
        .charts-grid {
            grid-template-columns: 1fr;
        }

        .chart-container {
            max-height: 280px;
        }

        .chart-container canvas {
            max-height: 280px;
        }
    }
</style>
@endpush

@section('content')
    {{-- Hero Section --}}
    <section class="page-hero">
        <div class="page-hero-shapes">
            <div class="shape"></div>
            <div class="shape"></div>
            <div class="shape"></div>
            <div class="shape"></div>
            <div class="shape"></div>
        </div>
        <div class="page-hero-particles">
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
        </div>
        <canvas class="leaves-canvas" id="leavesCanvas"></canvas>
        <div class="page-hero-content">
            <div class="container">
                <div class="page-hero-icon">
                    <i class="fas fa-recycle"></i>
                </div>
                <div class="page-hero-badge">
                    <i class="fas fa-circle"></i> Analisis Sampah
                </div>
                <h1>Kalkulator <span class="highlight">Sampah</span> Kelas</h1>
                <div class="page-hero-decor-line"></div>
                <p class="page-hero-desc">
                    Hitung dan analisis jumlah sampah di kelasmu. Pantau komposisi sampah organik, anorganik, dan plastik untuk lingkungan sekolah yang lebih bersih.
                </p>
                <div class="page-hero-breadcrumb">
                    <a href="{{ route('home') }}"><i class="fas fa-home"></i> Beranda</a>
                    <span class="separator"><i class="fas fa-chevron-right"></i></span>
                    <span class="current">Kalkulator Sampah</span>
                </div>
            </div>
        </div>
    </section>

    {{-- Calculator Section --}}
    <section class="calc-section">
        <div class="container">
            <div class="calc-wrapper">
                <div class="calc-card">
                    {{-- Card Header --}}
                    <div class="calc-card-header">
                        <i class="fas fa-recycle"></i>
                        <h2>Kalkulator Sampah Kelas</h2>
                        <p>Masukkan data sampah kelasmu untuk melihat analisis lengkap</p>
                    </div>

                    {{-- Card Body --}}
                    <div class="calc-card-body">
                        <form id="wasteForm" onsubmit="return false;">
                            {{-- Nama Kelas & Jumlah Hari --}}
                            <div class="calc-form-grid">
                                <div class="form-group">
                                    <label for="namaKelas">
                                        <i class="fas fa-school"></i> Nama Kelas
                                    </label>
                                    <input type="text" id="namaKelas" placeholder="Contoh: Kelas 10A" required>
                                </div>
                                <div class="form-group">
                                    <label for="jumlahHari">
                                        <i class="fas fa-calendar-day"></i> Jumlah Hari
                                    </label>
                                    <input type="number" id="jumlahHari" placeholder="Contoh: 5" min="1" step="1" required>
                                </div>
                            </div>

                            {{-- Waste Type Inputs --}}
                            <div class="waste-inputs">
                                <div class="waste-input-card organik">
                                    <div class="waste-icon">
                                        <i class="fas fa-leaf"></i>
                                    </div>
                                    <label for="sampahOrganik">Sampah Organik (kg)</label>
                                    <input type="number" id="sampahOrganik" placeholder="0.00" min="0" step="0.01" required>
                                </div>
                                <div class="waste-input-card anorganik">
                                    <div class="waste-icon">
                                        <i class="fas fa-box"></i>
                                    </div>
                                    <label for="sampahAnorganik">Sampah Anorganik (kg)</label>
                                    <input type="number" id="sampahAnorganik" placeholder="0.00" min="0" step="0.01" required>
                                </div>
                                <div class="waste-input-card plastik">
                                    <div class="waste-icon">
                                        <i class="fas fa-wine-bottle"></i>
                                    </div>
                                    <label for="sampahPlastik">Sampah Plastik (kg)</label>
                                    <input type="number" id="sampahPlastik" placeholder="0.00" min="0" step="0.01" required>
                                </div>
                            </div>

                            {{-- Calculate Button --}}
                            <button type="button" class="btn-calculate" id="btnHitung">
                                <i class="fas fa-calculator"></i> Hitung
                            </button>
                        </form>

                        {{-- Results Area --}}
                        <div class="calc-results" id="calcResults">
                            <div class="results-title">
                                <h3><i class="fas fa-chart-pie"></i> Hasil Analisis</h3>
                                <span id="resultKelas"></span>
                            </div>
                            <div class="results-grid">
                                <div class="result-item">
                                    <div class="result-icon"><i class="fas fa-weight-hanging"></i></div>
                                    <div class="result-label">Total Sampah</div>
                                    <div class="result-value" id="resultTotal">-</div>
                                </div>
                                <div class="result-item">
                                    <div class="result-icon"><i class="fas fa-balance-scale"></i></div>
                                    <div class="result-label">Rata-rata per Hari</div>
                                    <div class="result-value" id="resultRataRata">-</div>
                                </div>
                                <div class="result-item organik">
                                    <div class="result-icon"><i class="fas fa-leaf"></i></div>
                                    <div class="result-label">% Organik</div>
                                    <div class="result-value" id="resultOrganik">-</div>
                                </div>
                                <div class="result-item anorganik">
                                    <div class="result-icon"><i class="fas fa-box"></i></div>
                                    <div class="result-label">% Anorganik</div>
                                    <div class="result-value" id="resultAnorganik">-</div>
                                </div>
                                <div class="result-item plastik">
                                    <div class="result-icon"><i class="fas fa-wine-bottle"></i></div>
                                    <div class="result-label">% Plastik</div>
                                    <div class="result-value" id="resultPlastik">-</div>
                                </div>
                                <div class="result-item prediksi">
                                    <div class="result-icon"><i class="fas fa-chart-line"></i></div>
                                    <div class="result-label">Prediksi 30 Hari</div>
                                    <div class="result-value" id="resultPrediksi">-</div>
                                </div>
                            </div>
                        </div>

                        {{-- Charts Area --}}
                        <div class="charts-section" id="chartsSection">
                            <div class="charts-title">
                                <h3><i class="fas fa-chart-bar"></i> Grafik Analisis Sampah</h3>
                                <p>Visualisasi otomatis berdasarkan data kalkulator</p>
                            </div>

                            <div class="charts-grid">
                                {{-- Doughnut Chart - Komposisi --}}
                                <div class="chart-card">
                                    <div class="chart-card-header">
                                        <div class="chart-icon doughnut-icon"><i class="fas fa-chart-pie"></i></div>
                                        <h4>Komposisi Sampah <small>Persentase tiap jenis sampah</small></h4>
                                    </div>
                                    <div class="chart-container">
                                        <canvas id="doughnutChart"></canvas>
                                    </div>
                                </div>

                                {{-- Bar Chart - Jumlah per Jenis --}}
                                <div class="chart-card">
                                    <div class="chart-card-header">
                                        <div class="chart-icon bar-icon"><i class="fas fa-chart-bar"></i></div>
                                        <h4>Jumlah per Jenis <small>Berat sampah dalam kilogram</small></h4>
                                    </div>
                                    <div class="chart-container">
                                        <canvas id="barChart"></canvas>
                                    </div>
                                </div>

                                {{-- Line Chart - Prediksi 30 Hari --}}
                                <div class="chart-card full-width">
                                    <div class="chart-card-header">
                                        <div class="chart-icon line-icon"><i class="fas fa-chart-line"></i></div>
                                        <h4>Prediksi Akumulasi 30 Hari <small>Estimasi total sampah harian berdasarkan rata-rata</small></h4>
                                    </div>
                                    <div class="chart-container">
                                        <canvas id="lineChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"></script>
<script>
(function () {
    'use strict';

    // Simpan referensi chart instance agar bisa di-destroy saat update
    var doughnutChart = null;
    var barChart = null;
    var lineChart = null;

    function validateInputs(namaKelas, jumlahHari, organik, anorganik, plastik) {
        if (!namaKelas || namaKelas.trim() === '') {
            throw new Error('Nama Kelas harus diisi.');
        }

        if (jumlahHari === '' || isNaN(jumlahHari)) {
            throw new Error('Jumlah Hari harus diisi dengan angka yang valid.');
        }

        jumlahHari = Number(jumlahHari);
        if (jumlahHari <= 0) {
            throw new Error('Jumlah Hari harus lebih dari 0.');
        }

        if (organik === '' || isNaN(organik)) {
            throw new Error('Sampah Organik harus diisi dengan angka yang valid.');
        }
        if (anorganik === '' || isNaN(anorganik)) {
            throw new Error('Sampah Anorganik harus diisi dengan angka yang valid.');
        }
        if (plastik === '' || isNaN(plastik)) {
            throw new Error('Sampah Plastik harus diisi dengan angka yang valid.');
        }

        organik = Number(organik);
        anorganik = Number(anorganik);
        plastik = Number(plastik);

        if (organik < 0 || anorganik < 0 || plastik < 0) {
            throw new Error('Nilai sampah tidak boleh negatif.');
        }

        if (organik + anorganik + plastik === 0) {
            throw new Error('Total sampah tidak boleh 0. Masukkan minimal satu jenis sampah.');
        }

        return {
            namaKelas: namaKelas.trim(),
            jumlahHari: jumlahHari,
            organik: organik,
            anorganik: anorganik,
            plastik: plastik
        };
    }

    function hitungSampah(jumlahHari, organik, anorganik, plastik) {
        var total = organik + anorganik + plastik;
        var rataRata = total / jumlahHari;
        var persenOrganik = (organik / total) * 100;
        var persenAnorganik = (anorganik / total) * 100;
        var persenPlastik = (plastik / total) * 100;
        var prediksi30Hari = rataRata * 30;

        return {
            total: total,
            rataRata: rataRata,
            persenOrganik: persenOrganik,
            persenAnorganik: persenAnorganik,
            persenPlastik: persenPlastik,
            prediksi30Hari: prediksi30Hari
        };
    }

    function tampilkanHasil(namaKelas, hasil) {
        document.getElementById('resultKelas').textContent = 'Kelas: ' + namaKelas;
        document.getElementById('resultTotal').innerHTML = hasil.total.toFixed(2) + ' <span class="result-unit">kg</span>';
        document.getElementById('resultRataRata').innerHTML = hasil.rataRata.toFixed(2) + ' <span class="result-unit">kg/hari</span>';
        document.getElementById('resultOrganik').innerHTML = hasil.persenOrganik.toFixed(2) + '<span class="result-unit">%</span>';
        document.getElementById('resultAnorganik').innerHTML = hasil.persenAnorganik.toFixed(2) + '<span class="result-unit">%</span>';
        document.getElementById('resultPlastik').innerHTML = hasil.persenPlastik.toFixed(2) + '<span class="result-unit">%</span>';
        document.getElementById('resultPrediksi').innerHTML = hasil.prediksi30Hari.toFixed(2) + ' <span class="result-unit">kg</span>';

        var resultsEl = document.getElementById('calcResults');
        resultsEl.classList.remove('visible');
        void resultsEl.offsetWidth;
        resultsEl.classList.add('visible');
    }

    /**
     * Render semua grafik berdasarkan data perhitungan.
     */
    function renderCharts(data, hasil) {
        // Destroy chart lama jika ada
        if (doughnutChart) doughnutChart.destroy();
        if (barChart) barChart.destroy();
        if (lineChart) lineChart.destroy();

        var warnaDoughnut = ['#4caf50', '#ff9800', '#f44336'];
        var warnaBackground = ['rgba(76,175,80,0.15)', 'rgba(255,152,0,0.15)', 'rgba(244,67,54,0.15)'];
        var warnaBorder = ['#4caf50', '#ff9800', '#f44336'];

        // === DOUGHNUT CHART ===
        var ctxDoughnut = document.getElementById('doughnutChart').getContext('2d');
        doughnutChart = new Chart(ctxDoughnut, {
            type: 'doughnut',
            data: {
                labels: ['Organik', 'Anorganik', 'Plastik'],
                datasets: [{
                    data: [
                        parseFloat(hasil.persenOrganik.toFixed(2)),
                        parseFloat(hasil.persenAnorganik.toFixed(2)),
                        parseFloat(hasil.persenPlastik.toFixed(2))
                    ],
                    backgroundColor: warnaDoughnut,
                    borderColor: '#fff',
                    borderWidth: 3,
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '55%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 16,
                            usePointStyle: true,
                            pointStyleWidth: 12,
                            font: { family: 'Poppins', size: 12 }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.label + ': ' + context.parsed.toFixed(2) + '%';
                            }
                        }
                    }
                }
            }
        });

        // === BAR CHART ===
        var ctxBar = document.getElementById('barChart').getContext('2d');
        barChart = new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: ['Organik', 'Anorganik', 'Plastik'],
                datasets: [{
                    label: 'Berat (kg)',
                    data: [data.organik, data.anorganik, data.plastik],
                    backgroundColor: warnaDoughnut.map(function(c) { return c + 'CC'; }),
                    borderColor: warnaBorder,
                    borderWidth: 2,
                    borderRadius: 8,
                    borderSkipped: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.parsed.y.toFixed(2) + ' kg';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            font: { family: 'Poppins', size: 11 },
                            callback: function(value) { return value + ' kg'; }
                        },
                        grid: { color: 'rgba(0,0,0,0.05)' }
                    },
                    x: {
                        ticks: { font: { family: 'Poppins', size: 12, weight: '600' } },
                        grid: { display: false }
                    }
                }
            }
        });

        // === LINE CHART — Prediksi Akumulasi 30 Hari ===
        var rataOrganik = data.organik / data.jumlahHari;
        var rataAnorganik = data.anorganik / data.jumlahHari;
        var rataPlastik = data.plastik / data.jumlahHari;

        var labels = [];
        var dataOrganik = [];
        var dataAnorganik = [];
        var dataPlastik = [];
        var dataTotal = [];

        for (var i = 1; i <= 30; i++) {
            labels.push('Hari ' + i);
            dataOrganik.push(parseFloat((rataOrganik * i).toFixed(2)));
            dataAnorganik.push(parseFloat((rataAnorganik * i).toFixed(2)));
            dataPlastik.push(parseFloat((rataPlastik * i).toFixed(2)));
            dataTotal.push(parseFloat((hasil.rataRata * i).toFixed(2)));
        }

        var ctxLine = document.getElementById('lineChart').getContext('2d');
        lineChart = new Chart(ctxLine, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Total',
                        data: dataTotal,
                        borderColor: '#1a5c2a',
                        backgroundColor: 'rgba(26,92,42,0.08)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.3,
                        pointRadius: 0,
                        pointHoverRadius: 5
                    },
                    {
                        label: 'Organik',
                        data: dataOrganik,
                        borderColor: '#4caf50',
                        backgroundColor: 'rgba(76,175,80,0.05)',
                        borderWidth: 2,
                        fill: false,
                        tension: 0.3,
                        borderDash: [5, 3],
                        pointRadius: 0,
                        pointHoverRadius: 4
                    },
                    {
                        label: 'Anorganik',
                        data: dataAnorganik,
                        borderColor: '#ff9800',
                        backgroundColor: 'rgba(255,152,0,0.05)',
                        borderWidth: 2,
                        fill: false,
                        tension: 0.3,
                        borderDash: [5, 3],
                        pointRadius: 0,
                        pointHoverRadius: 4
                    },
                    {
                        label: 'Plastik',
                        data: dataPlastik,
                        borderColor: '#f44336',
                        backgroundColor: 'rgba(244,67,54,0.05)',
                        borderWidth: 2,
                        fill: false,
                        tension: 0.3,
                        borderDash: [5, 3],
                        pointRadius: 0,
                        pointHoverRadius: 4
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: { mode: 'index', intersect: false },
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 16,
                            usePointStyle: true,
                            pointStyleWidth: 12,
                            font: { family: 'Poppins', size: 11 }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ' + context.parsed.y.toFixed(2) + ' kg';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            font: { family: 'Poppins', size: 11 },
                            callback: function(value) { return value + ' kg'; }
                        },
                        grid: { color: 'rgba(0,0,0,0.05)' }
                    },
                    x: {
                        ticks: {
                            font: { family: 'Poppins', size: 10 },
                            maxTicksLimit: 10
                        },
                        grid: { display: false }
                    }
                }
            }
        });

        // Tampilkan section grafik
        var chartsEl = document.getElementById('chartsSection');
        chartsEl.classList.remove('visible');
        void chartsEl.offsetWidth;
        chartsEl.classList.add('visible');
    }

    function handleHitung() {
        try {
            var namaKelas = document.getElementById('namaKelas').value;
            var jumlahHari = document.getElementById('jumlahHari').value;
            var organik = document.getElementById('sampahOrganik').value;
            var anorganik = document.getElementById('sampahAnorganik').value;
            var plastik = document.getElementById('sampahPlastik').value;

            var data = validateInputs(namaKelas, jumlahHari, organik, anorganik, plastik);
            var hasil = hitungSampah(data.jumlahHari, data.organik, data.anorganik, data.plastik);
            tampilkanHasil(data.namaKelas, hasil);
            renderCharts(data, hasil);
        } catch (error) {
            alert('\u26a0\ufe0f ' + error.message);
        }
    }

    document.getElementById('btnHitung').addEventListener('click', handleHitung);
})();
</script>
@endpush

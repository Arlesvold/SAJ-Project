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

        .calc-section .container {
            max-width: 100%;
            width: 100%;
            padding-left: 28px;
            padding-right: 28px;
        }

        .calc-wrapper {
            max-width: none;
            width: 100%;
            margin: 0;
        }

        .calc-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 15px 40px rgba(26, 92, 42, 0.1);
            overflow: hidden;
            min-height: calc(100vh - 250px);
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
            background: radial-gradient(circle, rgba(255, 255, 255, 0.08) 0%, transparent 60%);
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

        .result-item.prediksi.clickable {
            cursor: pointer;
        }

        .result-item.prediksi.clickable .result-label {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
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

            .calc-section .container {
                padding-left: 14px;
                padding-right: 14px;
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

        /* ===== Prediction Detail Section ===== */
        .prediction-detail-section {
            display: none;
            margin-top: 22px;
            padding: 20px;
            border-radius: 16px;
            border: 1px solid #bbdefb;
            background: linear-gradient(135deg, #e3f2fd 0%, #f5fbff 100%);
            animation: fadeInUp 0.4s ease;
        }

        .prediction-detail-section.visible {
            display: block;
        }

        .prediction-detail-header {
            text-align: center;
            margin-bottom: 18px;
        }

        .prediction-detail-header h4 {
            color: #0d47a1;
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .prediction-detail-header p {
            color: #546e7a;
            font-size: 0.88rem;
        }

        .prediction-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 14px;
        }

        .prediction-card {
            background: #ffffff;
            border: 1px solid #d7ebff;
            border-radius: 12px;
            padding: 14px;
            box-shadow: 0 4px 12px rgba(13, 71, 161, 0.08);
        }

        .prediction-card h5 {
            font-size: 0.92rem;
            font-weight: 700;
            margin-bottom: 4px;
            color: #37474f;
        }

        .prediction-card p {
            font-size: 0.8rem;
            color: #607d8b;
            margin-bottom: 10px;
        }

        .prediction-card .prediction-total {
            margin-top: 10px;
            text-align: right;
            font-size: 0.86rem;
            color: #0d47a1;
            font-weight: 600;
        }

        .prediction-card .prediction-avg {
            margin-top: 6px;
            text-align: right;
            font-size: 0.82rem;
            color: #455a64;
            font-weight: 500;
        }

        /* ===== History Table ===== */
        .history-section {
            margin-top: 35px;
            border-top: 2px solid #e8f5e9;
            padding-top: 28px;
        }

        .history-title {
            margin-bottom: 14px;
        }

        .history-title h3 {
            color: #1a5c2a;
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .history-title p {
            font-size: 0.87rem;
            color: #6b7280;
        }

        .history-actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 12px;
            flex-wrap: wrap;
        }

        .history-actions>div {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .history-selection-info {
            font-size: 0.84rem;
            color: #4b5563;
            font-weight: 500;
        }

        .btn-bulk-delete,
        .btn-export-csv,
        .btn-delete-row {
            border: none;
            border-radius: 8px;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            cursor: pointer;
            transition: opacity 0.2s, transform 0.2s;
        }

        .btn-bulk-delete {
            background: linear-gradient(135deg, #c62828, #e53935);
            color: #fff;
            padding: 9px 14px;
            font-size: 0.82rem;
        }

        .btn-bulk-delete:disabled {
            cursor: not-allowed;
            opacity: 0.55;
            transform: none;
        }

        .btn-export-csv {
            background: linear-gradient(135deg, #1565c0, #1e88e5);
            color: #fff;
            padding: 9px 14px;
            font-size: 0.82rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-delete-row {
            background: #fdecea;
            color: #b42318;
            padding: 6px 10px;
            font-size: 0.78rem;
        }

        .btn-delete-row:hover {
            background: #f9d7d3;
        }

        .history-table-wrap {
            overflow-x: auto;
            border: 1px solid #d8e9da;
            border-radius: 12px;
        }

        .history-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 800px;
            background: #fff;
        }

        .history-table thead {
            background: #f1f8e9;
        }

        .history-table th,
        .history-table td {
            padding: 10px 12px;
            border-bottom: 1px solid #eef5ef;
            text-align: left;
            font-size: 0.84rem;
            color: #374151;
            white-space: nowrap;
        }

        .history-table th {
            color: #1a5c2a;
            font-weight: 700;
        }

        .history-table .col-select,
        .history-table .col-action,
        .history-table .cell-select,
        .history-table .cell-action {
            text-align: center;
        }

        .history-select-all,
        .history-select-checkbox {
            width: 16px;
            height: 16px;
            accent-color: #2e7d32;
            cursor: pointer;
        }

        .history-table tbody tr {
            cursor: pointer;
            transition: background 0.2s;
        }

        .history-table tbody tr:hover {
            background: #f9fdf9;
        }

        .history-table tbody tr.active {
            background: #e8f5e9;
        }

        .history-table tbody tr.selected {
            background: #eef7ff;
        }

        .history-empty {
            text-align: center;
            padding: 24px 16px;
            color: #7a8a7d;
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            .charts-grid {
                grid-template-columns: 1fr;
            }

            .prediction-grid {
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
                    Hitung dan analisis jumlah sampah di kelasmu. Pantau komposisi sampah organik, anorganik, dan plastik
                    untuk lingkungan sekolah yang lebih bersih.
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
                                    <input type="number" id="jumlahHari" placeholder="Contoh: 5" min="1"
                                        step="1" required>
                                </div>
                            </div>

                            {{-- Waste Type Inputs --}}
                            <div class="waste-inputs">
                                <div class="waste-input-card organik">
                                    <div class="waste-icon">
                                        <i class="fas fa-leaf"></i>
                                    </div>
                                    <label for="sampahOrganik">Sampah Organik (kg)</label>
                                    <input type="number" id="sampahOrganik" placeholder="0.00" min="0"
                                        step="0.01" required>
                                </div>
                                <div class="waste-input-card anorganik">
                                    <div class="waste-icon">
                                        <i class="fas fa-box"></i>
                                    </div>
                                    <label for="sampahAnorganik">Sampah Anorganik (kg)</label>
                                    <input type="number" id="sampahAnorganik" placeholder="0.00" min="0"
                                        step="0.01" required>
                                </div>
                                <div class="waste-input-card plastik">
                                    <div class="waste-icon">
                                        <i class="fas fa-wine-bottle"></i>
                                    </div>
                                    <label for="sampahPlastik">Sampah Plastik (kg)</label>
                                    <input type="number" id="sampahPlastik" placeholder="0.00" min="0"
                                        step="0.01" required>
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
                                    <div class="result-label"><span>Prediksi 30 Hari</span> <i
                                            class="fas fa-hand-pointer"></i></div>
                                    <div class="result-value" id="resultPrediksi">-</div>
                                </div>
                            </div>
                        </div>

                        {{-- Prediction Detail (Klik Prediksi 30 Hari) --}}
                        <div class="prediction-detail-section" id="predictionDetailSection">
                            <div class="prediction-detail-header">
                                <h4><i class="fas fa-route"></i> Detail Prediksi 30 Hari per Jenis Sampah</h4>
                                <p>Prediksi dipisah untuk organik, anorganik, dan plastik.</p>
                            </div>
                            <div class="prediction-grid">
                                <div class="prediction-card">
                                    <h5><i class="fas fa-leaf"></i> Organik</h5>
                                    <p>Akumulasi harian 1-30 hari</p>
                                    <div class="chart-container">
                                        <canvas id="predChartOrganik"></canvas>
                                    </div>
                                    <div class="prediction-total" id="predTotalOrganik">Total 30 hari: -</div>
                                    <div class="prediction-avg" id="predAvgOrganik">Rata-rata per hari: -</div>
                                </div>
                                <div class="prediction-card">
                                    <h5><i class="fas fa-box"></i> Anorganik</h5>
                                    <p>Akumulasi harian 1-30 hari</p>
                                    <div class="chart-container">
                                        <canvas id="predChartAnorganik"></canvas>
                                    </div>
                                    <div class="prediction-total" id="predTotalAnorganik">Total 30 hari: -</div>
                                    <div class="prediction-avg" id="predAvgAnorganik">Rata-rata per hari: -</div>
                                </div>
                                <div class="prediction-card">
                                    <h5><i class="fas fa-wine-bottle"></i> Plastik</h5>
                                    <p>Akumulasi harian 1-30 hari</p>
                                    <div class="chart-container">
                                        <canvas id="predChartPlastik"></canvas>
                                    </div>
                                    <div class="prediction-total" id="predTotalPlastik">Total 30 hari: -</div>
                                    <div class="prediction-avg" id="predAvgPlastik">Rata-rata per hari: -</div>
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
                                        <h4>Prediksi Total 30 Hari <small>Estimasi akumulasi total sampah</small></h4>
                                    </div>
                                    <div class="chart-container">
                                        <canvas id="lineChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Riwayat Perhitungan --}}
                        <div class="history-section" id="historySection">
                            <div class="history-title">
                                <h3><i class="fas fa-table"></i> Tabel Riwayat Perhitungan</h3>
                                <p>Klik salah satu baris untuk memuat kembali data dan hasil kalkulator.</p>
                            </div>
                            <div class="history-actions">
                                <div>
                                    <button type="button" class="btn-bulk-delete" id="btnBulkDelete" disabled>
                                        <i class="fas fa-trash"></i> Hapus Data Terpilih
                                    </button>
                                    <a href="{{ route('waste-calculator.history.export-csv') }}" class="btn-export-csv"
                                        id="btnExportCsv">
                                        <i class="fas fa-file-csv"></i> Export CSV
                                    </a>
                                </div>
                                <span class="history-selection-info" id="historySelectionInfo">0 data dipilih</span>
                            </div>
                            <div class="history-table-wrap">
                                <table class="history-table">
                                    <thead>
                                        <tr>
                                            <th class="col-select">
                                                <input type="checkbox" id="historySelectAll" class="history-select-all"
                                                    title="Pilih semua data">
                                            </th>
                                            <th>Waktu</th>
                                            <th>Kelas</th>
                                            <th>Hari</th>
                                            <th>Organik (kg)</th>
                                            <th>Anorganik (kg)</th>
                                            <th>Plastik (kg)</th>
                                            <th>Total (kg)</th>
                                            <th>Prediksi 30 Hari (kg)</th>
                                            <th class="col-action">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="historyTableBody">
                                        <tr>
                                            <td colspan="10" class="history-empty">Belum ada data perhitungan.</td>
                                        </tr>
                                    </tbody>
                                </table>
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
        (function() {
            'use strict';

            var HISTORY_INDEX_URL = @json(route('waste-calculator.history.index'));
            var HISTORY_STORE_URL = @json(route('waste-calculator.history.store'));
            var HISTORY_BULK_DELETE_URL = @json(route('waste-calculator.history.bulk-delete'));
            var HISTORY_DESTROY_URL_TEMPLATE = @json(route('waste-calculator.history.destroy', ['id' => '__ID__']));
            var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Simpan referensi chart instance agar bisa di-destroy saat update
            var doughnutChart = null;
            var barChart = null;
            var lineChart = null;
            var predChartOrganik = null;
            var predChartAnorganik = null;
            var predChartPlastik = null;
            var selectedHistoryId = null;
            var selectedHistoryRows = {};
            var historyCache = [];
            var currentData = null;

            function formatAngka(nilai) {
                return Number(nilai).toFixed(2);
            }

            function formatKgChart(nilai) {
                var numberValue = Number(nilai);

                if (!isFinite(numberValue)) {
                    return '0.00';
                }

                var absValue = Math.abs(numberValue);
                if (absValue > 0 && absValue < 0.01) {
                    return numberValue.toFixed(4);
                }

                if (absValue >= 0.01 && absValue < 0.1) {
                    return numberValue.toFixed(3);
                }

                return numberValue.toFixed(2);
            }

            function formatTanggal(isoDate) {
                try {
                    return new Date(isoDate).toLocaleString('id-ID');
                } catch (error) {
                    return isoDate;
                }
            }

            function escapeHtml(value) {
                return String(value)
                    .replace(/&/g, '&amp;')
                    .replace(/</g, '&lt;')
                    .replace(/>/g, '&gt;')
                    .replace(/"/g, '&quot;')
                    .replace(/'/g, '&#39;');
            }

            function buildDestroyUrl(id) {
                return HISTORY_DESTROY_URL_TEMPLATE.replace('__ID__', encodeURIComponent(String(id)));
            }

            async function apiRequest(url, options) {
                var fetchOptions = options || {};
                fetchOptions.headers = fetchOptions.headers || {};
                fetchOptions.headers['X-CSRF-TOKEN'] = CSRF_TOKEN;
                fetchOptions.headers['Accept'] = 'application/json';

                var response = await fetch(url, fetchOptions);
                var payload = null;

                try {
                    payload = await response.json();
                } catch (error) {
                    payload = null;
                }

                if (!response.ok || !payload || payload.success === false) {
                    var message = payload && payload.message ? payload.message :
                        'Terjadi kesalahan saat memproses data.';
                    throw new Error(message);
                }

                return payload;
            }

            async function loadHistory() {
                try {
                    var payload = await apiRequest(HISTORY_INDEX_URL, {
                        method: 'GET'
                    });
                    return Array.isArray(payload.data) ? payload.data : [];
                } catch (error) {
                    console.error('Gagal membaca riwayat kalkulator:', error);
                    alert(error.message || 'Gagal mengambil data riwayat dari server.');
                    return [];
                }
            }

            async function tambahRiwayat(data) {
                var payload = await apiRequest(HISTORY_STORE_URL, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        namaKelas: data.namaKelas,
                        jumlahHari: data.jumlahHari,
                        organik: data.organik,
                        anorganik: data.anorganik,
                        plastik: data.plastik
                    })
                });

                return payload.data;
            }

            async function refreshHistoryTable() {
                historyCache = await loadHistory();
                renderHistoryTable();
            }

            function renderHistoryTable() {
                var tbody = document.getElementById('historyTableBody');
                var historyList = historyCache;
                var selectAllCheckbox = document.getElementById('historySelectAll');
                var selectedKeys = Object.keys(selectedHistoryRows).filter(function(id) {
                    return selectedHistoryRows[id];
                });

                if (!historyList.length) {
                    selectedHistoryRows = {};
                    tbody.innerHTML =
                        '<tr><td colspan="10" class="history-empty">Belum ada data perhitungan.</td></tr>';
                    if (selectAllCheckbox) {
                        selectAllCheckbox.checked = false;
                        selectAllCheckbox.indeterminate = false;
                    }
                    updateBulkDeleteState();
                    return;
                }

                // Bersihkan id terpilih yang sudah tidak ada di riwayat.
                selectedKeys.forEach(function(id) {
                    var isExists = historyList.some(function(item) {
                        return String(item.id) === String(id);
                    });
                    if (!isExists) {
                        delete selectedHistoryRows[id];
                    }
                });

                var rows = historyList.map(function(item) {
                    var isActive = String(selectedHistoryId) === String(item.id) ? 'active' : '';
                    var isChecked = !!selectedHistoryRows[item.id];
                    var selectedClass = isChecked ? 'selected' : '';
                    return '<tr class="' + isActive + ' ' + selectedClass + '" data-id="' + item.id + '">' +
                        '<td class="cell-select"><input type="checkbox" class="history-select-checkbox" data-id="' +
                        item.id + '" ' + (isChecked ? 'checked' : '') + '></td>' +
                        '<td>' + formatTanggal(item.waktu) + '</td>' +
                        '<td>' + escapeHtml(item.data.namaKelas) + '</td>' +
                        '<td>' + item.data.jumlahHari + '</td>' +
                        '<td>' + formatAngka(item.data.organik) + '</td>' +
                        '<td>' + formatAngka(item.data.anorganik) + '</td>' +
                        '<td>' + formatAngka(item.data.plastik) + '</td>' +
                        '<td>' + formatAngka(item.hasil.total) + '</td>' +
                        '<td>' + formatAngka(item.hasil.prediksi30Hari) + '</td>' +
                        '<td class="cell-action"><button type="button" class="btn-delete-row" data-id="' + item
                        .id +
                        '"><i class="fas fa-trash"></i> Delete</button></td>' +
                        '</tr>';
                }).join('');

                tbody.innerHTML = rows;
                syncSelectAllCheckbox();
                updateBulkDeleteState();
            }

            function getSelectedHistoryIds() {
                return Object.keys(selectedHistoryRows).filter(function(id) {
                    return selectedHistoryRows[id];
                });
            }

            function syncSelectAllCheckbox() {
                var selectAllCheckbox = document.getElementById('historySelectAll');
                if (!selectAllCheckbox) {
                    return;
                }

                var checkboxes = document.querySelectorAll('.history-select-checkbox');
                if (!checkboxes.length) {
                    selectAllCheckbox.checked = false;
                    selectAllCheckbox.indeterminate = false;
                    return;
                }

                var checkedCount = Array.prototype.filter.call(checkboxes, function(checkbox) {
                    return checkbox.checked;
                }).length;

                selectAllCheckbox.checked = checkedCount > 0 && checkedCount === checkboxes.length;
                selectAllCheckbox.indeterminate = checkedCount > 0 && checkedCount < checkboxes.length;
            }

            function updateBulkDeleteState() {
                var selectedCount = getSelectedHistoryIds().length;
                var bulkDeleteButton = document.getElementById('btnBulkDelete');
                var infoText = document.getElementById('historySelectionInfo');

                if (bulkDeleteButton) {
                    bulkDeleteButton.disabled = selectedCount === 0;
                }

                if (infoText) {
                    infoText.textContent = selectedCount + ' data dipilih';
                }
            }

            async function deleteHistoryById(id) {
                await apiRequest(buildDestroyUrl(id), {
                    method: 'DELETE'
                });
                delete selectedHistoryRows[String(id)];

                if (String(selectedHistoryId) === String(id)) {
                    selectedHistoryId = null;
                }
            }

            async function bulkDeleteSelectedHistory() {
                var ids = getSelectedHistoryIds();
                if (!ids.length) {
                    alert('Pilih minimal 1 data untuk dihapus.');
                    return;
                }

                if (!confirm('Hapus ' + ids.length + ' data riwayat terpilih?')) {
                    return;
                }

                await apiRequest(HISTORY_BULK_DELETE_URL, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        ids: ids
                    })
                });

                var idLookup = {};
                ids.forEach(function(id) {
                    idLookup[String(id)] = true;
                });
                selectedHistoryRows = {};

                if (selectedHistoryId && idLookup[String(selectedHistoryId)]) {
                    selectedHistoryId = null;
                }

                await refreshHistoryTable();
            }

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
                document.getElementById('resultTotal').innerHTML = formatAngka(hasil.total) +
                    ' <span class="result-unit">kg</span>';
                document.getElementById('resultRataRata').innerHTML = formatAngka(hasil.rataRata) +
                    ' <span class="result-unit">kg/hari</span>';
                document.getElementById('resultOrganik').innerHTML = formatAngka(hasil.persenOrganik) +
                    '<span class="result-unit">%</span>';
                document.getElementById('resultAnorganik').innerHTML = formatAngka(hasil.persenAnorganik) +
                    '<span class="result-unit">%</span>';
                document.getElementById('resultPlastik').innerHTML = formatAngka(hasil.persenPlastik) +
                    '<span class="result-unit">%</span>';
                document.getElementById('resultPrediksi').innerHTML = formatAngka(hasil.prediksi30Hari) +
                    ' <span class="result-unit">kg</span>';

                var resultsEl = document.getElementById('calcResults');
                resultsEl.classList.remove('visible');
                void resultsEl.offsetWidth;
                resultsEl.classList.add('visible');
            }

            function hidePredictionDetail() {
                var section = document.getElementById('predictionDetailSection');
                section.classList.remove('visible');
            }

            function renderSeparatedPrediction(data) {
                var labels = [];
                var seriesOrganik = [];
                var seriesAnorganik = [];
                var seriesPlastik = [];

                var rataOrganik = data.organik / data.jumlahHari;
                var rataAnorganik = data.anorganik / data.jumlahHari;
                var rataPlastik = data.plastik / data.jumlahHari;

                for (var i = 1; i <= 30; i++) {
                    labels.push('Hari ' + i);
                    seriesOrganik.push(parseFloat((rataOrganik * i).toFixed(2)));
                    seriesAnorganik.push(parseFloat((rataAnorganik * i).toFixed(2)));
                    seriesPlastik.push(parseFloat((rataPlastik * i).toFixed(2)));
                }

                if (predChartOrganik) predChartOrganik.destroy();
                if (predChartAnorganik) predChartAnorganik.destroy();
                if (predChartPlastik) predChartPlastik.destroy();

                function createSinglePredictionChart(canvasId, label, color, dataPoints) {
                    var ctx = document.getElementById(canvasId).getContext('2d');
                    return new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: label,
                                data: dataPoints,
                                borderColor: color,
                                backgroundColor: color + '22',
                                borderWidth: 2,
                                tension: 0.3,
                                fill: true,
                                pointRadius: 0,
                                pointHoverRadius: 4
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: false
                                },
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
                                        font: {
                                            family: 'Poppins',
                                            size: 10
                                        },
                                        callback: function(value) {
                                            return value + ' kg';
                                        }
                                    },
                                    grid: {
                                        color: 'rgba(0,0,0,0.05)'
                                    }
                                },
                                x: {
                                    ticks: {
                                        font: {
                                            family: 'Poppins',
                                            size: 9
                                        },
                                        maxTicksLimit: 6
                                    },
                                    grid: {
                                        display: false
                                    }
                                }
                            }
                        }
                    });
                }

                predChartOrganik = createSinglePredictionChart('predChartOrganik', 'Organik', '#4caf50', seriesOrganik);
                predChartAnorganik = createSinglePredictionChart('predChartAnorganik', 'Anorganik', '#ff9800',
                    seriesAnorganik);
                predChartPlastik = createSinglePredictionChart('predChartPlastik', 'Plastik', '#f44336', seriesPlastik);

                document.getElementById('predTotalOrganik').textContent = 'Total 30 hari: ' + formatAngka(seriesOrganik[
                    29]) + ' kg';
                document.getElementById('predTotalAnorganik').textContent = 'Total 30 hari: ' + formatAngka(
                    seriesAnorganik[29]) + ' kg';
                document.getElementById('predTotalPlastik').textContent = 'Total 30 hari: ' + formatAngka(seriesPlastik[
                    29]) + ' kg';
                document.getElementById('predAvgOrganik').textContent = 'Rata-rata per hari: ' + formatAngka(
                    rataOrganik) + ' kg/hari';
                document.getElementById('predAvgAnorganik').textContent = 'Rata-rata per hari: ' + formatAngka(
                    rataAnorganik) + ' kg/hari';
                document.getElementById('predAvgPlastik').textContent = 'Rata-rata per hari: ' + formatAngka(
                    rataPlastik) + ' kg/hari';

                var section = document.getElementById('predictionDetailSection');
                section.classList.add('visible');
                section.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
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
                                    font: {
                                        family: 'Poppins',
                                        size: 12
                                    }
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
                            backgroundColor: warnaDoughnut.map(function(c) {
                                return c + 'CC';
                            }),
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
                            legend: {
                                display: false
                            },
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
                                    font: {
                                        family: 'Poppins',
                                        size: 11
                                    },
                                    callback: function(value) {
                                        return value + ' kg';
                                    }
                                },
                                grid: {
                                    color: 'rgba(0,0,0,0.05)'
                                }
                            },
                            x: {
                                ticks: {
                                    font: {
                                        family: 'Poppins',
                                        size: 12,
                                        weight: '600'
                                    }
                                },
                                grid: {
                                    display: false
                                }
                            }
                        }
                    }
                });

                // === LINE CHART — Prediksi TOTAL 30 Hari ===
                var totalInput = Number(data.organik) + Number(data.anorganik) + Number(data.plastik);
                var jumlahHariInput = Number(data.jumlahHari);
                var prediksi30HariTotal = Number(hasil && hasil.prediksi30Hari);

                if (!isFinite(prediksi30HariTotal) || prediksi30HariTotal <= 0) {
                    if (isFinite(jumlahHariInput) && jumlahHariInput > 0) {
                        prediksi30HariTotal = (totalInput / jumlahHariInput) * 30;
                    } else {
                        prediksi30HariTotal = 0;
                    }
                }

                var rataTotal = prediksi30HariTotal / 30;

                var labels = [];
                var dataTotal = [];

                for (var i = 1; i <= 30; i++) {
                    labels.push('Hari ' + i);
                    dataTotal.push(parseFloat((rataTotal * i).toFixed(6)));
                }

                var ctxLine = document.getElementById('lineChart').getContext('2d');
                lineChart = new Chart(ctxLine, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Total: ' + formatAngka(prediksi30HariTotal) + ' kg',
                            data: dataTotal,
                            borderColor: '#1a5c2a',
                            backgroundColor: 'rgba(26,92,42,0.08)',
                            borderWidth: 3,
                            fill: true,
                            tension: 0.3,
                            pointRadius: 0,
                            pointHoverRadius: 5
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        interaction: {
                            mode: 'index',
                            intersect: false
                        },
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    padding: 16,
                                    font: {
                                        family: 'Poppins',
                                        size: 11
                                    }
                                }
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return 'Prediksi: ' + formatKgChart(context.parsed.y) + ' kg';
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    font: {
                                        family: 'Poppins',
                                        size: 11
                                    },
                                    callback: function(value) {
                                        return formatKgChart(value) + ' kg';
                                    }
                                },
                                grid: {
                                    color: 'rgba(0,0,0,0.05)'
                                }
                            },
                            x: {
                                ticks: {
                                    font: {
                                        family: 'Poppins',
                                        size: 10
                                    },
                                    maxTicksLimit: 10
                                },
                                grid: {
                                    display: false
                                }
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

            function isiForm(data) {
                document.getElementById('namaKelas').value = data.namaKelas;
                document.getElementById('jumlahHari').value = data.jumlahHari;
                document.getElementById('sampahOrganik').value = data.organik;
                document.getElementById('sampahAnorganik').value = data.anorganik;
                document.getElementById('sampahPlastik').value = data.plastik;
            }

            async function terapkanPerhitungan(data, shouldSaveHistory) {
                var hasil = hitungSampah(data.jumlahHari, data.organik, data.anorganik, data.plastik);
                tampilkanHasil(data.namaKelas, hasil);
                renderCharts(data, hasil);
                hidePredictionDetail();
                currentData = data;

                if (shouldSaveHistory) {
                    var savedItem = await tambahRiwayat(data);
                    selectedHistoryId = savedItem && savedItem.id ? savedItem.id : null;
                    await refreshHistoryTable();
                }
            }

            async function handleHitung() {
                try {
                    var namaKelas = document.getElementById('namaKelas').value;
                    var jumlahHari = document.getElementById('jumlahHari').value;
                    var organik = document.getElementById('sampahOrganik').value;
                    var anorganik = document.getElementById('sampahAnorganik').value;
                    var plastik = document.getElementById('sampahPlastik').value;

                    var data = validateInputs(namaKelas, jumlahHari, organik, anorganik, plastik);
                    await terapkanPerhitungan(data, true);
                } catch (error) {
                    alert('\u26a0\ufe0f ' + error.message);
                }
            }

            async function handleHistoryClick(event) {
                var deleteButton = event.target.closest('.btn-delete-row');
                if (deleteButton) {
                    var deleteId = deleteButton.getAttribute('data-id');
                    if (!confirm('Hapus data riwayat ini?')) {
                        return;
                    }

                    try {
                        await deleteHistoryById(deleteId);
                        await refreshHistoryTable();
                    } catch (error) {
                        alert(error.message || 'Gagal menghapus data riwayat.');
                    }
                    return;
                }

                if (event.target.closest('.history-select-checkbox')) {
                    return;
                }

                var row = event.target.closest('tr[data-id]');
                if (!row) {
                    return;
                }

                var id = row.getAttribute('data-id');
                var selected = historyCache.find(function(item) {
                    return String(item.id) === String(id);
                });

                if (!selected) {
                    return;
                }

                selectedHistoryId = selected.id;
                var data = {
                    namaKelas: selected.data.namaKelas,
                    jumlahHari: Number(selected.data.jumlahHari),
                    organik: Number(selected.data.organik),
                    anorganik: Number(selected.data.anorganik),
                    plastik: Number(selected.data.plastik)
                };

                isiForm(data);
                await terapkanPerhitungan(data, false);
                renderHistoryTable();
            }

            function handleHistoryTableChange(event) {
                var target = event.target;

                if (target && target.id === 'historySelectAll') {
                    var shouldCheck = target.checked;
                    var checkboxes = document.querySelectorAll('.history-select-checkbox');

                    Array.prototype.forEach.call(checkboxes, function(checkbox) {
                        checkbox.checked = shouldCheck;
                        var id = checkbox.getAttribute('data-id');
                        if (shouldCheck) {
                            selectedHistoryRows[id] = true;
                        } else {
                            delete selectedHistoryRows[id];
                        }
                    });

                    renderHistoryTable();
                    return;
                }

                if (target && target.classList.contains('history-select-checkbox')) {
                    var id = target.getAttribute('data-id');
                    if (target.checked) {
                        selectedHistoryRows[id] = true;
                    } else {
                        delete selectedHistoryRows[id];
                    }

                    renderHistoryTable();
                }
            }

            function handlePrediksiClick() {
                if (!currentData) {
                    alert('Hitung dulu data sampah, lalu klik Prediksi 30 Hari untuk lihat detail per jenis.');
                    return;
                }

                renderSeparatedPrediction(currentData);
            }

            function initPredictionCard() {
                var prediksiCard = document.querySelector('.result-item.prediksi');
                if (!prediksiCard) {
                    return;
                }

                prediksiCard.classList.add('clickable');
                prediksiCard.setAttribute('role', 'button');
                prediksiCard.setAttribute('tabindex', '0');
                prediksiCard.addEventListener('click', handlePrediksiClick);
                prediksiCard.addEventListener('keydown', function(event) {
                    if (event.key === 'Enter' || event.key === ' ') {
                        event.preventDefault();
                        handlePrediksiClick();
                    }
                });
            }

            function init() {
                document.getElementById('btnHitung').addEventListener('click', handleHitung);
                document.getElementById('historyTableBody').addEventListener('click', function(event) {
                    handleHistoryClick(event).catch(function(error) {
                        alert(error.message || 'Terjadi kesalahan saat memproses data riwayat.');
                    });
                });
                document.getElementById('historySection').addEventListener('change', handleHistoryTableChange);
                document.getElementById('btnBulkDelete').addEventListener('click', function() {
                    bulkDeleteSelectedHistory().catch(function(error) {
                        alert(error.message || 'Gagal menghapus data terpilih.');
                    });
                });
                initPredictionCard();
                refreshHistoryTable();
            }

            init();
        })();
    </script>
@endpush

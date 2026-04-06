@extends('layouts.app')

@section('title', 'Profil Web Developer - Go Green School')

@push('styles')
    <style>
        .dev-page {
            padding: 70px 0;
            background:
                radial-gradient(circle at 92% 6%, rgba(129, 199, 132, .2), transparent 36%),
                radial-gradient(circle at 6% 84%, rgba(46, 125, 50, .12), transparent 34%),
                linear-gradient(180deg, #f6fbf7 0%, #f0f7f2 100%);
        }

        .dev-overview {
            background: linear-gradient(140deg, #ffffff 0%, #f3faf4 100%);
            border-radius: 24px;
            border: 1px solid rgba(46, 125, 50, .1);
            box-shadow: 0 18px 40px rgba(15, 46, 26, .08);
            padding: 28px;
            margin-bottom: 28px;
            display: grid;
            grid-template-columns: 1.3fr 1fr;
            gap: 24px;
            align-items: center;
        }

        .dev-kicker {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: .82rem;
            color: #1f6f34;
            background: rgba(129, 199, 132, .2);
            padding: 6px 12px;
            border-radius: 999px;
            margin-bottom: 12px;
            font-weight: 600;
        }

        .dev-overview h2 {
            font-size: clamp(1.5rem, 2.8vw, 2.2rem);
            color: #173d25;
            margin-bottom: 10px;
            line-height: 1.3;
        }

        .dev-overview p {
            color: #4c6355;
            line-height: 1.75;
        }

        .dev-meta-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }

        .dev-meta-item {
            background: #fff;
            border-radius: 14px;
            border: 1px solid rgba(46, 125, 50, .1);
            padding: 12px 14px;
        }

        .dev-meta-label {
            color: #6c8374;
            font-size: .75rem;
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: .04em;
            font-weight: 700;
        }

        .dev-meta-value {
            color: #214932;
            font-weight: 700;
            font-size: .95rem;
            line-height: 1.4;
        }

        .dev-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .dev-card {
            position: relative;
            display: grid;
            grid-template-columns: 170px 1fr;
            align-items: stretch;
            width: 100%;
            background: #fff;
            border: 1px solid rgba(46, 125, 50, .12);
            border-radius: 22px;
            overflow: hidden;
            box-shadow: 0 14px 34px rgba(17, 53, 30, .1);
            transition: transform .25s ease, box-shadow .25s ease;
        }

        .dev-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 42px rgba(17, 53, 30, .16);
        }

        .dev-card-photo {
            display: flex;
            align-items: stretch;
            justify-content: center;
            padding: 0;
            background: linear-gradient(120deg, #e8f5e9, #f3faf4);
            border-right: 1px solid rgba(46, 125, 50, .08);
            overflow: hidden;
            position: relative;
        }

        .dev-avatar {
            width: 100%;
            height: 100%;
            min-height: 200px;
            object-fit: cover;
            transition: transform 0.4s ease;
            transform: scale(var(--dev-photo-zoom, 1));
            transform-origin: center;
        }

        .dev-card:hover .dev-avatar {
            transform: scale(calc(var(--dev-photo-zoom, 1) + .08));
        }

        .dev-headline {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 10px;
        }

        .dev-name {
            font-size: 1.05rem;
            color: #193f27;
            margin: 0;
            font-weight: 700;
        }

        .dev-role {
            font-size: .8rem;
            color: #2e7d32;
            font-weight: 600;
            background: rgba(76, 175, 80, .16);
            padding: 4px 8px;
            border-radius: 999px;
            display: inline-flex;
        }

        .dev-card-body {
            padding: 14px 16px;
        }

        .dev-info-list {
            display: grid;
            grid-template-columns: 1fr;
            gap: 6px;
            margin-bottom: 12px;
        }

        .dev-info-row {
            display: grid;
            grid-template-columns: 95px 1fr;
            gap: 6px;
            font-size: .85rem;
        }

        .dev-info-label {
            color: #698072;
            font-weight: 600;
        }

        .dev-info-value {
            color: #244936;
            font-weight: 500;
            line-height: 1.5;
        }

        .dev-contribution {
            margin-top: 6px;
            padding: 10px 12px;
            border-radius: 12px;
            background: #f4faf5;
            border: 1px dashed rgba(46, 125, 50, .25);
            color: #46624f;
            font-size: .85rem;
            line-height: 1.6;
        }

        .dev-contact {
            margin-top: 10px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #1f6c33;
            font-size: .85rem;
            font-weight: 600;
            text-decoration: none;
        }

        .dev-contact:hover {
            color: #184e25;
        }

        @media (max-width: 992px) {
            .dev-overview {
                grid-template-columns: 1fr;
            }

            .dev-grid {
                grid-template-columns: 1fr;
            }

            .dev-card {
                max-width: 100%;
            }
        }

        @media (max-width: 640px) {
            .dev-page {
                padding: 55px 0;
            }

            .dev-overview {
                padding: 20px;
                border-radius: 18px;
            }

            .dev-meta-grid {
                grid-template-columns: 1fr;
            }

            .dev-card {
                grid-template-columns: 1fr;
            }

            .dev-card-photo {
                border-right: none;
                border-bottom: 1px solid rgba(46, 125, 50, .08);
                aspect-ratio: 4 / 5;
                min-height: 0;
            }

            .dev-avatar {
                width: 100%;
                height: 100%;
                min-height: 0;
                object-position: center 18%;
            }

            .dev-card-body {
                padding: 14px;
            }

            .dev-info-row {
                grid-template-columns: 1fr;
                gap: 3px;
            }

            .dev-headline {
                align-items: flex-start;
                flex-direction: column;
                gap: 8px;
            }
        }
    </style>
@endpush

@section('content')
    <section class="page-hero"
        style="background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.7)), url('https://images.unsplash.com/photo-1517048676732-d65bc937f952?auto=format&fit=crop&w=1800&q=80'); background-size: cover; background-position: center; background-attachment: fixed; position: relative;">
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
        <div class="page-hero-content" style="position: relative; z-index: 10; color: white; text-align: center;">
            <div class="container">
                <div class="page-hero-icon"
                    style="background: rgba(255,255,255,0.2); backdrop-filter: blur(5px); color: #fff; width: 80px; height: 80px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2.5rem; margin: 0 auto 20px;">
                    <i class="fas fa-code"></i>
                </div>
                <div class="page-hero-badge"
                    style="background: rgba(76, 175, 80, 0.8); color: white; border: none; padding: 8px 20px; font-weight: bold; border-radius: 30px; display: inline-block; margin-bottom: 20px;">
                    <i class="fas fa-circle" style="color: #c8e6c9;"></i> Go Green School
                </div>
                <h1 style="color: white; font-size: 3.5rem; font-weight: 800; text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">
                    <span class="highlight" style="color: #a5d6a7; text-shadow: none;">Profil</span>&nbsp;Developer
                </h1>
                <div class="page-hero-decor-line" style="background: #a5d6a7; height: 4px; width: 60px; margin: 20px auto;">
                </div>
                <p class="page-hero-desc"
                    style="color: #e0e0e0; font-size: 1.2rem; max-width: 650px; margin: 0 auto 30px; text-shadow: 1px 1px 3px rgba(0,0,0,0.5);">
                    Halaman ini menampilkan profil 4 siswa pengembang website
                    {{ $projectMeta['project'] ?? 'Go Green School' }} dari
                    {{ $projectMeta['school'] ?? 'SMK Karya Bangsa Sintang' }}.
                </p>
                <div class="page-hero-breadcrumb"
                    style="background: rgba(0,0,0,0.4); padding: 10px 20px; border-radius: 20px; display: inline-flex; gap: 10px;">
                    <a href="{{ route('home') }}" style="color: #a5d6a7; text-decoration: none;"><i class="fas fa-home"></i>
                        Beranda</a>
                    <span class="separator" style="color: #999;"><i class="fas fa-chevron-right"></i></span>
                    <span class="current" style="color: white;">Profil Developer</span>
                </div>
            </div>
        </div>
    </section>

    <section class="dev-page">
        <div class="container">
            <div class="dev-overview">
                <div>
                    <span class="dev-kicker"><i class="fas fa-seedling"></i> Student Developer Team</span>
                    <h2>Membangun web edukasi lingkungan yang informatif, modern, dan berdampak.</h2>
                    <p>
                        Tim siswa ini berkolaborasi untuk merancang pengalaman pengguna yang nyaman, sistem fitur yang
                        stabil, serta tampilan visual yang relevan dengan semangat sekolah hijau. Semua dikembangkan secara
                        bertahap sepanjang proses pembelajaran proyek.
                    </p>
                </div>
                <div class="dev-meta-grid">
                    <div class="dev-meta-item">
                        <div class="dev-meta-label">Nama Proyek</div>
                        <div class="dev-meta-value">{{ $projectMeta['project'] ?? 'Go Green School' }}</div>
                    </div>
                    <div class="dev-meta-item">
                        <div class="dev-meta-label">Tahun Pembuatan</div>
                        <div class="dev-meta-value">{{ $projectMeta['year'] ?? '2026' }}</div>
                    </div>
                    <div class="dev-meta-item">
                        <div class="dev-meta-label">Development Setup</div>
                        <div class="dev-meta-value">
                            {{ $projectMeta['stack'] ?? 'Laravel 11, PHP, Blade, CSS, JavaScript, Laragon' }}</div>
                    </div>
                    <div class="dev-meta-item">
                        <div class="dev-meta-label">Asal Sekolah</div>
                        <div class="dev-meta-value">{{ $projectMeta['school'] ?? 'SMK Karya Bangsa Sintang' }}</div>
                    </div>
                </div>
            </div>

            <div class="dev-grid">
                @forelse ($developers as $developer)
                    <article class="dev-card">
                        <div class="dev-card-photo">
                            <img class="dev-avatar" src="{{ $developer['photo'] }}" alt="Foto {{ $developer['name'] }}"
                                style="--dev-photo-zoom: {{ $developer['photo_zoom'] ?? '1' }};" loading="lazy">
                        </div>
                        <div class="dev-card-body">
                            <div class="dev-headline">
                                <h3 class="dev-name">{{ $developer['name'] }}</h3>
                                <span class="dev-role">{{ $developer['role'] }}</span>
                            </div>
                            <div class="dev-info-list">
                                <div class="dev-info-row">
                                    <span class="dev-info-label">Umur</span>
                                    <span class="dev-info-value">{{ $developer['age'] }}</span>
                                </div>
                                <div class="dev-info-row">
                                    <span class="dev-info-label">Kelas</span>
                                    <span class="dev-info-value">{{ $developer['class'] }}</span>
                                </div>
                                <div class="dev-info-row">
                                    <span class="dev-info-label">Asal Sekolah</span>
                                    <span class="dev-info-value">{{ $developer['school'] }}</span>
                                </div>
                                <div class="dev-info-row">
                                    <span class="dev-info-label">Fokus</span>
                                    <span class="dev-info-value">{{ $developer['focus'] }}</span>
                                </div>
                                <div class="dev-info-row">
                                    <span class="dev-info-label"> Kelahiran</span>
                                    <span class="dev-info-value">{{ $developer['year'] }}</span>
                                </div>
                            </div>
                            <div class="dev-contribution">
                                <strong>Kontribusi:</strong> {{ $developer['contribution'] }}
                            </div>
                            <a class="dev-contact" href="mailto:{{ $developer['email'] }}">
                                <i class="fas fa-envelope-open-text"></i> {{ $developer['email'] }}
                            </a>
                        </div>
                    </article>
                @empty
                    <div class="dev-card" style="grid-column: 1 / -1; padding: 18px;">
                        Data developer belum tersedia.
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection

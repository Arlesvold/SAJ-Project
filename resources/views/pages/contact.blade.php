@extends('layouts.app')

@section('title', 'Kontak - Go Green School')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/trix@2.1.8/dist/trix.css">
    <style>
        .contact-modern-section {
            padding: 70px 0;
            background:
                radial-gradient(circle at 20% 20%, rgba(46, 125, 50, 0.08), transparent 45%),
                radial-gradient(circle at 80% 80%, rgba(21, 101, 192, 0.08), transparent 45%),
                linear-gradient(180deg, #ffffff 0%, #f5fbf7 100%);
        }

        .contact-modern-shell {
            position: relative;
            overflow: hidden;
            background: #ffffff;
            border-radius: 24px;
            border: 1px solid rgba(46, 125, 50, 0.12);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.08);
            padding: 42px;
        }

        .contact-modern-shell::before,
        .contact-modern-shell::after {
            content: '';
            position: absolute;
            border-radius: 999px;
            pointer-events: none;
            z-index: 0;
        }

        .contact-modern-shell::before {
            width: 260px;
            height: 260px;
            background: rgba(46, 125, 50, 0.1);
            top: -130px;
            right: -60px;
            filter: blur(4px);
        }

        .contact-modern-shell::after {
            width: 200px;
            height: 200px;
            background: rgba(21, 101, 192, 0.08);
            bottom: -90px;
            left: -80px;
            filter: blur(4px);
        }

        .contact-modern-grid {
            position: relative;
            z-index: 1;
            display: grid;
            grid-template-columns: 1fr 1.15fr;
            gap: 34px;
        }

        .contact-modern-grid>* {
            min-width: 0;
        }

        .contact-modern-intro h2 {
            font-size: 2.1rem;
            line-height: 1.25;
            margin: 12px 0 14px;
            color: var(--dark);
        }

        .contact-modern-intro p {
            color: #5f6f6a;
            line-height: 1.8;
            margin: 0 0 22px;
        }

        .contact-modern-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(46, 125, 50, 0.12);
            color: #1b5e20;
            border-radius: 999px;
            padding: 8px 14px;
            font-size: 0.86rem;
            font-weight: 700;
            letter-spacing: 0.2px;
        }

        .contact-modern-features {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }

        .contact-modern-feature {
            border: 1px solid #e6efe8;
            background: #fbfefc;
            border-radius: 12px;
            padding: 12px;
            display: flex;
            gap: 10px;
            align-items: flex-start;
        }

        .contact-modern-feature i {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            background: linear-gradient(135deg, #2e7d32, #66bb6a);
            font-size: 0.82rem;
            flex-shrink: 0;
        }

        .contact-modern-feature span {
            color: #34433f;
            font-size: 0.89rem;
            line-height: 1.45;
        }

        .contact-modern-form {
            background: #f9fcfa;
            border: 1px solid #e2ede5;
            border-radius: 16px;
            padding: 24px;
            width: 100%;
            min-width: 0;
        }

        .contact-form-row {
            display: flex;
            gap: 16px;
            margin-bottom: 16px;
            flex-wrap: wrap;
        }

        .contact-form-col {
            flex: 1 1 calc(50% - 10px);
            min-width: 0;
        }

        .contact-modern-form .field-label {
            display: block;
            color: var(--dark);
            margin-bottom: 8px;
            font-weight: 600;
        }

        .contact-modern-form .field-input,
        .contact-modern-form .field-select {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #d6e3da;
            border-radius: 10px;
            outline: none;
            font-family: inherit;
            background: #ffffff;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .contact-modern-form .field-input:focus,
        .contact-modern-form .field-select:focus,
        .contact-rich-editor trix-editor:focus {
            border-color: #66bb6a;
            box-shadow: 0 0 0 3px rgba(102, 187, 106, 0.2);
        }

        .contact-rich-editor trix-editor {
            min-height: 220px;
            border: 1px solid #d6e3da;
            border-radius: 10px;
            background: #fff;
            padding: 14px 15px;
        }

        .contact-rich-editor trix-toolbar .trix-button-group--file-tools {
            display: none;
        }

        .contact-rich-editor trix-toolbar {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .contact-rich-editor trix-toolbar .trix-button-row {
            flex-wrap: nowrap;
            width: max-content;
        }

        .contact-editor-meta {
            margin-top: 8px;
            display: flex;
            justify-content: space-between;
            gap: 12px;
            color: #6a7b75;
            font-size: 0.82rem;
        }

        .contact-submit-note {
            text-align: center;
            margin-top: 15px;
            font-size: 0.85rem;
            color: var(--gray);
        }

        @media (max-width: 992px) {
            .contact-modern-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .contact-modern-shell {
                padding: 20px;
                border-radius: 18px;
            }

            .contact-modern-intro h2 {
                font-size: 1.7rem;
            }

            .contact-modern-features {
                grid-template-columns: 1fr;
            }

            .contact-modern-form {
                padding: 16px;
            }

            .contact-form-row {
                gap: 12px;
            }

            .contact-form-col {
                flex: 1 1 100%;
            }

            .contact-editor-meta {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
@endpush

@section('content')
    <section class="page-hero"
        style="background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.7)), url('https://images.unsplash.com/photo-1516383740770-fbcc5ccbece0?auto=format&fit=crop&w=1800&q=80'); background-size: cover; background-position: center; background-attachment: fixed; position: relative;">
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
                    <i class="fas fa-envelope"></i>
                </div>
                <div class="page-hero-badge"
                    style="background: rgba(76, 175, 80, 0.8); color: white; border: none; padding: 8px 20px; font-weight: bold; border-radius: 30px; display: inline-block; margin-bottom: 20px;">
                    <i class="fas fa-circle" style="color: #c8e6c9;"></i> Go Green School
                </div>
                <h1 style="color: white; font-size: 3.5rem; font-weight: 800; text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">
                    <span class="highlight" style="color: #a5d6a7; text-shadow: none;">Hubungi</span>&nbsp;Kami
                </h1>
                <div class="page-hero-decor-line" style="background: #a5d6a7; height: 4px; width: 60px; margin: 20px auto;">
                </div>
                <p class="page-hero-desc"
                    style="color: #e0e0e0; font-size: 1.2rem; max-width: 600px; margin: 0 auto 30px; text-shadow: 1px 1px 3px rgba(0,0,0,0.5);">
                    Punya pertanyaan, ide kolaborasi, atau butuh informasi pendaftaran? Jangan ragu untuk menghubungi tim Go
                    Green School.
                </p>
                <div class="page-hero-breadcrumb"
                    style="background: rgba(0,0,0,0.4); padding: 10px 20px; border-radius: 20px; display: inline-flex; gap: 10px;">
                    <a href="{{ route('home') }}" style="color: #a5d6a7; text-decoration: none;"><i class="fas fa-home"></i>
                        Beranda</a>
                    <span class="separator" style="color: #999;"><i class="fas fa-chevron-right"></i></span>
                    <span class="current" style="color: white;">Hubungi Kita</span>
                </div>
            </div>
        </div>
    </section>

    <section class="contact-section contact-modern-section" id="contact">
        <div class="container">
            <div class="contact-modern-shell hover-lift">
                <div class="contact-modern-grid">
                    <div class="contact-modern-intro">
                        <span class="contact-modern-badge"><i class="fas fa-bolt"></i> Form Pintar Go Green School</span>
                        <h2>Sampaikan Pertanyaan Anda Dengan Cepat dan Terstruktur</h2>
                        <p>Form ini sudah disiapkan untuk alur otomatisasi email dan WhatsApp. Anda bisa menulis pesan
                            dengan rich editor agar konteks pertanyaan lebih jelas dan mudah ditindaklanjuti tim kami.</p>

                        <div class="contact-modern-features">
                            <div class="contact-modern-feature"><i class="fas fa-clock"></i><span>Estimasi respons maksimal
                                    1x24 jam kerja.</span></div>
                            <div class="contact-modern-feature"><i class="fas fa-shield-alt"></i><span>Data tersimpan aman
                                    untuk kebutuhan tindak lanjut.</span></div>
                            <div class="contact-modern-feature"><i class="fas fa-envelope-open-text"></i><span>Siap diproses
                                    ke email dengan format rapi.</span></div>
                            <div class="contact-modern-feature"><i class="fab fa-whatsapp"></i><span>Pesan teks otomatis
                                    siap untuk notifikasi WhatsApp.</span></div>
                        </div>
                    </div>

                    <form id="contactForm" class="contact-modern-form" action="{{ route('contact.submit') }}"
                        method="POST">
                        @csrf
                        <h3 style="font-size: 1.35rem; color: var(--dark); margin: 0 0 18px;">Kirim Pesan Langsung</h3>

                        @if (session('success'))
                            <div
                                style="margin-bottom: 14px; padding: 12px 14px; border-radius: 10px; border: 1px solid #bce3c6; background: #ecf9ef; color: #1f6a33; font-size: .92rem;">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div
                                style="margin-bottom: 14px; padding: 12px 14px; border-radius: 10px; border: 1px solid #f1b8b8; background: #fff1f1; color: #9c2c2c; font-size: .92rem;">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div
                                style="margin-bottom: 14px; padding: 12px 14px; border-radius: 10px; border: 1px solid #f1d3a2; background: #fff8ee; color: #8a5a14; font-size: .9rem;">
                                {{ $errors->first() }}
                            </div>
                        @endif

                        <div class="contact-form-row">
                            <div class="contact-form-col">
                                <label for="full_name" class="field-label">Nama Lengkap</label>
                                <input type="text" id="full_name" name="full_name" required
                                    placeholder="Masukkan nama lengkap" class="field-input" value="{{ old('full_name') }}">
                            </div>
                            <div class="contact-form-col">
                                <label for="email" class="field-label">Email Aktif</label>
                                <input type="email" id="email" name="email" required placeholder="contoh@email.com"
                                    class="field-input" value="{{ old('email') }}">
                            </div>
                        </div>

                        <div class="contact-form-row">
                            <div class="contact-form-col">
                                <label for="whatsapp" class="field-label">Nomor WhatsApp</label>
                                <input type="text" id="whatsapp" name="whatsapp" required pattern="(\+62|08)[0-9]{8,13}"
                                    placeholder="+62812xxxxxxx atau 08xxxxxxxxxx" class="field-input"
                                    value="{{ old('whatsapp') }}">
                            </div>
                            <div class="contact-form-col">
                                <label for="preferred_channel" class="field-label">Kanal Balasan</label>
                                <input type="text" id="preferred_channel" name="preferred_channel"
                                    value="{{ old('preferred_channel', 'email & whatsapp') }}" class="field-input"
                                    readonly>
                            </div>
                        </div>

                        <div class="contact-rich-editor" style="margin-bottom: 20px;">
                            <label for="message_editor" class="field-label">Pesan Anda</label>
                            <input id="message_editor_input" type="hidden" name="message_html"
                                value="{{ old('message_html') }}" required>
                            <input id="message_text" type="hidden" name="message_text"
                                value="{{ old('message_text') }}">
                            <input id="message_payload" type="hidden" name="message_payload"
                                value="{{ old('message_payload') }}">
                            <trix-editor id="message_editor" input="message_editor_input"
                                placeholder="Tuliskan pesan Anda dengan detail konteks agar tim kami bisa menindaklanjuti lebih cepat..."></trix-editor>
                            <div class="contact-editor-meta">
                                <span>Tip: gunakan bullet point untuk membuat pesan lebih rapi.</span>
                                <span id="messageCounter">0 karakter</span>
                            </div>
                        </div>

                        <label
                            style="display: flex; gap: 10px; align-items: flex-start; margin-bottom: 18px; color: #475854; font-size: 0.9rem; line-height: 1.45;">
                            <input type="checkbox" id="consent" name="consent" required style="margin-top: 3px;"
                                {{ old('consent') ? 'checked' : '' }}>
                            <span>Saya menyetujui data yang saya isi dipakai untuk proses tindak lanjut pertanyaan melalui
                                email atau WhatsApp.</span>
                        </label>

                        <button type="submit" class="btn-primary"
                            style="width: 100%; border: none; padding: 15px; font-size: 1.05rem; cursor: pointer; border-radius: 10px;">Kirim
                            Pesan Sekarang</button>
                        <p class="contact-submit-note">Form ini sudah siap untuk integrasi backend otomatisasi pengiriman
                            email dan WhatsApp.</p>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="https://unpkg.com/trix@2.1.8/dist/trix.umd.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var form = document.getElementById('contactForm');
            var fullName = document.getElementById('full_name');
            var email = document.getElementById('email');
            var whatsapp = document.getElementById('whatsapp');
            var preferredChannel = document.getElementById('preferred_channel');
            var messageHtml = document.getElementById('message_editor_input');
            var messageText = document.getElementById('message_text');
            var messagePayload = document.getElementById('message_payload');
            var messageCounter = document.getElementById('messageCounter');

            if (!form || !messageHtml || !messageText || !messagePayload || !messageCounter) {
                return;
            }

            var syncTextMessage = function() {
                var wrapper = document.createElement('div');
                wrapper.innerHTML = messageHtml.value;
                messageText.value = (wrapper.textContent || wrapper.innerText || '').trim();

                var characterCount = messageText.value.length;
                messageCounter.textContent = characterCount + ' karakter';
            };

            var syncPayload = function() {
                var payload = {
                    full_name: fullName ? fullName.value.trim() : '',
                    email: email ? email.value.trim() : '',
                    whatsapp: whatsapp ? whatsapp.value.trim() : '',
                    preferred_channel: preferredChannel ? preferredChannel.value : 'email & whatsapp',
                    message_html: messageHtml.value,
                    message_text: messageText.value,
                    submitted_at: new Date().toISOString(),
                    source: 'contact_page'
                };

                messagePayload.value = JSON.stringify(payload);
            };

            form.addEventListener('trix-change', syncTextMessage);
            form.addEventListener('input', syncPayload);
            form.addEventListener('submit', function(event) {
                syncTextMessage();
                syncPayload();

                if (!messageText.value || messageText.value.length < 10) {
                    event.preventDefault();
                    if (typeof showToast === 'function') {
                        showToast('Pesan terlalu pendek', 'Mohon isi pesan minimal 10 karakter.', 'error');
                    }
                    return;
                }
            });

            syncTextMessage();
            syncPayload();
        });
    </script>
@endpush

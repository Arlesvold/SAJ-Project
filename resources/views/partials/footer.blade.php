{{-- Footer --}}
<footer class="footer" id="contact">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-about">
                <div class="logo-footer" style="display: flex; align-items: center; gap: 12px; margin-bottom: 15px;">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo Go Green School"
                        style="height: 50px; width: auto; border-radius: 50%;">
                    <h3 style="margin: 0;">Go Green School</h3>
                </div>
                <p>Menciptakan ekosistem pendidikan yang harmonis dengan alam, mencetak pemimpin masa depan yang
                    proaktif, peduli, dan bertanggung jawab terhadap lingkungan sekitarnya.</p>
                <div class="footer-social">
                    <a href="#" title="YouTube" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                    <a href="#" title="Facebook" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" title="Twitter" aria-label="Twitter"><i class="fab fa-x-twitter"></i></a>
                    <a href="#" title="Instagram" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" title="TikTok" aria-label="TikTok"><i class="fab fa-tiktok"></i></a>
                </div>
            </div>

            <div>
                <h4>Tautan Cepat</h4>
                <ul class="footer-links">
                    <li><a href="#">Beranda</a></li>
                    <li><a href="#programs">Program Lingkungan</a></li>
                    <li><a href="#gallery">Galeri Kegiatan</a></li>
                    <li><a href="#news">Berita & Artikel</a></li>
                    <li><a href="{{ route('contact') }}">Tentang Kami</a></li>
                </ul>
            </div>

            <div>
                <h4>Ikuti Kami</h4>
                <ul class="footer-links">
                    <li><a href="#"><i class="fab fa-facebook-f" style="margin-right: 8px;"></i> Facebook</a></li>
                    <li><a href="#"><i class="fab fa-whatsapp" style="margin-right: 8px;"></i> WhatsApp</a></li>
                    <li><a href="mailto:copilotke1@gmail.com"><i class="fas fa-envelope" style="margin-right: 8px;"></i>
                            Email</a></li>
                </ul>
            </div>

            <div>
                <h4>Kontak Kami</h4>
                <ul class="footer-links footer-contact">
                    <li>
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Jl. Sintang, Kapuas Kanan Hulu, Kec. Sungai Tebelian, Kabupaten Sintang, Kalimantan
                            Barat 78616</span>
                    </li>
                    <li>
                        <i class="fas fa-phone-alt"></i>
                        <span>(+62) 813-4705-3168</span>
                    </li>
                    <li>
                        <i class="fas fa-envelope"></i>
                        <span>copilotke1@gmail.com</span>
                    </li>
                    <li>
                        <i class="far fa-clock"></i>
                        <span>Senin - Jumat: 07.00 - 16.00 WIB</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            &copy; {{ date('Y') }} Go Green School &mdash; Sekolah Hijau untuk Masa Depan. All Rights Reserved.
        </div>
    </div>
</footer>

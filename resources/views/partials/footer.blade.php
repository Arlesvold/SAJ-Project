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
                    <li><a href="https://www.facebook.com/share/1E37QzcgdW/?mibextid=wwXIfr"><i
                                class="fab fa-facebook-f" style="margin-right: 8px;"></i> Facebook</a></li>
                    <li>
                        <a href="https://wa.me/6281545317046?text=Halo%20saya%20ingin%20bertanya" target="_blank">
                            <i class="fab fa-whatsapp" style="margin-right: 8px;"></i> WhatsApp
                        </a>
                    </li>
                    <a href="mailto:adrianrian7449@gmail.com?subject=Pertanyaan&body=Halo%20saya%20ingin%20bertanya">
                        <i class="fas fa-envelope" style="margin-right: 8px;"></i> Email
                    </a>
                    </li>
                </ul>
            </div>

            <div>
                <h4>Kontak Kami</h4>
                <ul class="footer-links footer-contact">
                    <li>
                        <i class="fas fa-map-marker-alt"></i>
                        <a href="https://www.google.com/maps/place/SMK+KARYA+BANGSA+SINTANG/@0.0333023,111.3865185,13z/data=!4m10!1m2!2m1!1sJl.+Sintang,+Kapuas+Kanan+Hulu,+Kec.+Sungai+Tebelian,+Kabupaten+Sintang,+Kalimantan+Barat+78616!3m6!1s0x31fe21fa6473db11:0x7383ddaf507df07c!8m2!3d0.0333036!4d111.4627361!15sCl9KbC4gU2ludGFuZywgS2FwdWFzIEthbmFuIEh1bHUsIEtlYy4gU3VuZ2FpIFRlYmVsaWFuLCBLYWJ1cGF0ZW4gU2ludGFuZywgS2FsaW1hbnRhbiBCYXJhdCA3ODYxNlpbIllqbCBzaW50YW5nIGthcHVhcyBrYW5hbiBodWx1IGtlYyBzdW5nYWkgdGViZWxpYW4ga2FidXBhdGVuIHNpbnRhbmcga2FsaW1hbnRhbiBiYXJhdCA3ODYxNpIBGnZvY2F0aW9uYWxfdHJhaW5pbmdfc2Nob29smgFEQ2k5RFFVbFJRVU52WkVOb2RIbGpSamx2VDJ0YWRGcHFTVFZhYWxwS1lVVmFUVk5ZUW5SVlJFNUZVV3BzVGs1clJSQULgAQD6AQUI4QIQSA!16s%2Fg%2F11mtfdp2wc?entry=ttu&g_ep=EgoyMDI2MDQxNS4wIKXMDSoASAFQAw%3D%3D"
                            target="_blank" rel="noopener noreferrer">
                            <span>Jl. Sintang, Kapuas Kanan Hulu, Kec. Sungai Tebelian, Kabupaten Sintang, Kalimantan
                                Barat 78616</span>
                        </a>
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

{{-- Back To Top --}}
<button class="back-to-top" id="backToTop" aria-label="Back to top">
    <i class="fas fa-chevron-up"></i>
</button>

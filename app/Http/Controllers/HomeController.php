<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the Go Green School landing page.
     */
    public function index(): View
    {
        try {
            $data = $this->getSiteData();
            return view('beranda', $data);
        } catch (\Throwable $e) {
            report($e);
            return view('beranda', $this->getDefaultData());
        }
    }

    /**
     * Get all site data (no database, static data).
     */
    private function getSiteData(): array
    {
        return [
            'slides'      => $this->getSlides(),
            'ecoStats'    => $this->getEcoStats(),
            'programs'    => $this->getPrograms(),
            'envStatus'   => $this->getEnvironmentStatus(),
            'gallery'     => $this->getGallery(),
            'quickAccess' => $this->getQuickAccess(),
            'news'        => $this->getNews(),
            'partners'    => $this->getPartners(),
        ];
    }

    private function getDefaultData(): array
    {
        return [
            'slides'      => [],
            'ecoStats'    => [],
            'programs'    => [],
            'envStatus'   => [],
            'gallery'     => [],
            'quickAccess' => [],
            'news'        => [],
            'partners'    => [],
        ];
    }

    private function getSlides(): array
    {
        return [
            [
                'badge'   => ['icon' => 'fas fa-seedling', 'text' => 'Go Green School 2026'],
                'title'   => 'Forum Edukasi Sekolah',
                'accent'  => 'Berwawasan Lingkungan',
                'desc'    => 'Kami hadir sebagai platform informatif yang menyediakan artikel lengkap, panduan, dan sumber daya bagi guru dan siswa untuk mengembangkan program lingkungan yang efektif dan berdampak.',
                'buttons' => [
                    ['href' => '#programs', 'class' => 'btn-primary', 'icon' => 'fas fa-play-circle', 'text' => 'Lihat Program'],
                    ['href' => '#', 'class' => 'btn-outline', 'icon' => 'fas fa-file-alt', 'text' => 'Unduh Panduan'],
                ],
                'card' => [
                    'title' => 'Pencapaian Tahun Ini',
                    'icon'  => 'fas fa-chart-line',
                    'stats' => [
                        ['icon' => 'fas fa-tree',        'color' => 'rgba(76,175,80,.3)',  'value' => '5.200+',    'label' => 'Pohon Ditanam'],
                        ['icon' => 'fas fa-tint',        'color' => 'rgba(33,150,243,.3)', 'value' => '35%',       'label' => 'Hemat Penggunaan Air'],
                        ['icon' => 'fas fa-solar-panel', 'color' => 'rgba(255,152,0,.3)',  'value' => '1.800 kWh', 'label' => 'Energi Surya Dihasilkan'],
                        ['icon' => 'fas fa-recycle',     'color' => 'rgba(156,39,176,.3)', 'value' => '2.4 Ton',   'label' => 'Sampah Didaur Ulang'],
                    ],
                ],
            ],
            [
                'badge'   => ['icon' => 'fas fa-award', 'text' => 'Penghargaan Adiwiyata'],
                'title'   => 'Panduan Praktis Aksi',
                'accent'  => 'dan Budaya Hijau',
                'desc'    => 'Melalui instruksi langkah demi langkah, ide kreatif, dan edukasi pengelolaan sampah, kami membantu sekolah menerapkan kebiasaan ramah lingkungan sebagai gaya hidup berkelanjutan.',
                'buttons' => [
                    ['href' => '#', 'class' => 'btn-primary', 'icon' => 'fas fa-trophy', 'text' => 'Lihat Prestasi'],
                    ['href' => '#', 'class' => 'btn-outline', 'icon' => 'fas fa-images', 'text' => 'Dokumentasi'],
                ],
                'card' => [
                    'title' => 'Prestasi Adiwiyata',
                    'icon'  => 'fas fa-medal',
                    'stats' => [
                        ['icon' => 'fas fa-award',     'color' => 'rgba(76,175,80,.3)',  'value' => 'Mandiri',    'label' => 'Level Adiwiyata'],
                        ['icon' => 'fas fa-school',    'color' => 'rgba(33,150,243,.3)', 'value' => '12 Sekolah', 'label' => 'Binaan Lingkungan'],
                        ['icon' => 'fas fa-users',     'color' => 'rgba(255,152,0,.3)',  'value' => '3.500+',     'label' => 'Siswa Terlibat'],
                        ['icon' => 'fas fa-handshake', 'color' => 'rgba(156,39,176,.3)', 'value' => '25+',        'label' => 'Mitra Kerjasama'],
                    ],
                ],
            ],
            [
                'badge'   => ['icon' => 'fas fa-recycle', 'text' => 'Zero Waste Campaign'],
                'title'   => 'Transformasi Ekologis',
                'accent'  => 'Ekosistem Pembelajaran',
                'desc'    => 'Kami berkomitmen untuk mengubah sekolah menjadi lingkungan belajar yang tidak hanya unggul secara akademis, tetapi juga memiliki tanggung jawab penuh terhadap keberlanjutan ekologis di masa depan.',
                'buttons' => [
                    ['href' => '#', 'class' => 'btn-primary', 'icon' => 'fas fa-hands-helping', 'text' => 'Ikut Berpartisipasi'],
                    ['href' => '#', 'class' => 'btn-outline', 'icon' => 'fas fa-info-circle', 'text' => 'Pelajari Lebih'],
                ],
                'card' => [
                    'title' => 'Pengurangan Sampah',
                    'icon'  => 'fas fa-trash-alt',
                    'stats' => [
                        ['icon' => 'fas fa-ban',            'color' => 'rgba(76,175,80,.3)',  'value' => 'Zero',       'label' => 'Plastik Sekali Pakai'],
                        ['icon' => 'fas fa-percentage',     'color' => 'rgba(33,150,243,.3)', 'value' => '78%',        'label' => 'Reduksi Sampah'],
                        ['icon' => 'fas fa-dumpster-fire',  'color' => 'rgba(255,152,0,.3)',  'value' => 'Bank Sampah', 'label' => 'Dikelola Siswa'],
                        ['icon' => 'fas fa-leaf',           'color' => 'rgba(156,39,176,.3)', 'value' => 'Kompos',     'label' => 'Dari Sampah Organik'],
                    ],
                ],
            ],
        ];
    }

    private function getEcoStats(): array
    {
        return [
            ['icon' => 'fas fa-tree',        'color' => 'green',  'value' => '5.200+',    'label' => 'Pohon Ditanam'],
            ['icon' => 'fas fa-tint',        'color' => 'blue',   'value' => '35%',       'label' => 'Penghematan Air'],
            ['icon' => 'fas fa-solar-panel', 'color' => 'orange', 'value' => '1.800 kWh', 'label' => 'Energi Terbarukan'],
            ['icon' => 'fas fa-recycle',     'color' => 'purple', 'value' => '2.4 Ton',   'label' => 'Sampah Didaur Ulang'],
        ];
    }

    private function getPrograms(): array
    {
        return [
            [
                'title' => 'Satu Siswa Satu Pohon',
                'category' => 'Penghijauan',
                'desc' => 'Program wajib bagi seluruh siswa baru untuk menanam dan merawat satu pohon selama masa studi mereka di sekolah. Tujuannya adalah menanamkan rasa memiliki dan tanggung jawab terhadap lingkungan sekitar.',
                'schedule' => 'Rutin Tahunan',
                'icon' => 'far fa-calendar-check',
                'image' => 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'tag_bg' => 'var(--primary, #2e7d32)',
            ],
            [
                'title' => 'Bank Sampah Sekolah',
                'category' => 'Daur Ulang',
                'desc' => 'Sistem pengelolaan sampah terpadu dimana siswa dapat menyetorkan sampah anorganik terpilah dan menukarkannya dengan poin yang bisa digunakan untuk membeli buku.',
                'schedule' => 'Setiap Jumat',
                'icon' => 'fas fa-sync-alt',
                'image' => 'https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'tag_bg' => 'var(--accent, #f39c12)',
            ],
            [
                'title' => 'Workshop Eco-Enzyme',
                'category' => 'Edukasi',
                'desc' => 'Pelatihan rutin pembuatan cairan serbaguna pembersih ramah lingkungan dari sisa buah dan sayuran kantin untuk mengurangi volume limbah organik.',
                'schedule' => 'Program Bulanan',
                'icon' => 'fas fa-flask',
                'image' => 'https://images.unsplash.com/photo-1497435334941-8c899ee9e8e9?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'tag_bg' => '#e67e22',
            ],
            [
                'title' => 'Pemanenan Air Hujan',
                'category' => 'Konservasi',
                'desc' => 'Sistem canggih penampungan dan penyaringan air hujan untuk keperluan non-konsumsi, seperti menyiram taman, mencuci kendaraan, dan flushing toilet.',
                'schedule' => 'Infrastruktur Pasif',
                'icon' => 'fas fa-tint',
                'image' => 'https://images.unsplash.com/photo-1518531933037-91b2f5f229cc?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'tag_bg' => '#9b59b6',
            ],
            [
                'title' => 'Kebun Hidroponik & TOGA',
                'category' => 'Edukasi',
                'desc' => 'Pembelajaran life-skill siswa di mana mereka belajar bercocok tanam tanpa tanah (hidroponik) dan merawat Tanaman Obat Keluarga (TOGA).',
                'schedule' => 'Ekstrakurikuler',
                'icon' => 'fas fa-seedling',
                'image' => 'https://images.unsplash.com/photo-1466692476868-aef1dfb1e735?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'tag_bg' => 'var(--primary-dark, #1b5e20)',
            ],
            [
                'title' => 'Taman Vertikal Dinding',
                'category' => 'Penghijauan',
                'desc' => 'Pemanfaatan dinding-dinding kosong di sekitar sekolah untuk dijadikan taman vertikal menggunakan botol plastik bekas sebagai pot tanaman hias dan penyerap polutan.',
                'schedule' => 'Diterapkan Harian',
                'icon' => 'fas fa-leaf',
                'image' => 'https://images.unsplash.com/photo-1534008897995-27a23e859048?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'tag_bg' => 'var(--primary, #2e7d32)',
            ]
        ];
    }

    private function getEnvironmentStatus(): array
    {
        return [
            'main' => [
                'score'      => 92,
                'grade'      => 'A+',
                'airQuality' => 'Baik',
                'desc'       => 'Berdasarkan audit lingkungan bulan Februari 2026, seluruh indikator menunjukkan peningkatan signifikan. Penghijauan meningkat 25%, pengelolaan sampah membaik, dan kualitas udara sekolah berada di level optimal.',
            ],
            'cards' => [
                [
                    'icon'       => 'fas fa-wind',
                    'iconBg'     => '#e8f5e9',
                    'iconColor'  => '#2e7d32',
                    'title'      => 'Kualitas Udara Sekolah',
                    'desc'       => 'PM2.5: 12.8 µg/m³ — Udara bersih dan sehat berkat penghijauan yang masif.',
                    'badge'      => 'Baik',
                    'badgeClass' => 'badge-green',
                ],
                [
                    'icon'       => 'fas fa-tint',
                    'iconBg'     => '#e3f2fd',
                    'iconColor'  => '#1565c0',
                    'title'      => 'Penampungan Air Hujan',
                    'desc'       => 'Kapasitas 85% terisi. Air digunakan untuk menyiram taman dan toilet.',
                    'badge'      => 'Optimal',
                    'badgeClass' => 'badge-blue',
                ],
                [
                    'icon'       => 'fas fa-bolt',
                    'iconBg'     => '#fff3e0',
                    'iconColor'  => '#e65100',
                    'title'      => 'Penggunaan Energi',
                    'desc'       => 'Konsumsi listrik bulan ini turun 20% dibanding bulan lalu berkat panel surya.',
                    'badge'      => 'Hemat',
                    'badgeClass' => 'badge-orange',
                ],
                [
                    'icon'       => 'fas fa-seedling',
                    'iconBg'     => '#e8f5e9',
                    'iconColor'  => '#2e7d32',
                    'title'      => 'Kebun Sekolah',
                    'desc'       => 'Panen sayuran organik minggu ini: kangkung, bayam, dan tomat untuk kantin.',
                    'badge'      => 'Produktif',
                    'badgeClass' => 'badge-green',
                ],
            ],
        ];
    }

    private function getGallery(): array
    {
        return [
            ['image' => 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80', 'title' => 'Aksi Tanam Pohon Baru', 'cat' => 'Penanaman Pohon'],
            ['image' => 'https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80', 'title' => 'Pengolahan Bank Sampah', 'cat' => 'Daur Ulang'],
            ['image' => 'https://images.unsplash.com/photo-1497435334941-8c899ee9e8e9?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80', 'title' => 'Workshop Lingkungan Bebas Plastik', 'cat' => 'Edukasi'],
            ['image' => 'https://images.unsplash.com/photo-1518531933037-91b2f5f229cc?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80', 'title' => 'Sistem Pemanenan Air Hujan', 'cat' => 'Fasilitas'],
            ['image' => 'https://images.unsplash.com/photo-1466692476868-aef1dfb1e735?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80', 'title' => 'Panen Sayur Hidroponik Kantin', 'cat' => 'Edukasi'],
            ['image' => 'https://images.unsplash.com/photo-1611284446314-60a58ac0deb9?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80', 'title' => 'Kerja Bakti Jumat Bersih', 'cat' => 'Kebersihan'],
        ];
    }

    private function getQuickAccess(): array
    {
        return [
            ['icon' => 'fas fa-leaf',        'gradient' => 'linear-gradient(135deg, #2e7d32, #66bb6a)', 'title' => 'Penghijauan',   'desc' => 'Program penanaman pohon & taman sekolah', 'route' => 'programs'],
            ['icon' => 'fas fa-water',       'gradient' => 'linear-gradient(135deg, #1565c0, #42a5f5)', 'title' => 'Konservasi Air', 'desc' => 'Pengelolaan sumber daya air di sekolah', 'route' => 'programs'],
            ['icon' => 'fas fa-solar-panel', 'gradient' => 'linear-gradient(135deg, #e65100, #ff9800)', 'title' => 'Energi Bersih',  'desc' => 'Pemanfaatan energi terbarukan', 'route' => 'procedure'],
            ['icon' => 'fas fa-recycle',     'gradient' => 'linear-gradient(135deg, #6a1b9a, #ab47bc)', 'title' => 'Daur Ulang',     'desc' => 'Program reduce, reuse, recycle', 'route' => 'waste-calculator'],
            ['icon' => 'fas fa-book-open',   'gradient' => 'linear-gradient(135deg, #c62828, #ef5350)', 'title' => 'Edukasi',        'desc' => 'Kurikulum pendidikan lingkungan', 'route' => 'information'],
        ];
    }

    private function getNews(): array
    {
        return [
            'featured' => [
                'image' => 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80',
                'date'  => '10 Maret 2026',
                'title' => 'Sekolah Kami Meraih Penghargaan Adiwiyata Tingkat Nasional 2026',
                'desc'  => 'Penghargaan prestisius ini diraih berkat konsistensi seluruh warga sekolah dalam menerapkan gaya hidup ramah lingkungan dan pengelolaan sampah terpadu yang telah berjalan selama 5 tahun terakhir...',
            ],
            'items' => [
                ['image' => 'https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80', 'date' => '05 Maret 2026', 'title' => 'Pengolahan Sampah Organik Menjadi Kompos Cair untuk Kebun', 'desc' => 'Inovasi terbaru siswa kelas 11 dalam mengolah sampah organik kantin menjadi pupuk kompos cair super.'],
                ['image' => 'https://images.unsplash.com/photo-1497435334941-8c899ee9e8e9?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80', 'date' => '28 Feb 2026', 'title' => 'Workshop Pembuatan Eco-Brick dari Botol Plastik Bekas', 'desc' => 'Kolaborasi dengan komunitas relawan hijau untuk membuat fasilitas tempat duduk dari eco-brick.'],
                ['image' => 'https://images.unsplash.com/photo-1518531933037-91b2f5f229cc?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80', 'date' => '20 Feb 2026', 'title' => 'Sistem Pemanenan Air Hujan Berhasil Menghemat Air 40%', 'desc' => 'Fasilitas baru sekolah terbukti efektif menurunkan tagihan air dan mendukung konservasi air tanah.'],
                ['image' => 'https://images.unsplash.com/photo-1466692476868-aef1dfb1e735?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80', 'date' => '15 Feb 2026', 'title' => 'Panen Perdana Sayuran Organik dari Greenhouse Sekolah', 'desc' => 'Sayuran bebas pestisida hasil kebun hidroponik sekolah mulai disuplai ke kantin sehat.'],
            ],
        ];
    }

    private function getPartners(): array
    {
        return [
            ['icon' => 'fas fa-landmark',       'name' => 'Kementerian LHK'],
            ['icon' => 'fas fa-graduation-cap',  'name' => 'Dinas Pendidikan'],
            ['icon' => 'fas fa-paw',             'name' => 'WWF Indonesia'],
            ['icon' => 'fas fa-globe-asia',      'name' => 'WALHI'],
            ['icon' => 'fas fa-bolt',            'name' => 'PLN Green'],
            ['icon' => 'fas fa-hands-helping',   'name' => 'Komunitas Peduli Lingkungan'],
        ];
    }
}

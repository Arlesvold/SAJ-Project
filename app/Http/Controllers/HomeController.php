<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
            return view('home', $data);
        } catch (\Throwable $e) {
            report($e);
            return view('home', $this->getDefaultData());
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
                'title'   => 'Membangun Generasi',
                'accent'  => 'Peduli Lingkungan',
                'desc'    => 'Program sekolah hijau yang mengintegrasikan pendidikan lingkungan ke dalam kurikulum sekolah untuk menciptakan generasi yang bertanggung jawab terhadap kelestarian bumi.',
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
                'title'   => 'Raih Penghargaan',
                'accent'  => 'Adiwiyata Mandiri 2026',
                'desc'    => 'Sekolah kami berhasil meraih penghargaan tertinggi Adiwiyata Mandiri dari Kementerian Lingkungan Hidup dan Kehutanan atas komitmen dalam pengelolaan lingkungan sekolah.',
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
                'title'   => 'Menuju Sekolah',
                'accent'  => 'Tanpa Sampah',
                'desc'    => 'Kampanye pengurangan sampah plastik dan penerapan prinsip 3R (Reduce, Reuse, Recycle) di seluruh lingkungan sekolah demi masa depan bumi yang lebih bersih.',
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
                        ['icon' => 'fas fa-dumpster-fire',  'color' => 'rgba(255,152,0,.3)',  'value' => 'Bank Sampah','label' => 'Dikelola Siswa'],
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
                'category' => 'penghijauan',
                'image'    => 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?w=600&q=80',
                'tag'      => 'Penghijauan',
                'title'    => 'Program Seribu Pohon untuk Sekolah',
                'desc'     => 'Penanaman pohon di lingkungan sekolah dan sekitarnya untuk meningkatkan kualitas udara dan menciptakan ruang hijau.',
                'date'     => '15 Februari 2026',
            ],
            [
                'category' => 'daur ulang',
                'image'    => 'https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?w=600&q=80',
                'tag'      => 'Daur Ulang',
                'title'    => 'Bank Sampah Sekolah: Kelola Limbah Jadi Berkah',
                'desc'     => 'Program pengelolaan sampah yang melibatkan seluruh siswa dalam memilah, mengumpulkan, dan mendaur ulang sampah.',
                'date'     => '10 Februari 2026',
            ],
            [
                'category' => 'energi',
                'image'    => 'https://images.unsplash.com/photo-1509391366360-2e959784a276?w=600&q=80',
                'tag'      => 'Energi',
                'title'    => 'Panel Surya di Atap Sekolah',
                'desc'     => 'Pemanfaatan energi surya melalui pemasangan panel surya untuk kebutuhan listrik sekolah sebagai upaya energi terbarukan.',
                'date'     => '5 Februari 2026',
            ],
            [
                'category' => 'edukasi',
                'image'    => 'https://images.unsplash.com/photo-1594818379496-da1e345b0ded?w=600&q=80',
                'tag'      => 'Edukasi',
                'title'    => 'Kurikulum Hijau: Belajar Sambil Menjaga Bumi',
                'desc'     => 'Integrasi pendidikan lingkungan hidup ke dalam mata pelajaran untuk membentuk karakter siswa yang peduli lingkungan.',
                'date'     => '1 Februari 2026',
            ],
            [
                'category' => 'penghijauan',
                'image'    => 'https://images.unsplash.com/photo-1501004318855-b174af8a8ade?w=600&q=80',
                'tag'      => 'Penghijauan',
                'title'    => 'Taman Edukasi & Greenhouse Sekolah',
                'desc'     => 'Pembangunan taman edukasi dan rumah kaca untuk praktik langsung siswa dalam mempelajari ekosistem dan pertanian organik.',
                'date'     => '28 Januari 2026',
            ],
            [
                'category' => 'daur ulang',
                'image'    => 'https://images.unsplash.com/photo-1581578731548-c64695cc6952?w=600&q=80',
                'tag'      => 'Daur Ulang',
                'title'    => 'Komposting: Ubah Sampah Jadi Pupuk',
                'desc'     => 'Pelatihan pembuatan kompos dari sampah organik dapur kantin dan daun-daun kering di lingkungan sekolah.',
                'date'     => '20 Januari 2026',
            ],
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
            ['image' => 'https://images.unsplash.com/photo-1466692476868-aef1dfb1e735?w=600&q=80', 'title' => 'Penanaman Pohon Bersama', 'date' => '15 Februari 2026'],
            ['image' => 'https://images.unsplash.com/photo-1567306226416-28f0efdc88ce?w=600&q=80', 'title' => 'Panen Kebun Sekolah',     'date' => '10 Februari 2026'],
            ['image' => 'https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?w=600&q=80', 'title' => 'Workshop Daur Ulang',      'date' => '5 Februari 2026'],
            ['image' => 'https://images.unsplash.com/photo-1497435334941-8c899ee9e8e9?w=600&q=80', 'title' => 'Taman Kupu-Kupu',          'date' => '1 Februari 2026'],
            ['image' => 'https://images.unsplash.com/photo-1509391366360-2e959784a276?w=600&q=80', 'title' => 'Instalasi Panel Surya',     'date' => '28 Januari 2026'],
            ['image' => 'https://images.unsplash.com/photo-1518531933037-91b2f5f229cc?w=600&q=80', 'title' => 'Edukasi Lingkungan Outdoor','date' => '20 Januari 2026'],
        ];
    }

    private function getQuickAccess(): array
    {
        return [
            ['icon' => 'fas fa-leaf',        'gradient' => 'linear-gradient(135deg, #2e7d32, #66bb6a)', 'title' => 'Penghijauan',     'desc' => 'Program penanaman pohon & taman sekolah'],
            ['icon' => 'fas fa-water',       'gradient' => 'linear-gradient(135deg, #1565c0, #42a5f5)', 'title' => 'Konservasi Air',   'desc' => 'Pengelolaan sumber daya air di sekolah'],
            ['icon' => 'fas fa-solar-panel', 'gradient' => 'linear-gradient(135deg, #e65100, #ff9800)', 'title' => 'Energi Bersih',    'desc' => 'Pemanfaatan energi terbarukan'],
            ['icon' => 'fas fa-recycle',     'gradient' => 'linear-gradient(135deg, #6a1b9a, #ab47bc)', 'title' => 'Daur Ulang',       'desc' => 'Program reduce, reuse, recycle'],
            ['icon' => 'fas fa-book-open',   'gradient' => 'linear-gradient(135deg, #c62828, #ef5350)', 'title' => 'Edukasi',          'desc' => 'Kurikulum pendidikan lingkungan'],
        ];
    }

    private function getNews(): array
    {
        return [
            'featured' => [
                'image' => 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?w=800&q=80',
                'date'  => '28 Februari 2026',
                'title' => 'Go Green School Raih Penghargaan Sekolah Adiwiyata Mandiri Tingkat Nasional',
                'desc'  => 'Sekolah kami berhasil meraih penghargaan tertinggi dari Kementerian Lingkungan Hidup atas komitmen dalam pengelolaan lingkungan sekolah yang berkelanjutan.',
            ],
            'items' => [
                ['image' => 'https://images.unsplash.com/photo-1466692476868-aef1dfb1e735?w=300&q=80', 'date' => '25 Februari 2026', 'title' => '1.000 Pohon Baru Ditanam di Area Sekolah dan Desa Sekitar', 'desc' => 'Kegiatan penanaman melibatkan siswa, guru, dan masyarakat sekitar.'],
                ['image' => 'https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?w=300&q=80', 'date' => '20 Februari 2026', 'title' => 'Bank Sampah Sekolah Hasilkan Pendapatan Rp 5 Juta Per Bulan', 'desc' => 'Dana digunakan untuk biaya operasional program lingkungan sekolah.'],
                ['image' => 'https://images.unsplash.com/photo-1509391366360-2e959784a276?w=300&q=80', 'date' => '15 Februari 2026', 'title' => 'Pemasangan Panel Surya Fase 2 Berhasil Menghemat 40% Listrik', 'desc' => 'Sekolah mengurangi ketergantungan pada energi fosil secara signifikan.'],
                ['image' => 'https://images.unsplash.com/photo-1518531933037-91b2f5f229cc?w=300&q=80', 'date' => '10 Februari 2026', 'title' => 'Workshop Edukasi Lingkungan Diikuti 500 Siswa dari 12 Sekolah', 'desc' => 'Siswa belajar tentang pengelolaan sampah dan konservasi energi.'],
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

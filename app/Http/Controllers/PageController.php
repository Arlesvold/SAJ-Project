<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PageController extends Controller
{
    public function programs(): View
    {
        return view('pages.programs');
    }

    public function gallery(): View
    {
        return view('pages.gallery');
    }

    public function news(Request $request): View
    {
        try {
            $validator = Validator::make($request->query(), [
                'page' => ['nullable', 'integer', 'min:1'],
                'tag' => ['nullable', 'string', 'max:50'],
                'tags' => ['nullable', 'string', 'max:255'],
                'q' => ['nullable', 'string', 'max:100'],
            ]);

            $validated = $validator->fails() ? [] : $validator->validated();

            $selectedTags = $this->extractSelectedTags(
                trim((string) ($validated['tags'] ?? '')),
                trim((string) ($validated['tag'] ?? ''))
            );
            $selectedTagLookup = array_map(static fn(string $tag): string => Str::lower($tag), $selectedTags);
            $search = trim((string) ($validated['q'] ?? ''));

            $allArticles = $this->getNewsArticles();
            $tagCounts = $this->buildTagCounts($allArticles);

            $filteredArticles = array_values(array_filter($allArticles, function (array $article) use ($selectedTagLookup, $search): bool {
                if ($selectedTagLookup !== []) {
                    $articleTags = array_map(static fn(string $tag): string => Str::lower($tag), $article['tags']);

                    if (array_intersect($articleTags, $selectedTagLookup) === []) {
                        return false;
                    }
                }

                if ($search !== '') {
                    $haystack = Str::lower(implode(' ', [
                        $article['title'],
                        $article['excerpt'],
                        $article['full_description'],
                    ]));

                    if (!Str::contains($haystack, Str::lower($search))) {
                        return false;
                    }
                }

                return true;
            }));

            $featuredArticle = null;
            if ($filteredArticles !== []) {
                // Rotasi featured card agar artikel besar tidak selalu item yang sama.
                $rotationSeed = now()->dayOfYear;
                $featuredIndex = $rotationSeed % count($filteredArticles);
                $featuredArticle = $filteredArticles[$featuredIndex];
            }

            $articlePool = $featuredArticle === null
                ? $filteredArticles
                : array_values(array_filter(
                    $filteredArticles,
                    static fn(array $article): bool => $article['id'] !== $featuredArticle['id']
                ));

            $perPage = 4;
            $total = count($articlePool);
            $lastPage = max(1, (int) ceil($total / $perPage));
            $currentPage = min(max(1, (int) ($validated['page'] ?? 1)), $lastPage);
            $offset = ($currentPage - 1) * $perPage;
            $itemsForCurrentPage = array_slice($articlePool, $offset, $perPage);

            $paginatedArticles = new LengthAwarePaginator(
                $itemsForCurrentPage,
                $total,
                $perPage,
                $currentPage,
                [
                    'path' => route('news'),
                    'query' => $this->buildNewsQuery($selectedTags, $search),
                ]
            );

            return view('pages.news', [
                'featuredArticle' => $featuredArticle,
                'featuredPool' => $filteredArticles,
                'paginatedArticles' => $paginatedArticles,
                'tagCounts' => $tagCounts,
                'selectedTags' => $selectedTags,
                'search' => $search,
            ]);
        } catch (\Throwable $e) {
            report($e);

            return view('pages.news', [
                'featuredArticle' => null,
                'featuredPool' => [],
                'paginatedArticles' => new LengthAwarePaginator([], 0, 4, 1, ['path' => route('news')]),
                'tagCounts' => [],
                'selectedTags' => [],
                'search' => '',
            ]);
        }
    }

    public function information(): View
    {
        return view('pages.information');
    }

    public function contact(): View
    {
        return view('pages.contact');
    }

    public function wasteCalculator(): View
    {
        return view('pages.waste-calculator');
    }

    public function procedure(): View
    {
        return view('pages.procedure');
    }

    public function developerProfile(): View
    {
        try {
            return view('pages.developer-profile', [
                'projectMeta' => $this->getDeveloperProjectMeta(),
                'developers' => $this->getDeveloperProfiles(),
            ]);
        } catch (\Throwable $e) {
            report($e);

            return view('pages.developer-profile', [
                'projectMeta' => [
                    'project' => 'Go Green School',
                    'year' => (string) now()->year,
                    'stack' => 'Laravel + Blade + JavaScript',
                    'school' => 'SMK Karya Bangsa Sintang',
                ],
                'developers' => [],
            ]);
        }
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    private function getNewsArticles(): array
    {
        return [
            [
                'id' => 1,
                'title' => 'Sekolah Kami Meraih Penghargaan Adiwiyata Tingkat Nasional 2026',
                'date' => '10 Maret 2026',
                'author' => 'Admin GGS',
                'category' => 'Prestasi',
                'image' => 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80',
                'excerpt' => 'Penghargaan prestisius ini diraih berkat konsistensi seluruh warga sekolah dalam menerapkan gaya hidup ramah lingkungan selama lima tahun terakhir.',
                'full_description' => 'Penghargaan Adiwiyata Tingkat Nasional 2026 diraih setelah proses penilaian yang mencakup pengelolaan sampah, konservasi air, efisiensi energi, dan partisipasi aktif warga sekolah. Program yang dijalankan tidak hanya bersifat seremonial, tetapi terintegrasi ke kurikulum, kegiatan ekstrakurikuler, dan budaya harian sekolah. Tim penilai menyoroti konsistensi implementasi, keterlibatan siswa sebagai duta lingkungan, serta inovasi bank sampah digital yang memudahkan pelacakan kontribusi setiap kelas.',
                'tags' => ['Adiwiyata', 'Prestasi', 'Program Hijau'],
            ],
            [
                'id' => 2,
                'title' => 'Gerakan 1000 Botol Plastik Disulap Menjadi Kursi Ecobrick',
                'date' => '05 Maret 2026',
                'author' => 'Tim Ekstrakurikuler',
                'category' => 'Program Hijau',
                'image' => 'https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'excerpt' => 'Melalui kolaborasi lintas kelas, siswa berhasil mengolah 1000 botol plastik menjadi kursi ecobrick untuk area baca terbuka.',
                'full_description' => 'Gerakan ini menjadi contoh nyata bagaimana sampah plastik dapat diubah menjadi fasilitas yang bermanfaat. Selama tiga minggu, siswa mengumpulkan botol, memilah plastik lunak, lalu memadatkannya menjadi ecobrick dengan standar kepadatan tertentu. Hasil akhirnya adalah 24 kursi ecobrick yang ditempatkan di taman literasi. Selain menekan volume sampah plastik, program ini juga menumbuhkan keterampilan kolaborasi, perencanaan proyek, dan tanggung jawab sosial lingkungan.',
                'tags' => ['Ecobrick', 'DaurUlang', 'GoGreen'],
            ],
            [
                'id' => 3,
                'title' => 'Edukasi: Keajaiban Eco-Enzyme bagi Tanah Tanam',
                'date' => '28 Feb 2026',
                'author' => 'Guru Biologi',
                'category' => 'Edukasi',
                'image' => 'https://images.unsplash.com/photo-1497435334941-8c899ee9e8e9?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'excerpt' => 'Workshop eco-enzyme memperlihatkan dampak positif pemanfaatan limbah organik dapur untuk meningkatkan kesuburan media tanam.',
                'full_description' => 'Pada sesi edukasi ini, siswa mempelajari proses fermentasi limbah organik menjadi eco-enzyme dan cara aplikasinya pada kebun sekolah. Pengamatan selama satu bulan menunjukkan pertumbuhan tanaman lebih stabil, kualitas daun lebih baik, dan kebutuhan pupuk kimia berkurang. Kegiatan ini juga menanamkan pemahaman sains terapan karena siswa melakukan pengukuran pH, mencatat hasil observasi, dan mempresentasikan temuan dalam format laporan ilmiah sederhana.',
                'tags' => ['Edukasi', 'EcoEnzyme', 'Hidroponik'],
            ],
            [
                'id' => 4,
                'title' => 'Siswa Kelas X Kreasikan Sampah Kertas Menjadi Kesenian',
                'date' => '20 Feb 2026',
                'author' => 'Pembina Seni',
                'category' => 'Kegiatan',
                'image' => 'https://images.unsplash.com/photo-1518531933037-91b2f5f229cc?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'excerpt' => 'Proyek seni daur ulang menghadirkan karya instalasi berbahan kertas bekas dari ruang kelas dan perpustakaan.',
                'full_description' => 'Siswa kelas X memadukan kreativitas seni dengan nilai keberlanjutan melalui proyek instalasi kertas daur ulang. Proses dimulai dari pengumpulan kertas tidak terpakai, pembuatan pulp sederhana, hingga pembentukan panel karya. Kegiatan ini memberi pengalaman langsung tentang ekonomi sirkular sekaligus memperkuat kemampuan berpikir kreatif. Karya terbaik dipamerkan saat pekan lingkungan sekolah dan mendapat apresiasi tinggi dari orang tua serta masyarakat sekitar.',
                'tags' => ['DaurUlang', 'Kegiatan', 'GoGreen'],
            ],
            [
                'id' => 5,
                'title' => 'Panen Perdana Kebun Hidroponik Kantin Sekolah',
                'date' => '15 Feb 2026',
                'author' => 'Tim Kantin Sehat',
                'category' => 'Program Hijau',
                'image' => 'https://images.unsplash.com/photo-1466692476868-aef1dfb1e735?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'excerpt' => 'Panen perdana selada dan pakcoy dari kebun hidroponik dimanfaatkan langsung sebagai bahan baku menu kantin sehat.',
                'full_description' => 'Kebun hidroponik sekolah yang dikelola siswa dan guru berhasil memasuki masa panen perdana dengan hasil yang memuaskan. Selain memasok kebutuhan kantin sehat, proyek ini dipakai sebagai laboratorium pembelajaran lintas mata pelajaran, mulai dari biologi, kewirausahaan, hingga matematika untuk menghitung efisiensi produksi. Program hidroponik juga menjadi sarana edukasi tentang ketahanan pangan lokal dan konsumsi pangan berkelanjutan di lingkungan sekolah.',
                'tags' => ['Hidroponik', 'Program Hijau', 'Edukasi'],
            ],
            [
                'id' => 6,
                'title' => 'Kampanye Bebas Plastik Sekali Pakai Dimulai dari Kantin',
                'date' => '10 Feb 2026',
                'author' => 'OSIS Go Green',
                'category' => 'Pengumuman',
                'image' => 'https://images.unsplash.com/photo-1611284446314-60a58ac0deb9?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'excerpt' => 'Sekolah resmi menerapkan kebijakan membawa wadah dan tumbler pribadi untuk mengurangi sampah kemasan harian.',
                'full_description' => 'Kebijakan bebas plastik sekali pakai mulai diberlakukan di kantin dengan dukungan kampanye edukatif selama dua pekan awal. Siswa membawa wadah makan dan botol minum sendiri, sementara kantin menyediakan opsi isi ulang minuman. Dalam evaluasi awal, volume sampah plastik harian turun signifikan. Program ini dilengkapi sistem poin kelas hijau untuk mendorong partisipasi kolektif dan membangun kebiasaan ramah lingkungan secara berkelanjutan.',
                'tags' => ['BebasPlastik', 'Pengumuman', 'GoGreen'],
            ],
            [
                'id' => 7,
                'title' => 'Pelatihan Audit Energi Kelas untuk Hemat Listrik',
                'date' => '01 Feb 2026',
                'author' => 'Koordinator Sarpras',
                'category' => 'Edukasi',
                'image' => 'https://images.unsplash.com/photo-1473341304170-971dccb5ac1e?auto=format&fit=crop&w=800&q=80',
                'excerpt' => 'Perwakilan tiap kelas dilatih melakukan audit energi sederhana guna menekan pemborosan listrik di ruang belajar.',
                'full_description' => 'Pelatihan audit energi kelas memperkenalkan siswa pada teknik identifikasi titik pemborosan listrik, mulai dari kebiasaan menyalakan perangkat tanpa kebutuhan hingga pengaturan pencahayaan alami. Setelah pelatihan, setiap kelas membuat rencana aksi hemat energi dan memantau hasilnya selama empat minggu. Hasil sementara menunjukkan penurunan konsumsi listrik yang konsisten, sekaligus meningkatkan literasi siswa tentang dampak energi terhadap lingkungan.',
                'tags' => ['Edukasi', 'Energi', 'GoGreen'],
            ],
            [
                'id' => 8,
                'title' => 'Kolaborasi Orang Tua dan Sekolah dalam Gerakan Kompos Rumah',
                'date' => '25 Jan 2026',
                'author' => 'Komite Sekolah',
                'category' => 'Kegiatan',
                'image' => 'https://images.unsplash.com/photo-1472396961693-142e6e269027?auto=format&fit=crop&w=800&q=80',
                'excerpt' => 'Program kompos rumah melibatkan keluarga siswa untuk mengolah sampah organik dan menyumbangkannya ke kebun sekolah.',
                'full_description' => 'Melalui program kompos rumah, orang tua siswa berperan aktif dalam mengelola sampah organik keluarga menggunakan metode sederhana yang mudah diterapkan. Kompos yang dihasilkan kemudian dikumpulkan pada akhir pekan untuk kebutuhan kebun sekolah. Inisiatif ini memperluas dampak pendidikan lingkungan dari sekolah ke rumah, memperkuat kolaborasi antara wali murid, siswa, dan guru dalam mewujudkan kebiasaan berkelanjutan.',
                'tags' => ['Kegiatan', 'Kompos', 'GoGreen'],
            ],
        ];
    }

    /**
     * @param array<int, array<string, mixed>> $articles
     * @return array<string, int>
     */
    private function buildTagCounts(array $articles): array
    {
        $counts = [];

        foreach ($articles as $article) {
            foreach ($article['tags'] as $tag) {
                $counts[$tag] = ($counts[$tag] ?? 0) + 1;
            }
        }

        arsort($counts);

        return $counts;
    }

    /**
     * @return array<int, string>
     */
    private function extractSelectedTags(string $tagsParam, string $legacyTag): array
    {
        $rawTags = [];

        if ($tagsParam !== '') {
            $rawTags = array_merge($rawTags, explode(',', $tagsParam));
        }

        if ($legacyTag !== '') {
            $rawTags[] = $legacyTag;
        }

        $uniqueTags = [];
        foreach ($rawTags as $rawTag) {
            $normalizedTag = trim(str_replace('#', '', (string) $rawTag));
            if ($normalizedTag === '') {
                continue;
            }

            $key = Str::lower($normalizedTag);
            $uniqueTags[$key] = $normalizedTag;
        }

        return array_values($uniqueTags);
    }

    /**
     * @param array<int, string> $selectedTags
     * @return array<string, string>
     */
    private function buildNewsQuery(array $selectedTags, string $search): array
    {
        return array_filter([
            'tags' => $selectedTags !== [] ? implode(',', $selectedTags) : null,
            'q' => $search !== '' ? $search : null,
        ]);
    }

    /**
     * @return array<string, string>
     */
    private function getDeveloperProjectMeta(): array
    {
        return [
            'project' => 'Go Green School',
            'year' => '2026',
            'stack' => 'Laravel 11, PHP, Blade, CSS, JavaScript, Laragon',
            'school' => 'SMK Karya Bangsa Sintang',
        ];
    }

    /**
     * @return array<int, array<string, string>>
     */
    private function getDeveloperProfiles(): array
    {
        return [
            // Atur zoom foto per developer: 1 = normal, >1 zoom in, <1 zoom out.
            [
                'name' => 'Charles Adrian',
                'age' => '17 tahun',
                'class' => 'XII RPL',
                'school' => 'SMK Karya Bangsa Sintang',
                'role' => 'Fullstack Developer',
                'focus' => 'Responsive layout, Logika web, Integrasi API',
                'contribution' => 'Arsitektur halaman, membangun logika web, integrasi API Whatsapp dan Email.',
                'year' => '27 Oktober 2008',
                'email' => 'adrianrian7449@gmail.com',
                'photo' => asset('images/charles.png'),
                'photo_zoom' => '1.15',
            ],
            [
                'name' => 'Calya De’prila Maheswari ',
                'age' => '17 tahun',
                'class' => 'XII RPL',
                'school' => 'SMK Karya Bangsa Sintang',
                'role' => 'Frontend Developer',
                'focus' => 'Isi konten, pengujian fitur',
                'contribution' => 'Memberikan isi/konten web, pengelolaan data JSON, pengujian fitur.',
                'year' => '19 Juli 2008',
                'email' => 'calyadeprilamaheswari@karyabangsa.sch.id',
                'photo' => asset('images/calya.png'),
                'photo_zoom' => '1.15',
            ],
            [
                'name' => 'Lingga Arkananta M.',
                'age' => '18 tahun',
                'class' => 'XII RPL',
                'school' => 'SMK Karya Bangsa Sintang',
                'role' => 'Fullstack Developer',
                'focus' => 'Merancang tampilan awal, performa, logika web',
                'contribution' => 'Merancang tampilan awal, membangun logika web, optimasi performa.',
                'year' => '7 Oktober 2008',
                'email' => 'lingga@karyabangsa.sch.id',
                'photo' => asset('images/lingga.png'),
                'photo_zoom' => '1.15',
            ],
            [
                'name' => 'Ignasius Agri',
                'age' => '17 tahun',
                'class' => 'XII RPL',
                'school' => 'SMK Karya Bangsa Sintang',
                'role' => 'Frontend Developer',
                'focus' => 'Uji fitur, isi/konten, dan aksesibilitas antarmuka',
                'contribution' => 'Memberikan isi/konten web, memastikan kualitas pengalaman pengguna serta ketepatan konten.',
                'year' => '10 Mei 2008',
                'email' => 'ignasiusagri@karyabangsa.sch.id',
                'photo' => asset('images/agri.png'),
                'photo_zoom' => '1.15',
            ],
        ];
    }
}

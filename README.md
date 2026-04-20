<p align="center">
  <img src="public/images/logo.png" width="300" alt="Go Green School Logo">
</p>

<h1 align="center">Go Green School</h1>
<p align="center">
  Sistem Manajemen Sekolah Berwawasan Lingkungan - Web Interaktif & Kalkulator Sampah
</p>

---

## 👥 Pembagian Tugas Tim

Berikut adalah rincian pembagian tugas untuk masing-masing anggota tim dalam proyek **Go Green School**:

- **Lingga Arkananta Mahardika**
    - Bertanggung jawab dalam pembuatan website, meliputi perancangan awal tampilan dan pengembangan fitur-fitur web.
    - Mengisi konten pada bagian _explanation text_.
    - Membuat poster Go Green School untuk mata pelajaran Digital Marketing.

- **Charles Adrian**
    - Bertanggung jawab dalam pembuatan website, termasuk merancang arsitektur halaman web, membangun logika sistem, dan melakukan integrasi API WhatsApp serta email.
    - Mengembangkan fitur-fitur web dan mengisi konten pada bagian _procedure text_.
    - Turut membantu dalam pembuatan poster Go Green School untuk mata pelajaran Digital Marketing dan Bahasa Indonesia.

- **Calya De’prila Maheswari**
    - Bertanggung jawab dalam pengisian konten website pada bagian _information about the website_ serta melakukan pengujian fitur-fitur web.
    - Menangani promosi website, termasuk pembuatan dan pengeditan video promosi.
    - Mengelola akun media sosial (Facebook) untuk keperluan promosi.

- **Ignasius Agri**
    - Bertanggung jawab dalam pengisian konten website pada bagian _description text_.
    - Melakukan pengujian fitur-fitur web.
    - Membuat poster Go Green School untuk mata pelajaran Bahasa Indonesia.

## ✨ Fitur & Halaman yang Dikembangkan

Berikut adalah rincian halaman dan fitur yang dibuat oleh masing-masing anggota tim:

**1. Lingga Arkananta Mahardika**
Bertanggung jawab dalam pengembangan beberapa halaman dan fitur utama, meliputi:

- 🏠 Pembuatan halaman Beranda
- 🧮 Pembuatan halaman Kalkulator Sampah
- 🌙 Implementasi fitur Dark Mode
- 🌐 Berkontribusi dalam pembuatan fitur Toggle Language
- 🎨 Mendesain antarmuka yang user-friendly

**2. Charles Adrian**
Bertanggung jawab dalam pengembangan berbagai halaman pada website, meliputi:

- 🏠 Halaman Beranda
- ℹ️ Halaman Informasi
- 🎯 Halaman Program
- 📸 Halaman Galeri
- 📰 Halaman Berita
- 📋 Halaman Prosedur
- 📞 Halaman Kontak
- 👨‍💻 Halaman Developer
- 🧮 Halaman Kalkulator Sampah
- 🌐 Berkontribusi dalam pembuatan fitur Toggle Language

**3. Calya De’prila Maheswari**
Bertanggung jawab dalam:

- 📝 Pengisian konten website pada halaman Beranda

**4. Ignasius Agri**
Bertanggung jawab dalam:

- 📝 Pengisian konten website pada halaman Beranda
- ℹ️ Pengisian konten pada halaman Informasi

## 🌍 Website Live (Online)

Proyek **Go Green School** ini sudah dapat diakses dan digunakan secara langsung melalui internet pada tautan berikut:

📍 **[Kunjungi Website Go Green School](https://saj-project-main-bpry3o.free.laravel.cloud/)**

Dengan mengakses tautan di atas, Anda dapat mencoba secara langsung berbagai fitur yang telah kami kembangkan, mulai dari melihat informasi seputar program sekolah hijau, galeri kegiatan ekologis, mencari prosedur daur ulang, hingga mencoba fitur interaktif seperti **Kalkulator Sampah**.

## 🧮 Cara Kerja Kalkulator Sampah (Waste Calculator)

Salah satu fitur unggulan yang interaktif dalam website ini adalah **Kalkulator Sampah**. Fitur ini dirancang khusus untuk mengedukasi siswa dan warga sekolah dalam memantau, menganalisis, serta memprediksi volume sampah harian hingga bulanan di kelas masing-masing. Berikut adalah alur dan cara kerja kalkulator yang informatif dan menarik ini:

### 1️⃣ Input Data Sampah Kelas

Pengguna (misalnya perwakilan kelas atau regu piket) diminta untuk memasukkan laporan data berat sampah yang terkumpul. Variabel input yang harus diisi meliputi:

- **Nama Kelas:** Identitas kelas yang melapor (contoh: "X MIPA 1").
- **Jumlah Hari:** Durasi pengumpulan sampah yang dilaporkan (berapa hari data ini direkam).
- **Kategori Sampah (dalam kilogram):**
    - 🥬 **Organik:** Sisa makanan, kulit buah, atau dedaunan.
    - 📦 **Anorganik:** Kertas, kardus, kaca, dan logam.
    - 🥤 **Plastik:** Botol minum plastik, kantong kresek, dan bungkus makanan ringan.

### 2️⃣ Proses Kalkulasi & Prediksi Masa Depan

Setelah pengguna menekan tombol **"Hitung Sampah"**, sistem di belakang layar akan langsung memproses data tersebut dalam hitungan detik:

- Menghitung **Total Sampah Keseluruhan** (Organik + Anorganik + Plastik).
- Membuat **Prediksi Produksi Sampah 30 Hari**. Sistem akan menghitung rata-rata harian (Total Sampah ÷ Jumlah Hari), lalu mengalikannya dengan 30. Hal ini berguna untuk menyadarkan siswa tentang _seberapa besar penumpukan sampah yang akan terjadi selama sebulan jika kebiasaan mereka tidak diubah._

### 3️⃣ Visualisasi Data Interaktif dengan Grafik

Untuk memberikan pengalaman yang menyenangkan (_user-friendly_) dan mudah dipahami, hasil perhitungan disajikan dalam tiga _dashboard_ visual (_Interactive Charts_):

- 🍩 **Grafik Komposisi (Doughnut Chart):** Memperlihatkan persentase komposisi sampah. Membantu melihat sampah tipe apa yang paling dominan di kelas tersebut.
- 📊 **Grafik Perbandingan Tipe (Bar Chart):** Menampilkan perbandingan berat aktual dari masing-masing kategori sampah.
- 📈 **Grafik Tren Prediksi (Line Chart):** Memvisualisasikan perbandingan grafik antara total sampah riil yang ada saat ini dengan lonjakan prediksi timbulan sampah dalam satu bulan ke depan.

### 4️⃣ Penyimpanan History Otomatis & Analisis Lanjutan

Website ini memegang teguh prinsip sederhana namun _powerful_. Seluruh hasil kalkulasi dari kalkulator sampah tidak akan hilang karena disimpan secara otomatis menggunakan teknologi penyimpanan file lokal bawaan Laravel (berbasis `JSON`) tanpa bergantung pada sistem _Database_ konvensional. Fitur manajemen datanya mencakup:

- **Tabel Riwayat (_History Table_):** Melacak jejak riwayat input secara transparan (Waktu lapor, nama kelas, rincian, dan hasil akhir).
- **Fitur Hapus (_Delete & Bulk Delete_):** Memudahkan penghapusan satu atau banyak data riwayat sekaligus jika ada kesalahan.
- **Bisa Diekspor! (Export to CSV):** Memungkinkan wali kelas atau OSIS untuk mendownload/mengunduh seluruh riwayat rekapan sampah menjadi file _Excel (CSV)_ untuk keperluan laporan akhir semester atau penilaian lomba kebersihan antar kelas.

## 🖼️ Dokumentasi Poster

Berikut adalah beberapa hasil karya proyek kami berupa poster edukasi lingkungan dan desain website:

> **Poster Edukasi - Teks Eksplanasi** (Bahasa Indonesia)  
> <img src="public/images/Poster%20Go%20Green%20School%20Kelompok%203%20-%20Bahasa%20Indonesia.jpg" width="600" alt="Poster Teks Eksplanasi">

> **Poster Edukasi - Teks Prosedur** (Bahasa Indonesia)  
> <img src="public/images/Poster%20Go%20Green%20School%20Kelompok%203%20-%20Bahasa%20Indonesia%20(2).jpg" width="600" alt="Poster Teks Prosedur">

> **Poster Tampilan & Fitur Website** (Digital Marketing)  
> <img src="public/images/poster%20fix%20k3.png" width="600" alt="Poster Desain Website">

## 🎬 Video Promosi

Selain pembuatan poster dan website, proyek ini juga dilengkapi dengan video promosi. Anda dapat mengakses dan menonton video promosi kami melalui tautan berikut:

📍 **[Tonton Video Promosi (Google Drive)](https://drive.google.com/file/d/14sWLQOk_Sn96E21Lmza91fLUo1q0GeKC/view?usp=sharing)**

📍 **[Tonton Video Promosi (Facebook)](https://www.facebook.com/share/1E37QzcgdW/?mibextid=wwXIfr)**

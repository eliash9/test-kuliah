## Tes Minat Mahasiswa – Laravel 11

Aplikasi web untuk melakukan tes minat mahasiswa, mengelola bank soal, menghitung hasil per Subject (Mata Kuliah), dan menampilkan rekomendasi. Proyek ini menggunakan relasi dinamis antara Question dan Subject melalui entitas QuestionOption, sehingga tidak ada hardcode kategori.

## Teknologi yang Digunakan

- Backend: Laravel 11 (PHP ^8.2)
- Database: MySQL/MariaDB (default `.env.example`), Eloquent ORM & Migrasi
- Frontend: Blade, Tailwind CSS (via CDN), Alpine.js (CDN), Chart.js (CDN) untuk grafik di halaman web
- Build tools: Vite (opsional; proyek saat ini memakai CDN untuk UI utama)
- PDF: barryvdh/laravel-dompdf (chart di PDF dibuat dengan HTML/CSS, bukan JavaScript)

## Fitur Utama

- Autentikasi sederhana (login/register), role-based access: Admin & Mahasiswa
- Admin: CRUD Subject dan Question, dengan opsi jawaban dinamis yang terhubung ke Subject
- Mahasiswa: mengerjakan tes, melihat hasil beserta grafik & persentase, mengunduh PDF
- Admin: melihat daftar semua mahasiswa yang memiliki jawaban, membuka detail hasil, dan mengunduh PDF hasil mahasiswa yang konsisten dengan milik user

## Arsitektur Data (Singkat)

- `subjects`: daftar mata kuliah/tema minat (name, description)
- `questions`: daftar pertanyaan (text)
- `question_options`: opsi per-pertanyaan, setiap opsi memiliki `subject_id` target
  - Kolom: `question_id`, `subject_id`, `text`, `key` (opsional, A/B/C/D)
- `answers`: jawaban mahasiswa untuk setiap pertanyaan
  - Kolom relevan: `user_id`, `question_id`, `option_id`
- `results`: tabel lama (kolom fixed) masih ada untuk kompatibilitas beberapa view admin, namun alur hasil mahasiswa dan PDF kini dihitung dinamis dari `answers`

Relasi utama:

- Question hasMany QuestionOption
- QuestionOption belongsTo Subject
- Answer belongsTo QuestionOption dan belongsTo Question
- Subject hasMany QuestionOption

## Metode Perhitungan Skor

1) Mahasiswa memilih satu `option` untuk setiap `question`.
2) Setiap `option` telah ditautkan ke `subject_id` tertentu (melalui `question_options`).
3) Skor per Subject dihitung dengan cara agregasi jawaban:
   - Ambil semua `answers` milik user, join ke `question_options.subject`.
   - Hitung jumlah jawaban per `subject_id`.
4) Persentase per Subject:
   - `total = sum(skor_semua_subject)` (minimal 1 untuk hindari pembagian nol)
   - `persentase_subject = round((skor_subject / total) * 100, 1)`
5) Rekomendasi:
   - Subject dengan skor tertinggi dianggap sebagai rekomendasi utama
   - PDF dan tampilan detail menampilkan daftar rekomendasi (minimal subject teratas)

Catatan: di PDF, chart tidak menggunakan Chart.js (karena DomPDF tidak menjalankan JavaScript). Sebagai gantinya, digunakan bar chart berbasis HTML/CSS (lebar bar proporsional terhadap persentase).

## Alur Peran

- Mahasiswa
  - Mengerjakan tes: `answers.create` → `answers.store`
  - Rekap hasil dinamis: `results.index`
  - Detail + PDF dinamis: `results.show`, `results.printPdf`

- Admin
  - Kelola Soal: `questions` (create/edit dilengkapi pemilihan Subject per opsi)
  - Kelola Subject: `subjects`
  - Rekap semua user yang memiliki jawaban: `adminresults.index`
  - Detail user: `adminresults.show`
  - PDF user (sama format dengan user): `adminresults.printPdf` (menggunakan view `results.pdf`)

## Instalasi & Menjalankan

Prasyarat: PHP ^8.2, Composer, Node.js (opsional jika ingin Vite), MySQL.

1) Clone & Install

```
composer install
cp .env.example .env
php artisan key:generate
```

2) Konfigurasi `.env`

- Database (`DB_*`),
- Session: proyek sudah diset `SESSION_DRIVER=file` untuk dev,
- (Opsional Dev) Seeder password:
  - `ADMIN_PASSWORD=` (default fallback: `password`)
  - `MAHASISWA_PASSWORD=` (default fallback: `password`)

3) Migrasi & Seed

```
php artisan migrate --seed

# atau untuk instalasi bersih:
php artisan migrate:fresh --seed
```

Akun sample:

- Admin: `admin@example.com` / password dari `ADMIN_PASSWORD` atau `password`
- Mahasiswa: `mahasiswa@example.com` / password dari `MAHASISWA_PASSWORD` atau `password`

4) Menjalankan Aplikasi

```
php artisan serve
```

UI saat ini menggunakan CDN Tailwind & Alpine, jadi Vite tidak wajib untuk berjalan.

## Rute Penting

- Halaman depan: `/`
- Auth: `/login`, `/register`, `/logout`
- Mahasiswa: `/answers/create`, `/results`, `/results/show`, `/results/print-pdf`
- Admin: `/questions`, `/subjects`, `/adminresults`, `/adminresults/{user}`, `/adminresults/{user}/print-pdf`

## Pengembangan Lebih Lanjut

- Tambah/kurangi jumlah opsi per pertanyaan (sudah didukung, UI create/edit bisa dibuat lebih dinamis – tombol tambah/hapus baris)
- Admin index: tampilkan subject teratas dan total jawaban per user
- Optimasi PDF: tambahkan logo institusi, identitas prodi, dan tanda tangan elektronik
- Pembersihan skema lama: sudah ada migrasi untuk drop kolom lama di `questions` dan `answers`

## Lisensi

Proyek ini mengikuti lisensi MIT.

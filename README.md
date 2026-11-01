# Katalog Buku

Tugas 2 - Aplikasi Teknologi Online (UNIKOM). Sistem informasi manajemen data sederhana (kasus: katalog buku) dengan **PHP murni (PDO)** dan **MySQL/MariaDB**.

## Fitur
- **Login** berbasis `$_SESSION`, semua halaman CRUD terproteksi (tanpa login diarahkan ke `login.php`)
- **Dual bahasa** Indonesia / English, pilihan disimpan di `$_SESSION["lang"]` dan tetap konsisten antarhalaman
- **CRUD** data buku: Create, Read (tabel + pencarian), Update, Delete
- **Validasi** form (if-else dan switch) dan **sanitasi** input (`trim`, `strip_tags`), output di-escape dengan `htmlspecialchars()`
- Keamanan tambahan: prepared statement, `password_hash()` / `password_verify()`, token CSRF, hapus lewat POST, `session_regenerate_id()` saat login

## Cara Menjalankan (XAMPP / Laragon)
1. Salin folder proyek ke `htdocs` (XAMPP) atau `www` (Laragon), misalnya `htdocs/katalog-buku`.
2. Nyalakan **Apache** dan **MySQL**.
3. Buka phpMyAdmin, **Import** file `database.sql` (otomatis membuat database `db_katalog`).
4. Sesuaikan `koneksi.php` bila user/password MySQL berbeda (default: `root` tanpa password).
5. Buka `http://localhost/katalog-buku/login.php`.

**Akun default:** username `admin` | password `admin123`

## Poin Penilaian dan Lokasinya
| Kebutuhan tugas | Lokasi |
|---|---|
| Form input POST | `login.php`, `_form.php` (dipakai `tambah.php` dan `edit.php`), tombol hapus di `index.php` |
| Validasi if-else / switch | `fungsi.php` (`validasi_buku()`) |
| Sanitasi input | `fungsi.php` (`bersihkan()`), `filter_var` untuk id di `edit.php` dan `hapus.php` |
| Sanitasi output | `fungsi.php` (`e()` = `htmlspecialchars`) |
| Koneksi database | `koneksi.php` |
| Create / Read / Update / Delete | `tambah.php` / `index.php` / `edit.php` / `hapus.php` |
| Proteksi halaman (session) | `auth.php`, di-require tiap halaman CRUD |
| Login dan logout | `login.php`, `logout.php` |
| Dual bahasa di session | `lang.php`, `lang/id.php`, `lang/en.php`, saklar ID/EN di `header.php` |
| Skrip database (.sql) | `database.sql` |

## Struktur Berkas
| Berkas | Fungsi |
|---|---|
| `database.sql` | Tabel `users` dan `buku` + data contoh |
| `koneksi.php` | Koneksi PDO ke MySQL |
| `fungsi.php` | Sanitasi, validasi form, token CSRF |
| `lang.php`, `lang/id.php`, `lang/en.php` | Pengaturan bahasa (session) dan kamus terjemahan |
| `auth.php` | Penjaga halaman: wajib login |
| `login.php`, `logout.php` | Login dan logout |
| `index.php` | **Read** - tabel buku + pencarian |
| `tambah.php` | **Create** - form tambah buku |
| `edit.php` | **Update** - form ubah buku berdasarkan `id` |
| `hapus.php` | **Delete** - hapus buku (hanya POST) |
| `_form.php`, `header.php`, `footer.php`, `style.css` | Tampilan bersama (tema coklat) |

## Tangkapan Layar
Lihat folder `screenshots/` dan file laporan PDF.
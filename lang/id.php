<?php
return [
    "app_title"        => "Katalog Buku",
    "welcome"          => "Halo",
    "logout"           => "Keluar",
    "footer"           => "2026 Katalog Buku",

    // Login
    "login_title"      => "Masuk ke Katalog",
    "login_sub"        => "Silakan login untuk mengelola koleksi buku.",
    "username"         => "Username",
    "password"         => "Password",
    "btn_login"        => "Masuk",
    "err_login_kosong" => "Username dan password wajib diisi.",
    "err_login_salah"  => "Username atau password salah.",

    // Daftar data
    "data_buku"        => "Koleksi Buku",
    "subjudul"         => "Daftar buku yang tersimpan di katalog.",
    "tambah"           => "Tambah Buku",
    "edit"             => "Ubah",
    "hapus"            => "Hapus",
    "aksi"             => "Aksi",
    "no"               => "No",
    "isbn"             => "ISBN",
    "judul"            => "Judul",
    "penulis"          => "Penulis",
    "penerbit"         => "Penerbit",
    "kategori"         => "Kategori",
    "tahun_terbit"     => "Tahun Terbit",
    "tahun_singkat"    => "Tahun",
    "cari"             => "Cari",
    "reset"            => "Reset",
    "placeholder_cari" => "Cari judul, penulis, ISBN, atau kategori...",
    "total_data"       => "Total buku",
    "data_kosong"      => "Buku tidak ditemukan.",
    "konfirmasi_hapus" => "Yakin ingin menghapus buku ini?",

    // Form
    "judul_tambah"     => "Tambah Buku Baru",
    "judul_edit"       => "Ubah Data Buku",
    "hint_isbn"        => "10 atau 13 digit, tanda hubung boleh dipakai.",
    "pilih_kategori"   => "-- Pilih Kategori --",
    "simpan"           => "Simpan",
    "batal"            => "Batal",

    // Pesan
    "msg_tambah_ok"    => "Buku berhasil ditambahkan.",
    "msg_ubah_ok"      => "Data buku berhasil diubah.",
    "msg_hapus_ok"     => "Buku berhasil dihapus.",
    "msg_tidak_ada"    => "Buku tidak ditemukan.",
    "msg_csrf"         => "Permintaan tidak valid. Silakan coba lagi.",

    // Validasi
    "err_isbn_kosong"      => "ISBN tidak boleh kosong.",
    "err_isbn_format"      => "ISBN harus 10 atau 13 digit (ISBN-10 boleh berakhiran X).",
    "err_isbn_duplikat"    => "ISBN sudah terdaftar.",
    "err_judul_kosong"     => "Judul tidak boleh kosong.",
    "err_judul_panjang"    => "Judul maksimal 150 karakter.",
    "err_penulis_kosong"   => "Penulis tidak boleh kosong.",
    "err_penulis_panjang"  => "Nama penulis maksimal 100 karakter.",
    "err_penerbit_kosong"  => "Penerbit tidak boleh kosong.",
    "err_penerbit_panjang" => "Nama penerbit maksimal 100 karakter.",
    "err_kategori"         => "Pilih kategori yang tersedia.",
    "err_tahun"            => "Tahun terbit harus berupa tahun antara 1900 dan %d.",
];

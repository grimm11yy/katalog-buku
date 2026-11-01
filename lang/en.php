<?php
return [
    "app_title"        => "Book Catalog",
    "welcome"          => "Hello",
    "logout"           => "Logout",
    "footer"           => "2026 Book Catalog",

    // Login
    "login_title"      => "Sign In to the Catalog",
    "login_sub"        => "Please sign in to manage the book collection.",
    "username"         => "Username",
    "password"         => "Password",
    "btn_login"        => "Sign In",
    "err_login_kosong" => "Username and password are required.",
    "err_login_salah"  => "Incorrect username or password.",

    // List
    "data_buku"        => "Book Collection",
    "subjudul"         => "Books stored in the catalog.",
    "tambah"           => "Add Book",
    "edit"             => "Edit",
    "hapus"            => "Delete",
    "aksi"             => "Actions",
    "no"               => "No",
    "isbn"             => "ISBN",
    "judul"            => "Title",
    "penulis"          => "Author",
    "penerbit"         => "Publisher",
    "kategori"         => "Category",
    "tahun_terbit"     => "Year Published",
    "tahun_singkat"    => "Year",
    "cari"             => "Search",
    "reset"            => "Reset",
    "placeholder_cari" => "Search title, author, ISBN, or category...",
    "total_data"       => "Total books",
    "data_kosong"      => "No books found.",
    "konfirmasi_hapus" => "Are you sure you want to delete this book?",

    // Form
    "judul_tambah"     => "Add New Book",
    "judul_edit"       => "Edit Book Data",
    "hint_isbn"        => "10 or 13 digits, hyphens are allowed.",
    "pilih_kategori"   => "-- Select Category --",
    "simpan"           => "Save",
    "batal"            => "Cancel",

    // Messages
    "msg_tambah_ok"    => "Book added successfully.",
    "msg_ubah_ok"      => "Book updated successfully.",
    "msg_hapus_ok"     => "Book deleted successfully.",
    "msg_tidak_ada"    => "Book not found.",
    "msg_csrf"         => "Invalid request. Please try again.",

    // Validation
    "err_isbn_kosong"      => "ISBN is required.",
    "err_isbn_format"      => "ISBN must be 10 or 13 digits (ISBN-10 may end with X).",
    "err_isbn_duplikat"    => "ISBN is already registered.",
    "err_judul_kosong"     => "Title is required.",
    "err_judul_panjang"    => "Title must be at most 150 characters.",
    "err_penulis_kosong"   => "Author is required.",
    "err_penulis_panjang"  => "Author name must be at most 100 characters.",
    "err_penerbit_kosong"  => "Publisher is required.",
    "err_penerbit_panjang" => "Publisher name must be at most 100 characters.",
    "err_kategori"         => "Please choose an available category.",
    "err_tahun"            => "Year published must be a year between 1900 and %d.",
];

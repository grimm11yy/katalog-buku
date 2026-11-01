<?php
// fungsi.php - fungsi bantu: sanitasi, CSRF, daftar kategori, dan validasi form

// Escape output ke HTML (mencegah XSS)
function e($teks) {
    return htmlspecialchars((string)$teks, ENT_QUOTES, 'UTF-8');
}

// Sanitasi input teks: buang spasi berlebih dan tag HTML
function bersihkan($teks) {
    return trim(strip_tags((string)$teks));
}

// Hitung panjang teks (jumlah karakter) tanpa bergantung pada ekstensi mbstring
function panjang_teks($teks) {
    return (int)preg_match_all("/./us", $teks);
}

function daftar_kategori() {
    return [
        "Fiksi",
        "Non-Fiksi",
        "Teknologi",
        "Sains",
        "Sejarah",
        "Biografi",
        "Pendidikan",
    ];
}

// Token CSRF disimpan di session, dikirim lewat hidden input pada form POST
function csrf_token() {
    if (empty($_SESSION["csrf"])) {
        $_SESSION["csrf"] = bin2hex(random_bytes(32));
    }
    return $_SESSION["csrf"];
}

function csrf_valid($token) {
    return isset($_SESSION["csrf"]) && is_string($token)
        && hash_equals($_SESSION["csrf"], $token);
}

// Sanitasi + validasi data buku. Mengembalikan [$data, $errors]
function validasi_buku(array $input, array $t) {
    $data = [
        // ISBN: hapus tanda hubung/spasi (mis. 978-979-306-279-2), huruf X dibuat kapital
        "isbn"         => strtoupper(str_replace(["-", " "], "", bersihkan($input["isbn"] ?? ""))),
        "judul"        => bersihkan($input["judul"] ?? ""),
        "penulis"      => bersihkan($input["penulis"] ?? ""),
        "penerbit"     => bersihkan($input["penerbit"] ?? ""),
        "kategori"     => bersihkan($input["kategori"] ?? ""),
        "tahun_terbit" => bersihkan($input["tahun_terbit"] ?? ""),
    ];
    $errors = [];

    // ISBN (10 atau 13 karakter; ISBN-10 boleh berakhiran X)
    if ($data["isbn"] === "") {
        $errors[] = $t["err_isbn_kosong"];
    } elseif (!preg_match('/^([0-9]{13}|[0-9]{9}[0-9X])$/', $data["isbn"])) {
        $errors[] = $t["err_isbn_format"];
    }

    // Judul
    if ($data["judul"] === "") {
        $errors[] = $t["err_judul_kosong"];
    } elseif (panjang_teks($data["judul"]) > 150) {
        $errors[] = $t["err_judul_panjang"];
    }

    // Penulis
    if ($data["penulis"] === "") {
        $errors[] = $t["err_penulis_kosong"];
    } elseif (panjang_teks($data["penulis"]) > 100) {
        $errors[] = $t["err_penulis_panjang"];
    }

    // Penerbit
    if ($data["penerbit"] === "") {
        $errors[] = $t["err_penerbit_kosong"];
    } elseif (panjang_teks($data["penerbit"]) > 100) {
        $errors[] = $t["err_penerbit_panjang"];
    }

    // Kategori (harus salah satu dari daftar; sinkron dengan daftar_kategori())
    switch ($data["kategori"]) {
        case "Fiksi":
        case "Non-Fiksi":
        case "Teknologi":
        case "Sains":
        case "Sejarah":
        case "Biografi":
        case "Pendidikan":
            break;
        default:
            $errors[] = $t["err_kategori"];
    }

    // Tahun terbit (angka 1900 s.d. tahun sekarang)
    $tahun_ini = (int)date("Y");
    if (!ctype_digit($data["tahun_terbit"]) || (int)$data["tahun_terbit"] < 1900 || (int)$data["tahun_terbit"] > $tahun_ini) {
        $errors[] = sprintf($t["err_tahun"], $tahun_ini);
    }

    return [$data, $errors];
}

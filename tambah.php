<?php
// tambah.php - CREATE: form input + validasi + simpan buku baru
require "lang.php";
require "auth.php";
require "koneksi.php";

$data   = ["isbn" => "", "judul" => "", "penulis" => "", "penerbit" => "", "kategori" => "", "tahun_terbit" => ""];
$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!csrf_valid($_POST["csrf"] ?? "")) {
        $errors[] = $t["msg_csrf"];
    } else {
        // 1) sanitasi + validasi
        list($data, $errors) = validasi_buku($_POST, $t);

        // 2) simpan hanya jika tidak ada error
        if (empty($errors)) {
            try {
                $stmt = $pdo->prepare(
                    "INSERT INTO buku (isbn, judul, penulis, penerbit, kategori, tahun_terbit)
                     VALUES (:isbn, :judul, :penulis, :penerbit, :kategori, :tahun_terbit)"
                );
                $stmt->execute([
                    ":isbn"         => $data["isbn"],
                    ":judul"        => $data["judul"],
                    ":penulis"      => $data["penulis"],
                    ":penerbit"     => $data["penerbit"],
                    ":kategori"     => $data["kategori"],
                    ":tahun_terbit" => $data["tahun_terbit"],
                ]);
                $_SESSION["flash"] = ["tipe" => "sukses", "kunci" => "msg_tambah_ok"];
                header("Location: index.php");
                exit;
            } catch (PDOException $ex) {
                if ($ex->getCode() === "23000") {      // pelanggaran UNIQUE (ISBN kembar)
                    $errors[] = $t["err_isbn_duplikat"];
                } else {
                    throw $ex;
                }
            }
        }
    }
}

$judul = $t["judul_tambah"];
$judul_halaman = $judul;
require "header.php";
require "_form.php";
require "footer.php";

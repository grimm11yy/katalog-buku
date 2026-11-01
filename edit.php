<?php
// edit.php - UPDATE: ubah data buku berdasarkan id (identitas unik)
require "lang.php";
require "auth.php";
require "koneksi.php";

// id dari URL (GET) saat membuka form, atau dari hidden input (POST) saat menyimpan
$id = filter_var($_GET["id"] ?? ($_POST["id"] ?? null), FILTER_VALIDATE_INT);

function kembali_ke_daftar($kunci) {
    $_SESSION["flash"] = ["tipe" => "error", "kunci" => $kunci];
    header("Location: index.php");
    exit;
}

if (!$id) {
    kembali_ke_daftar("msg_tidak_ada");
}

$stmt = $pdo->prepare("SELECT * FROM buku WHERE id = :id");
$stmt->execute([":id" => $id]);
$data = $stmt->fetch();
if (!$data) {
    kembali_ke_daftar("msg_tidak_ada");
}

$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!csrf_valid($_POST["csrf"] ?? "")) {
        $errors[] = $t["msg_csrf"];
    } else {
        list($data, $errors) = validasi_buku($_POST, $t);

        if (empty($errors)) {
            try {
                $stmt = $pdo->prepare(
                    "UPDATE buku
                     SET isbn = :isbn, judul = :judul, penulis = :penulis, penerbit = :penerbit,
                         kategori = :kategori, tahun_terbit = :tahun_terbit
                     WHERE id = :id"
                );
                $stmt->execute([
                    ":isbn"         => $data["isbn"],
                    ":judul"        => $data["judul"],
                    ":penulis"      => $data["penulis"],
                    ":penerbit"     => $data["penerbit"],
                    ":kategori"     => $data["kategori"],
                    ":tahun_terbit" => $data["tahun_terbit"],
                    ":id"           => $id,
                ]);
                $_SESSION["flash"] = ["tipe" => "sukses", "kunci" => "msg_ubah_ok"];
                header("Location: index.php");
                exit;
            } catch (PDOException $ex) {
                if ($ex->getCode() === "23000") {
                    $errors[] = $t["err_isbn_duplikat"];
                } else {
                    throw $ex;
                }
            }
        }
    }
}

$judul = $t["judul_edit"];
$judul_halaman = $judul;
require "header.php";
require "_form.php";     // memakai $data, $errors, $id
require "footer.php";

<?php
// hapus.php - DELETE: hanya menerima POST (bukan link GET) + token CSRF
require "lang.php";
require "auth.php";
require "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit;
}

if (!csrf_valid($_POST["csrf"] ?? "")) {
    $_SESSION["flash"] = ["tipe" => "error", "kunci" => "msg_csrf"];
    header("Location: index.php");
    exit;
}

$id = filter_var($_POST["id"] ?? null, FILTER_VALIDATE_INT);

if ($id) {
    $stmt = $pdo->prepare("DELETE FROM buku WHERE id = :id");
    $stmt->execute([":id" => $id]);
    $kunci = $stmt->rowCount() > 0 ? "msg_hapus_ok" : "msg_tidak_ada";
    $tipe  = $stmt->rowCount() > 0 ? "sukses" : "error";
} else {
    $kunci = "msg_tidak_ada";
    $tipe  = "error";
}

$_SESSION["flash"] = ["tipe" => $tipe, "kunci" => $kunci];
header("Location: index.php");
exit;

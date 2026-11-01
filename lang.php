<?php
// lang.php - memulai session, mengatur bahasa antarmuka (disimpan di $_SESSION), memuat fungsi bantu
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . "/fungsi.php";

$bahasa_tersedia = ["id", "en"];

// Ganti bahasa lewat link ?lang=id atau ?lang=en (hanya nilai yang ada di whitelist)
if (isset($_GET["lang"]) && in_array($_GET["lang"], $bahasa_tersedia, true)) {
    $_SESSION["lang"] = $_GET["lang"];
}
if (!isset($_SESSION["lang"]) || !in_array($_SESSION["lang"], $bahasa_tersedia, true)) {
    $_SESSION["lang"] = "id";
}

// $t = kamus terjemahan sesuai bahasa yang dipilih
$t = require __DIR__ . "/lang/" . $_SESSION["lang"] . ".php";

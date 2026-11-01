<?php
// logout.php - menghapus session login, tetapi pilihan bahasa tetap dipertahankan
require "lang.php";

$bahasa = $_SESSION["lang"];

session_unset();      // kosongkan semua variabel session
session_destroy();    // hancurkan session di server

header("Location: login.php?lang=" . urlencode($bahasa));
exit;

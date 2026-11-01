<?php
// header.php - kerangka bagian atas halaman (navigasi, pilihan bahasa). Butuh lang.php sudah dimuat.
function link_bahasa($kode) {
    return "?" . http_build_query(array_merge($_GET, ["lang" => $kode]));
}
?>
<!DOCTYPE html>
<html lang="<?= e($_SESSION["lang"]) ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($judul_halaman ?? $t["app_title"]) ?> | <?= e($t["app_title"]) ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header class="topbar">
    <div class="brand"><?= e($t["app_title"]) ?></div>
    <nav class="menu">
        <span class="lang">
            <a class="<?= $_SESSION["lang"] === "id" ? "aktif" : "" ?>" href="<?= e(link_bahasa("id")) ?>">ID</a>
            <a class="<?= $_SESSION["lang"] === "en" ? "aktif" : "" ?>" href="<?= e(link_bahasa("en")) ?>">EN</a>
        </span>
        <?php if (isset($_SESSION["user_id"])): ?>
            <span class="user"><?= e($t["welcome"]) ?>, <strong><?= e($_SESSION["fullname"]) ?></strong></span>
            <a class="btn btn-garis" href="logout.php"><?= e($t["logout"]) ?></a>
        <?php endif; ?>
    </nav>
</header>
<main class="konten">

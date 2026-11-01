<?php
// index.php - READ: menampilkan seluruh data buku dalam tabel (halaman terproteksi login)
require "lang.php";
require "auth.php";
require "koneksi.php";

// Pencarian opsional lewat GET (?q=...)
$q = bersihkan($_GET["q"] ?? "");

if ($q !== "") {
    $stmt = $pdo->prepare(
        "SELECT * FROM buku
         WHERE judul LIKE :q1 OR penulis LIKE :q2 OR isbn LIKE :q3 OR kategori LIKE :q4
         ORDER BY judul ASC"
    );
    $like = "%" . $q . "%";
    $stmt->execute([":q1" => $like, ":q2" => $like, ":q3" => $like, ":q4" => $like]);
} else {
    $stmt = $pdo->prepare("SELECT * FROM buku ORDER BY judul ASC");
    $stmt->execute();
}
$daftar = $stmt->fetchAll();

// Pesan sekali tampil (flash message) hasil create/update/delete
$flash = $_SESSION["flash"] ?? null;
unset($_SESSION["flash"]);

$judul_halaman = $t["data_buku"];
require "header.php";
?>
<div class="kepala-halaman">
    <div>
        <h1 class="judul-halaman"><?= e($t["data_buku"]) ?></h1>
        <p class="subjudul"><?= e($t["subjudul"]) ?></p>
    </div>
    <a href="tambah.php" class="btn">+ <?= e($t["tambah"]) ?></a>
</div>

<?php if ($flash): ?>
    <div class="alert alert-<?= $flash["tipe"] === "sukses" ? "sukses" : "error" ?>">
        <?= e($t[$flash["kunci"]] ?? "") ?>
    </div>
<?php endif; ?>

<div class="panel">
    <form method="GET" action="index.php" class="cari">
        <input type="text" name="q" value="<?= e($q) ?>" placeholder="<?= e($t["placeholder_cari"]) ?>">
        <button type="submit" class="btn"><?= e($t["cari"]) ?></button>
        <?php if ($q !== ""): ?>
            <a href="index.php" class="btn btn-polos"><?= e($t["reset"]) ?></a>
        <?php endif; ?>
    </form>

    <div class="tabel-wrap">
    <table>
        <thead>
            <tr>
                <th><?= e($t["no"]) ?></th>
                <th><?= e($t["isbn"]) ?></th>
                <th><?= e($t["judul"]) ?></th>
                <th><?= e($t["penulis"]) ?></th>
                <th><?= e($t["penerbit"]) ?></th>
                <th><?= e($t["kategori"]) ?></th>
                <th><?= e($t["tahun_singkat"]) ?></th>
                <th><?= e($t["aksi"]) ?></th>
            </tr>
        </thead>
        <tbody>
        <?php if (count($daftar) === 0): ?>
            <tr><td colspan="8" class="kosong"><?= e($t["data_kosong"]) ?></td></tr>
        <?php else: ?>
            <?php foreach ($daftar as $i => $b): ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td class="isbn"><?= e($b["isbn"]) ?></td>
                <td class="judul-buku"><?= e($b["judul"]) ?></td>
                <td><?= e($b["penulis"]) ?></td>
                <td><?= e($b["penerbit"]) ?></td>
                <td><span class="tag"><?= e($b["kategori"]) ?></span></td>
                <td><?= e($b["tahun_terbit"]) ?></td>
                <td class="aksi">
                    <a href="edit.php?id=<?= (int)$b["id"] ?>" class="btn btn-kecil"><?= e($t["edit"]) ?></a>
                    <form method="POST" action="hapus.php" onsubmit="return confirm('<?= e(addslashes($t["konfirmasi_hapus"])) ?>')">
                        <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
                        <input type="hidden" name="id" value="<?= (int)$b["id"] ?>">
                        <button type="submit" class="btn btn-kecil btn-bahaya"><?= e($t["hapus"]) ?></button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
    </div>
    <p class="total"><?= e($t["total_data"]) ?>: <strong><?= count($daftar) ?></strong></p>
</div>
<?php require "footer.php"; ?>

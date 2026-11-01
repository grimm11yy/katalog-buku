<?php
// _form.php - bagian form yang dipakai bersama oleh tambah.php dan edit.php
// Variabel yang dibutuhkan: $judul, $data, $errors, $id (opsional, khusus edit)
?>
<div class="panel panel-form">
    <h1 class="judul-halaman"><?= e($judul) ?></h1>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-error">
            <ul>
                <?php foreach ($errors as $pesan): ?>
                    <li><?= e($pesan) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" action="">
        <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
        <?php if (isset($id)): ?>
            <input type="hidden" name="id" value="<?= e($id) ?>">
        <?php endif; ?>

        <label for="isbn"><?= e($t["isbn"]) ?></label>
        <input type="text" id="isbn" name="isbn" maxlength="17" value="<?= e($data["isbn"]) ?>">
        <span class="petunjuk"><?= e($t["hint_isbn"]) ?></span>

        <label for="judul"><?= e($t["judul"]) ?></label>
        <input type="text" id="judul" name="judul" maxlength="150" value="<?= e($data["judul"]) ?>">

        <label for="penulis"><?= e($t["penulis"]) ?></label>
        <input type="text" id="penulis" name="penulis" maxlength="100" value="<?= e($data["penulis"]) ?>">

        <label for="penerbit"><?= e($t["penerbit"]) ?></label>
        <input type="text" id="penerbit" name="penerbit" maxlength="100" value="<?= e($data["penerbit"]) ?>">

        <label for="kategori"><?= e($t["kategori"]) ?></label>
        <select id="kategori" name="kategori">
            <option value=""><?= e($t["pilih_kategori"]) ?></option>
            <?php foreach (daftar_kategori() as $k): ?>
                <option value="<?= e($k) ?>" <?= $data["kategori"] === $k ? "selected" : "" ?>><?= e($k) ?></option>
            <?php endforeach; ?>
        </select>

        <label for="tahun_terbit"><?= e($t["tahun_terbit"]) ?></label>
        <input type="text" id="tahun_terbit" name="tahun_terbit" maxlength="4" value="<?= e($data["tahun_terbit"]) ?>">

        <div class="tombol-form">
            <button type="submit" class="btn"><?= e($t["simpan"]) ?></button>
            <a href="index.php" class="btn btn-polos"><?= e($t["batal"]) ?></a>
        </div>
    </form>
</div>

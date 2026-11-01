<?php
// login.php - halaman login. Jika berhasil, data user disimpan di $_SESSION
require "lang.php";
require "koneksi.php";

// Jika sudah login, tidak perlu melihat halaman login lagi
if (isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit;
}

$error = "";
$username = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = bersihkan($_POST["username"] ?? "");
    $password = $_POST["password"] ?? "";

    if ($username === "" || $password === "") {
        $error = $t["err_login_kosong"];
    } else {
        $stmt = $pdo->prepare("SELECT id, username, password, fullname FROM users WHERE username = :username");
        $stmt->execute([":username" => $username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user["password"])) {
            session_regenerate_id(true);           // cegah session fixation
            $_SESSION["user_id"]  = $user["id"];
            $_SESSION["fullname"] = $user["fullname"];
            header("Location: index.php");
            exit;
        } else {
            $error = $t["err_login_salah"];
        }
    }
}

$judul_halaman = $t["login_title"];
require "header.php";
?>
<div class="panel panel-login">
    <h1 class="judul-halaman"><?= e($t["login_title"]) ?></h1>
    <p class="subjudul"><?= e($t["login_sub"]) ?></p>

    <?php if ($error !== ""): ?>
        <div class="alert alert-error"><?= e($error) ?></div>
    <?php endif; ?>

    <form method="POST" action="login.php">
        <label for="username"><?= e($t["username"]) ?></label>
        <input type="text" id="username" name="username" value="<?= e($username) ?>" autofocus>

        <label for="password"><?= e($t["password"]) ?></label>
        <input type="password" id="password" name="password">

        <div class="tombol-form">
            <button type="submit" class="btn"><?= e($t["btn_login"]) ?></button>
        </div>
    </form>
</div>
<?php require "footer.php"; ?>

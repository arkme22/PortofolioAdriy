<?php
session_start();
$admin_password = "123456"; // Ganti dengan password kuat

// Login Admin
if (isset($_POST['password'])) {
    if ($_POST['password'] === $admin_password) {
        $_SESSION['admin'] = true;
    } else {
        echo "<script>alert('Password salah!'); window.location.href='admin_upload.php';</script>";
        exit;
    }
}

// Jika belum login, tampilkan form login
if (!isset($_SESSION['admin'])) {
?>
    <form method="post">
        <label>Masukkan Password:</label>
        <input type="password" name="password">
        <button type="submit">Login</button>
    </form>
<?php
    exit;
}

// Jika sudah login, tampilkan form upload
?>
<form action="admin_upload.php" method="post" enctype="multipart/form-data">
    <input type="file" name="file">
    <button type="submit">Unggah</button>
</form>

<?php
// Proses unggahan file
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
    $upload_dir = "uploads/";
    $file_name = basename($_FILES["file"]["name"]);
    $target_path = $upload_dir . $file_name;

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_path)) {
        echo "<script>alert('File berhasil diunggah!'); window.location.href='admin_upload.php';</script>";
    } else {
        echo "<script>alert('Gagal mengunggah file!'); window.location.href='admin_upload.php';</script>";
    }
}
?>
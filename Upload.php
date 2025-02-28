<?php
$upload_dir = "uploads/";

// Pastikan folder uploads ada
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

// Jika diminta daftar file
if (isset($_GET['list'])) {
    $files = array_diff(scandir($upload_dir), array('.', '..'));

    // Pastikan ada file di dalam folder uploads
    if (empty($files)) {
        echo json_encode(["Tidak ada file untuk diunduh."]);
    } else {
        echo json_encode(array_values($files));
    }
    exit;
}
?>
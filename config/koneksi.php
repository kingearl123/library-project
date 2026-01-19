<?php
$koneksi = mysqli_connect("localhost", "root", "", "perpustakaan");

if (!$koneksi) {
    die(json_encode([
        'status' => false,
        'message' => 'Koneksi database gagal'
    ]));
}

?>
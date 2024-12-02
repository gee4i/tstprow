<?php
header('Content-Type: application/json');

// URL API di Perangkat 2
$apiUrl = 'http://172.20.10.2/gym_a/api_classes.php';

// Mengambil data kelas dari API
$classesJson = file_get_contents($apiUrl);

// Memeriksa apakah data berhasil diambil
if ($classesJson === FALSE) {
    echo json_encode(["message" => "Gagal mengambil data kelas."]);
    exit();
}

// Mengembalikan data kelas
echo $classesJson;
?>

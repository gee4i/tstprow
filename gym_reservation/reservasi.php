<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Cek apakah pengguna sudah login
    if (!isset($_SESSION['user'])) {
        echo json_encode(["message" => "Anda harus login untuk melakukan reservasi."]);
        exit();
    }

    $classId = $_POST['class_id']; // Ambil ID kelas dari form

    // Kirim permintaan reservasi ke API
    $apiUrl = 'http://172.20.10.2/gym_a/api_reservasi.php'; // Ganti dengan URL API yang sesuai
    $data = ['class_id' => $classId];

    $options = [
        'http' => [
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data),
        ],
    ];
    $context  = stream_context_create($options);
    $result = file_get_contents($apiUrl, false, $context);

    // Tampilkan hasil
    echo $result;
}
?>
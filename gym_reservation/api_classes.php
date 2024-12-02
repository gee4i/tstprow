<?php
header('Content-Type: application/json');
require 'db.php'; // Pastikan ini mengarah ke file db.php yang benar

// Query untuk mengambil semua kelas
$query = "SELECT * FROM classes";
$result = $mysqli->query($query);

// Array untuk menyimpan data kelas
$classes = [];

// Mengambil data kelas dari hasil query
while ($row = $result->fetch_assoc()) {
    $classes[] = $row; // Menambahkan setiap baris ke array
}

// Debugging: Tampilkan data sebelum diubah menjadi JSON
if (empty($classes)) {
    echo json_encode(["message" => "Tidak ada kelas yang tersedia."]);
} else {
    // Mengembalikan data kelas dalam format JSON
    echo json_encode($classes);
}

// Menutup koneksi database
$mysqli->close();
?>
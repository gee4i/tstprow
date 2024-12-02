<?php
header("Content-Type: application/json");
require 'db.php'; // Koneksi ke database

// Endpoint untuk validasi keanggotaan
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'validateMembership') {
    $memberId = $_GET['member_id'];
    $query = "SELECT * FROM members WHERE id = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("i", $memberId);
    $stmt->execute();
    $result = $stmt->get_result();
    $member = $result->fetch_assoc();

    if ($member) {
        echo json_encode($member);
    } else {
        echo json_encode(["message" => "Anggota tidak ditemukan."]);
    }
}

// Endpoint untuk memperbarui riwayat reservasi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action']) && $_GET['action'] === 'updateHistory') {
    $memberId = $_POST['member_id'];
    $classId = $_POST['class_id'];

    // Update jumlah reservasi anggota
    $updateQuery = "UPDATE members SET reservations_count = reservations_count + 1 WHERE id = ?";
    $updateStmt = $mysqli->prepare($updateQuery);
    $updateStmt->bind_param("i", $memberId);
    $updateStmt->execute();

    echo json_encode(["message" => "Riwayat reservasi diperbarui."]);
}
?>

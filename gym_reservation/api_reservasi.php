<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

class ReservationService {
    public function ReserveClass($memberId, $classId) {
        // Koneksi ke database
        $mysqli = new mysqli("localhost", "username", "password", "gym_systems");

        // Cek koneksi
        if ($mysqli->connect_error) {
            return ["message" => "Koneksi database gagal: " . $mysqli->connect_error];
        }

        // Cek ketersediaan kelas
        $classQuery = "SELECT * FROM classes WHERE id = ?";
        $stmt = $mysqli->prepare($classQuery);
        $stmt->bind_param("i", $classId);
        $stmt->execute();
        $classResult = $stmt->get_result();
        $class = $classResult->fetch_assoc();

        // Validasi kelas dan kapasitas
        if ($class) {
            if ($class['booked'] < $class['capacity']) {
                // Update jumlah yang dipesan
                $updateQuery = "UPDATE classes SET booked = booked + 1 WHERE id = ?";
                $updateStmt = $mysqli->prepare($updateQuery);
                $updateStmt->bind_param("i", $classId);
                $updateStmt->execute();

                // Simpan reservasi
                $reservationQuery = "INSERT INTO reservations (member_id, class_id) VALUES (?, ?)";
                $reservationStmt = $mysqli->prepare($reservationQuery);
                $reservationStmt->bind_param("ii", $memberId, $classId);
                if ($reservationStmt->execute()) {
                    return ["message" => "Reservasi berhasil untuk kelas: " . $class['nama']];
                } else {
                    return ["message" => "Error: " . $reservationStmt->error];
                }
            } else {
                return ["message" => "Kelas sudah penuh."];
            }
        } else {
            return ["message" => "Kelas tidak ditemukan."];
        }
    }
}

// Membuat server SOAP
$server = new SoapServer("http://localhost/gym_a/reservation.wsdl");
$server->setClass("ReservationService");
$server->handle();
?>

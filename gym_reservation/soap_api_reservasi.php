<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Koneksi ke database
$mysqli = new mysqli("localhost", "root", "123456", "gym_systems");

if ($mysqli->connect_error) {
    die("Koneksi database gagal: " . $mysqli->connect_error);
}

class ReservationService {
    private $mysqli;

    public function __construct($mysqli) {
        $this->mysqli = $mysqli;
    }

    public function ReserveClass($memberId, $classId) {

        // Cek ketersediaan kelas
        $classQuery = "SELECT * FROM classes WHERE id = ?";
        $stmt = $this->mysqli->prepare($classQuery);
        $stmt->bind_param("i", $classId);
        $stmt->execute();
        $classResult = $stmt->get_result();
        $class = $classResult->fetch_assoc();

        // Validasi kelas dan kapasitas
        if ($class) {
            if ($class['booked'] < $class['capacity']) {
                // Update jumlah yang dipesan
                $updateQuery = "UPDATE classes SET booked = booked + 1 WHERE id = ?";
                $updateStmt = $this->mysqli->prepare($updateQuery);
                $updateStmt->bind_param("i", $classId);
                $updateStmt->execute();

                // Simpan reservasi
                $reservationQuery = "INSERT INTO reservations (member_id, class_id) VALUES (?, ?)";
                $reservationStmt = $this->mysqli->prepare($reservationQuery);
                $reservationStmt->bind_param("ii", $memberId, $classId);
                if ($reservationStmt->execute()) {
                    return ["message" => "Reservasi berhasil untuk kelas: " . $class['name']];
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

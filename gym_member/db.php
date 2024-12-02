<?php
$mysqli = new mysqli("localhost", "root", "123456", "gym_system");

if ($mysqli->connect_error) {
    die("Koneksi gagal: " . $mysqli->connect_error);
} 
?>

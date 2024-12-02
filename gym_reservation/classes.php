<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kelas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        h1 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        button {
            padding: 5px 10px;
        }
    </style>
</head>
<body>
    <h1>Daftar Kelas</h1>
    <?php if (isset($_SESSION['user'])): ?>
        <p>Welcome, <?php echo htmlspecialchars($_SESSION['user']['name']); ?>!</p>

        <table>
            <tr>
                <th>Nama Kelas</th>
                <th>Jadwal</th>
                <th>Kapasitas</th>
                <th>Sudah Dipesan</th>
                <th>Aksi</th>
            </tr>
            <?php
            // Mengambil data kelas dari API menggunakan cURL
            $apiUrl = 'http://172.20.10.2/gym_a/api_classes.php';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $apiUrl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $classesJson = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); // Ambil kode HTTP
            curl_close($ch);

            // Debugging: Tampilkan kode HTTP dan respons
            if ($httpCode !== 200) {
                echo "<tr><td colspan='5'>Error fetching data from API. HTTP Code: $httpCode</td></tr>";
            } else {
                $classes = json_decode($classesJson, true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    echo "<tr><td colspan='5'>Error decoding JSON: " . json_last_error_msg() . "</td></tr>";
                } elseif (empty($classes)) {
                    echo "<tr><td colspan='5'>Tidak ada kelas yang tersedia.</td></tr>";
                } else {
                    foreach ($classes as $class):
            ?>
                        <tr>
                            <td><?php echo htmlspecialchars($class['name']); ?></td>
                            <td><?php echo date('Y-m-d H:i', strtotime($class['schedule'])); ?></td>
                            <td><?php echo htmlspecialchars($class['capacity']); ?></td>
                            <td><?php echo htmlspecialchars($class['booked']); ?></td>
                            <td>
                                <form method="POST" action="reservasi.php">
                                    <input type="hidden" name="class_id" value="<?php echo htmlspecialchars($class['id']); ?>">
                                    <button type="submit">Reservasi</button>
                                </form>
                            </td>
                        </tr>
            <?php
                    endforeach;
                }
            }
            ?>
        </table>
    <?php else: ?>
        <p>Please <a href="http://172.20.10.3/gym_system/login.php">login</a> to reserve a class.</p>
    <?php endif; ?>
</body>
</html>

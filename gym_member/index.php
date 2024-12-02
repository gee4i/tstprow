<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Utama</title>
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
        nav {
            margin-bottom: 20px;
        }
        nav a {
            margin-right: 15px;
            text-decoration: none;
            color: #007BFF;
        }
        .classes {
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Selamat Datang di Sistem Keanggotaan Gym</h1>
    
    <nav>
        <?php if (isset($_SESSION['user'])): ?>
            <span>Halo, <?php echo $_SESSION['user']['name']; ?>!</span>
            <a href="logout.php">Logout</a>
            <a href="http://172.20.10.2/gym_a/admin_dashboard.php">Dasbor Admin</a>
        <?php else: ?>
            <a href="http://172.20.10.3/gym_system/login.php">Login</a>
            <a href="http://172.20.10.3/gym_system/register.php">Register</a>
        <?php endif; ?>
    </nav>

    <?php if (isset($_SESSION['user'])): ?>
        <h2>Daftar Kelas</h2>
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
                            <td><?php echo htmlspecialchars($class['nama']); ?></td>
                            <td><?php echo date('Y-m-d H:i', strtotime($class['schedule'])); ?></td>
                            <td><?php echo htmlspecialchars($class['capacity']); ?></td>
                            <td><?php echo htmlspecialchars($class['booked']); ?></td>
                            <td>
                                <?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Utama</title>
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
        nav {
            margin-bottom: 20px;
        }
        nav a {
            margin-right: 15px;
            text-decoration: none;
            color: #007BFF;
        }
        .classes {
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Selamat Datang di Sistem Keanggotaan Gym</h1>
    
    <nav>
        <?php if (isset($_SESSION['user'])): ?>
            <span>Halo, <?php echo $_SESSION['user']['name']; ?>!</span>
            <a href="logout.php">Logout</a>
            <a href="http://172.20.10.2/gym_a/admin_dashboard.php">Dasbor Admin</a>
        <?php else: ?>
            <a href="http://172.20.10.3/gym_system/login.php">Login</a>
            <a href="http://172.20.10.3/gym_system/register.php">Register</a>
        <?php endif; ?>
    </nav>

    <?php if (isset($_SESSION['user'])): ?>
        <h2>Daftar Kelas</h2>
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
                            <td><?php echo htmlspecialchars($class['nama']); ?></td>
                            <td><?php echo date('Y-m-d H:i', strtotime($class['schedule'])); ?></td>
                            <td><?php echo htmlspecialchars($class['capacity']); ?></td>
                            <td><?php echo htmlspecialchars($class['booked']); ?></td>
                            <td>
                            <button onclick="reserveClass(<?php echo htmlspecialchars((int)$class['id']); ?>, <?php echo htmlspecialchars((int)$_SESSION['user']['id']); ?>)">Reservasi</button>
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

    <script>
        function reserveClass(classId, memberId) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "http://172.20.10.2/gym_a/soap_api_reservasi.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            var params = "classId=" + classId + "&memberId=" + 1;

            xhr.onload = function() {
                if (xhr.status === 200) {
                    alert(xhr.responseText); // Display reservation result
                } else {
                    alert('Error: ' + xhr.statusText); // Handle errors
                }
            };

            xhr.send(params); // Send the SOAP reservation request
        }
    </script>
</body>
</html>

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

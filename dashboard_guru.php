<?php
session_start();

// Memeriksa apakah pengguna sudah login sebagai guru
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'guru') {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sistem E-Learning - Dashboard Guru</title>

    <?php 
        include 'components/css.php';
    ?>
</head>
<body>
    <h2>Selamat datang, <?php echo $_SESSION['username']; ?> (Guru)</h2>
    <a href="logout.php">Logout</a>
    <hr>
    <p>Berikut adalah daftar mata pelajaran yang anda ampu:</p>
    <table>
        <thead>
            <tr>
                <th>Mata Pelajaran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
                include 'koneksi.php';

                $username = $_SESSION['username'];

                $sql = "SELECT * FROM mata_pelajaran WHERE username_guru = '$username'";
                $result = $koneksi->query($sql);
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row['nama'] . '</td>';
                    echo '<td><a href="detail_mapel.php?id=' . $row['id'] . '">Detail</a></td>';
                    echo '</tr>';
                }

                $koneksi->close();
            ?>
        </tbody>
    </table>
</body>
</html>

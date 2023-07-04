<?php
session_start();

// Memeriksa apakah pengguna sudah login sebagai siswa
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'siswa') {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sistem E-Learning - Dashboard Siswa</title>

    <?php 
    include 'components/css.php';
    ?>
</head>
<body>
    <h1>Selamat datang, <?php echo $_SESSION['username']; ?> (Siswa)</h1>
    <a href="logout.php">Logout</a>
    <hr>
    <a href="semua_mapel.php">Daftar Semua Mata Pelajaran</a><br>
    <p>Berikut adalah daftar mata pelajaran yang anda ambil (enrolled):</p>
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

                $sql = "SELECT 
                        mata_pelajaran.nama AS nama_mapel, 
                        mata_pelajaran.id AS id_mapel 
                        FROM 
                        siswa, siswa_enrolled_mapel, mata_pelajaran 
                        WHERE 
                        siswa.username = siswa_enrolled_mapel.username_siswa 
                        AND 
                        siswa_enrolled_mapel.id_mapel = mata_pelajaran.id 
                        AND 
                        siswa.username = '$username'";
                $result = $koneksi->query($sql);
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row['nama_mapel'] . '</td>';
                    echo '<td><a href="detail_mapel.php?id=' . $row['id_mapel'] . '">Detail</a></td>';
                    echo '</tr>';
                }

                $koneksi->close();
                ?>
        </tbody>
    </table>
</body>
</html>

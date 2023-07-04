<?php
include 'koneksi.php';

session_start();

// Memeriksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

$role = $_SESSION['role'];

// Mendapatkan ID materi pelajaran dari parameter URL
$id = $_GET['id'];

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

$username = $_SESSION['username'];

$sql = "SELECT 
*
FROM 
siswa_enrolled_mapel
WHERE
siswa_enrolled_mapel.id_mapel = '$id'
AND
siswa_enrolled_mapel.username_siswa = '$username'";

$result = $koneksi->query($sql);
$row = $result->fetch_assoc();
if ($_SESSION['role'] == 'siswa' && !$row) {
    echo '<form method="post" action="enroll.php"><input type="hidden" name="id" value="' . $id . '"/><button type="submit">Enroll Me</button></form>';
}

$sql = "SELECT * FROM mata_pelajaran WHERE id = '$id'";
$result = $koneksi->query($sql);


if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "<h2>" . $row['nama'] . "</h2>";
    echo "<hr>";
    if ($role == 'guru') {
        include 'components/tambah_materi.php';
        include 'components/tambah_tugas.php';
        echo "<hr>";
    }
} else {
    echo "Materi pelajaran tidak ditemukan.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Mapel</title>

    <?php 
        include 'components/css.php';
    ?>
</head>
<body>
    <?php 

        $id = $_GET['id'];

        $sql = "(SELECT 'materi' AS jenis, judul_materi AS judul, created_at, id FROM materi WHERE id_mapel = '$id')
        UNION
        (SELECT 'tugas' AS jenis, judul_tugas AS judul, created_at, id FROM tugas WHERE id_mapel = '$id')
        ORDER BY created_at
                ";

        $result = $koneksi->query($sql);

        if ($result) {
            echo "Semua materi dan tugas: ";
            while ($row = $result->fetch_assoc()) {
                // Lakukan sesuatu dengan data yang diperoleh
                if ($row['jenis'] == 'materi') {
                    echo '<div>';
                    echo '<h2> <a href="detail_materi.php?id=' . $row['id'] . '">' . $row['judul'] . ' (materi)</a></h2>';
                    echo '</div>';
                } else {
                    echo '<div>';
                    echo '<h2> <a href="detail_tugas.php?id=' . $row['id'] . '">' . $row['judul'] . ' (tugas)</a></h2>';
                    echo '</div>';
                }
            }
        } else {
            echo "Error: " . $sql . "<br>" . $koneksi->error;
        }

    ?>
</body>
</html>

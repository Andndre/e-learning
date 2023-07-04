<?php
session_start();

// Memeriksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

// Mendapatkan daftar materi pelajaran dari database (Anda perlu mengkoneksikan ke database dan mengambil data sesuai struktur tabel yang diberikan)

// Contoh pengambilan data menggunakan mysqli
$host = "localhost";
$username = "root";
$password = "";
$database = "e-learning";

$koneksi = new mysqli($host, $username, $password, $database);

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

$sql = "SELECT * FROM mata_pelajaran";
$result = $koneksi->query($sql);

if ($result->num_rows > 0) {
    // Loop melalui setiap mata pelajaran
    while ($row = $result->fetch_assoc()) {
        echo "<a href='detail_materi.php?id=" . $row['id'] . "'>" . $row['nama'] . "</a><br>";
    }
} else {
    echo "Tidak ada mata pelajaran.";
}

$koneksi->close();
?>

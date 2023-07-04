<?php
// Koneksi ke database (Anda perlu mengisi detail koneksi sesuai dengan pengaturan database Anda)
$host = "localhost";
$username_db = "root";
$password_db = "";
$database = "e-learning";

$koneksi = new mysqli($host, $username_db, $password_db, $database);

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Mendapatkan data registrasi dari form
$role = $_POST['role'];
$nama = $_POST['nama'];
$username = $_POST['username'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$alamat = $_POST['alamat'];
$agama = $_POST['agama'];
$no_telp = $_POST['no_telp'];

// Validasi password
if ($password !== $confirm_password) {
    header('Location: register.php');
    exit;
}

// Melakukan query untuk menambahkan data pengguna baru
if ($role === 'guru') {
    $table = 'guru';
} elseif ($role === 'siswa') {
    $table = 'siswa';
}

$sql = "INSERT INTO $table (nama, username, pass, alamat, agama, no_telp) VALUES ('$nama', '$username', '$password', '$alamat', '$agama', '$no_telp')";

if ($koneksi->query($sql) === true) {
    // Registrasi berhasil
    header('Location: login.php');
    exit;
} else {
    // Registrasi gagal
    echo "Error: " . $sql . "<br>" . $koneksi->error;
}

$koneksi->close();
?>

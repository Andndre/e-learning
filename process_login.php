<?php
session_start();

$host = "localhost";
$db_username = "root";
$db_password = "";
$database = "e-learning";

// Memeriksa apakah pengguna telah login sebelumnya
if (isset($_SESSION['username']) && isset($_SESSION['role'])) {
    header('Location: index.php');
    exit;
}

// Memeriksa apakah ada pengiriman data dari form login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mendapatkan data yang dikirimkan dari form
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Validasi pengisian form (Anda dapat menambahkan validasi tambahan sesuai kebutuhan)
    if (empty($username) || empty($password) || empty($role)) {
        $error = 'Mohon lengkapi semua field.';
        header('Location: login.php?error=' . urlencode($error));
        exit;
    }

    // Menghubungkan ke database
    $conn = mysqli_connect('localhost', $db_username, $db_password, $database);

    // Memeriksa koneksi database
    if (mysqli_connect_errno()) {
        $error = 'Gagal terhubung ke database.';
        header('Location: login.php?error=' . urlencode($error));
        exit;
    }

    // Menghindari serangan SQL injection
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    // Membuat query berdasarkan peran (guru atau siswa)
    if ($role === 'guru') {
        $query = "SELECT * FROM guru WHERE username = '$username' AND pass = '$password'";
    } else {
        $query = "SELECT * FROM siswa WHERE username = '$username' AND pass = '$password'";
    }

    // Menjalankan query
    $result = mysqli_query($conn, $query);

    // Memeriksa apakah query berhasil dijalankan
    if ($result) {
        // Memeriksa jumlah baris data yang ditemukan
        $count = mysqli_num_rows($result);
        if ($count === 1) {
            // Login berhasil, menyimpan informasi pengguna ke dalam session
            $user = mysqli_fetch_assoc($result);
            $_SESSION['username'] = $user['username'];
            
            $_SESSION['role'] = $role;
            if ($role == 'guru') {
                header('Location: dashboard_guru.php');
            } else {
                header('Location: dashboard_siswa.php');
            }
            exit;
        } else {
            $error = 'Username atau password salah.';
            header('Location: login.php?error=' . urlencode($error));
            exit;
        }
    } else {
        $error = 'Terjadi kesalahan saat melakukan login.';
        header('Location: login.php?error=' . urlencode($error));
        exit;
    }

    // Menutup koneksi ke database
    mysqli_close($conn);
}
?>

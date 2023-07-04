<?php
session_start();

// Memeriksa apakah pengguna telah login
if (isset($_SESSION['username']) && isset($_SESSION['role'])) {
    $username = $_SESSION['username'];
    $role = $_SESSION['role'];
    // Menampilkan link menuju dashboard berdasarkan peran pengguna
    if ($role === 'guru') {
        header('Location: dashboard_guru.php');
    } else if ($role === 'siswa') {
        header('Location: dashboard_siswa.php');
    }
} else {
    header('Location: login.php');
}
?>

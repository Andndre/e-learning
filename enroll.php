<?php 
include 'koneksi.php';

session_start();

$username = $_SESSION['username'];

if (!isset($username)) {
	header('Location: login.php');
	exit;
}

$role = $_SESSION['role'];
if ($role == 'guru') {
	echo 'Guru tidak bisa enroll pada mata pelajaran';
	exit;
}

$id = $_POST['id'];

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
	 $sql = "INSERT INTO siswa_enrolled_mapel (id_mapel, username_siswa) VALUES ('$id', '$username')";
	 $result = $koneksi->query($sql);
	 if (!$result) {
		 echo "Error: " . $sql . "<br>" . $koneksi->error;
	 } else {
		 echo "Berhasil terenroll.";
	 }
}
?>

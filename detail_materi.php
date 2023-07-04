<?php 
include 'koneksi.php';

session_start();

$id = $_GET['id'];
$username = $_SESSION['username'];

$sql = "SELECT 
siswa.username 
FROM 
siswa, siswa_enrolled_mapel, mata_pelajaran, materi
WHERE
siswa.username = siswa_enrolled_mapel.username_siswa
AND
siswa_enrolled_mapel.id_mapel = mata_pelajaran.id
AND
materi.id_mapel = mata_pelajaran.id
AND
materi.id = '$id'
AND
siswa.username = '$username'";

$result = $koneksi->query($sql);
$siswa_enrolled = $result->fetch_assoc();

if ($_SESSION['role'] == 'siswa' && !$siswa_enrolled) {
	echo "Anda harus terenroll dulu!";
	exit;
}

$sql = "SELECT * FROM materi WHERE id = '$id'";

$result = $koneksi->query($sql);

if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
	echo "<h1>" . $row['judul_materi'] . "</h1>";
	echo "<hr>";
	echo "<p>" . $row['teks'] . "</p>";
}

?>

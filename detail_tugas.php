<?php 
include 'koneksi.php';

session_start();

$id = $_GET['id'];

$sql = "SELECT * FROM tugas WHERE id = '$id'";

$result = $koneksi->query($sql);

if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
	echo "<h1>" . $row['judul_tugas'] . "</h1>";
	echo "<hr>";
	echo "<p>" . $row['deskripsi_tugas'] . "</p>";
}

?>

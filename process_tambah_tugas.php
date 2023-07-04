<?php 
include 'koneksi.php';

$id = $_POST['id'];
$judul_tugas = $_POST['judul_tugas'];
$deskripsi_tugas = $_POST['deskripsi_tugas'];
$deadline = $_POST['deadline'];

$id_tugas = substr(md5(microtime()),rand(0,26),6);

$sql = "INSERT INTO tugas (id, id_mapel, judul_tugas, deskripsi_tugas, deadline) VALUES ('$id_tugas',  '$id', '$judul_tugas', '$deskripsi_tugas', '$deadline')";
$result = $koneksi->query($sql);
// jika error
if (!$result) {
		echo "Error: " . $sql . "<br>" . $koneksi->error;
} else {
		echo "Tugas berhasil ditambahkan.";
}
?>

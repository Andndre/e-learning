<?php 
include 'koneksi.php';

$id = $_POST['id'];
$judul_materi = $_POST['judul_materi'];
$teks = $_POST['teks'];

$id_materi = substr(md5(microtime()),rand(0,26),6);

$sql = "INSERT INTO materi (id, id_mapel, judul_materi, teks) VALUES ('$id_materi', '$id' , '$judul_materi', '$teks')";
$result = $koneksi->query($sql);
// jika error
if (!$result) {
		echo "Error: " . $sql . "<br>" . $koneksi->error;
} else {
		echo "Materi berhasil ditambahkan.";
}
?>

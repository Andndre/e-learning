<h2>Tambah Materi</h2>
<form action="process_tambah_materi.php" method="POST">
	<input type="text" style="display: none;" name="id" value="<?php echo $_GET['id']; ?>">
	<label for="judul">Judul Materi</label>
	<input type="text" id="judul" name="judul_materi">
	<label for="teks">Teks</label>
	<textarea id="teks" name="teks"></textarea>
	<button type="submit" name="tambahMateri">Tambah</button>
</form>

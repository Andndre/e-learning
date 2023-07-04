<h2>Tambah Tugas</h2>
<form action="process_tambah_tugas.php" method="POST">
		<input type="text" style="display: none;" name="id" value="<?php echo $_GET['id']; ?>">
		<label for="judul">Judul Tugas</label>
		<input type="text" id="judul" name="judul_tugas">
		<label for="teks">Deskripsi Tugas</label>
		<textarea id="teks" name="deskripsi_tugas"></textarea>
		<label for="timestamp">Deadline</label>
	<input type="datetime-local" id="timestamp" name="deadline">
		<button type="submit" name="tambahTugas">Tambah</button>
</form>

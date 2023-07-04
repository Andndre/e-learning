<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Semua mata pelajaran</title>

	<?php
		include 'components/css.php';
	?>
</head>
<body>
	<table>
		<thead>
			<tr>
				<th>Mata Pelajaran</th>
				<th>Pengampu</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php
				include 'koneksi.php';
				$sql = "SELECT mata_pelajaran.*, guru.nama AS nama_guru FROM mata_pelajaran, guru WHERE mata_pelajaran.username_guru = guru.username;";
				$result = $koneksi->query($sql);
				while ($row = $result->fetch_assoc()) {
					echo '<tr>';
					echo '<td>' . $row['nama'] . '</td>';
					echo '<td>' . $row['nama_guru'] . '</td>';
					echo '<td><a href="detail_mapel.php?id=' . $row['id'] . '">Detail</a></td>';
					echo '</tr>';
				}
				$koneksi->close();
			?>
		</tbody>

	</table>

</body>
</html>

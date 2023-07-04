<!-- register.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Registrasi Guru/Siswa</title>
</head>
<body>
    <h2>Registrasi Guru/Siswa</h2>
    <form method="post" action="process_register.php">
        <label for="role">Pilih peran:</label>
        <select name="role" id="role">
            <option value="guru">Guru</option>
            <option value="siswa">Siswa</option>
        </select>
        <br>
        <label for="nama">Nama:</label>
        <input type="text" name="nama" id="nama" required>
        <br>
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
        <br>
        <label for="confirm_password">Konfirmasi Password:</label>
        <input type="password" name="confirm_password" id="confirm_password" required>
        <br>
        <label for="alamat">Alamat:</label>
        <textarea name="alamat" id="alamat" required></textarea>
        <br>
        <label for="agama">Agama:</label>
        <input type="text" name="agama" id="agama" required>
        <br>
        <label for="no_telp">No. Telepon:</label>
        <input type="text" name="no_telp" id="no_telp" required>
        <br>
        <input type="submit" value="Register">
    </form>
</body>
</html>

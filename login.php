<!DOCTYPE html>
<html>
<head>
    <title>Login - Sistem E-Learning</title>
</head>
<body>
    <h2>Login - Sistem E-Learning</h2>
    <form method="POST" action="process_login.php">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username"><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password"><br><br>
        <label for="role">Role:</label>
        <select id="role" name="role">
            <option value="guru">Guru</option>
            <option value="siswa">Siswa</option>
        </select><br><br>
        <button type="submit">Login</button>
        <?php
        if (isset($_GET['error'])) {
            $error = $_GET['error'];
            echo '<div style="color: red;">' . $error . '</div>';
        }
        ?>
    </form>
</body>
</html>

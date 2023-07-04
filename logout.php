<?php
session_start();

// Menghapus data session dan melakukan redirect ke halaman login
session_destroy();
header('Location: login.php');
exit;
?>

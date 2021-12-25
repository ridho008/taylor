<?php  
session_start();
session_unset();
session_destroy();

echo "<script>alert('Anda Berhasil Keluar.');window.location='login.php';</script>";


?>
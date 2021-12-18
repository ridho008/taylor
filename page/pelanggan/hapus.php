<?php 
require '../../config/db.php';
require '../../config/function.php';
$id = $_GET['id'];

$sql = mysqli_query($conn, "DELETE FROM user WHERE id_user = $id");
if($sql) {
      echo "<script>alert('Data pelanggan Berhasil Dihapus.');window.location='pelanggan.php';</script>";
   } else {
      echo "<script>alert('Data pelanggan Gagal Dihapus.');window.location='pelanggan.php';</script>";
   }

?>
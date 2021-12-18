<?php 
require '../../config/db.php';
require '../../config/function.php';
$id = $_GET['id'];

$sql = mysqli_query($conn, "DELETE FROM penjualan135 WHERE id_pen135 = $id");
if($sql) {
      echo "<script>alert('Data penjualan Berhasil Dihapus.');window.location='penjualan.php';</script>";
   } else {
      echo "<script>alert('Data penjualan Gagal Dihapus.');window.location='penjualan.php';</script>";
   }

?>
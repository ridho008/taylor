<?php 
require '../../config/db.php';
require '../../config/function.php';
$id_transaksi = $_GET['id'];

$sql = mysqli_query($conn, "DELETE FROM transaksi WHERE id_transaksi = $id_transaksi");
if($sql) {
      echo "<script>alert('Data transaksi Berhasil Dihapus.');window.location='transaksi.php';</script>";
   } else {
      echo "<script>alert('Data transaksi Gagal Dihapus.');window.location='transaksi.php';</script>";
   }

?>
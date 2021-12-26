<?php 
require '../../config/db.php';
require '../../config/function.php';
$id = $_GET['id'];

$sql = mysqli_query($conn, "DELETE FROM nota WHERE id_nota = $id");
if($sql) {
      mysqli_query($conn, "DELETE FROM transaksi WHERE id_nota = $id");
      echo "<script>alert('Data nota Berhasil Dihapus.');window.location='nota.php';</script>";
   } else {
      echo "<script>alert('Data nota Gagal Dihapus.');window.location='nota.php';</script>";
   }

?>
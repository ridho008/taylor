<?php 
require '../../config/db.php';
require '../../config/function.php';
$id_nota = $_GET['id'];

$query = mysqli_query($conn, "UPDATE nota SET status = '1' WHERE id_nota = $id_nota");

if ($query) {
   echo "<script>alert('Pesanan Berhasil Disetujui.');window.location='index.php';</script>";
} else {
   echo "<script>alert('Pesanan Gagal Disetujui.');window.location='index.php';</script>";
}

?>
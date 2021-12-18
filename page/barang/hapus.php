<?php 
require '../../config/db.php';
require '../../config/function.php';
$id = $_GET['id'];

$gambar_brg = mysqli_query($conn, "SELECT * FROM barang WHERE id_barang = $id");
$root = mysqli_fetch_assoc($gambar_brg);
$sql = mysqli_query($conn, "DELETE FROM barang WHERE id_barang = $id");
// var_dump($root['gambar_brg']); die;
if($sql) {
      if (!empty($root)) {
         unlink('../../img/barang/' . $root['gambar_brg']);
      } else {
         echo "<script>alert('Data Barang Berhasil Dihapus.');window.location='barang.php';</script>";
      }
   } else {
      echo "<script>alert('Data Barang Gagal Dihapus.');window.location='barang.php';</script>";
   }

?>
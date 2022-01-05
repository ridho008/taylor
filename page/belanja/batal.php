<?php 
require '../../config/db.php';
require '../../config/function.php';
$id_nota = $_GET['id'];

$resultNota = query("SELECT * FROM nota WHERE id_nota = $id_nota")[0];
$rowBanyaknya = $resultNota['banyaknya'];
$rowIdBrg = $resultNota['id_barang'];
$resultBarang = query("SELECT * FROM barang WHERE id_barang = $rowIdBrg")[0];
$stokBrg = $resultBarang['stok'];
// var_dump($rowBanyaknya, $stokBrg); die;
$kembalikanJumlahStokBarang = intval($rowBanyaknya) + intval($stokBrg);
$hasilnya = abs($kembalikanJumlahStokBarang);

$query = mysqli_query($conn, "UPDATE nota SET status = '2' WHERE id_nota = $id_nota");
$queryTransaksiDelete = mysqli_query($conn, "DELETE FROM transaksi WHERE id_nota = $id_nota");

if ($queryTransaksiDelete) {
   if ($query) {
      mysqli_query($conn, "UPDATE barang SET stok = '$hasilnya' WHERE id_barang = $rowIdBrg");
      echo "<script>alert('Pesanan Berhasil Dibatalkan.');window.location='index.php';</script>";
   } else {
      echo "<script>alert('Pesanan Gagal Dibatalkan.');window.location='index.php';</script>";
   }
}

?>
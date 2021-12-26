
<?php 
require '../../config/db.php';
require '../../config/function.php';
session_start();
$query = query("SELECT * FROM transaksi LEFT JOIN user ON transaksi.id_user = user.id_user LEFT JOIN nota ON transaksi.id_nota = nota.id_nota");
// var_dump($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Daftar Transaksi SURYA TAYLOR</title>
</head>
<body>
   <h1 align="center">Laporan Transaksi SURYA TAYLOR</h2>
   <table border="1" cellpadding="8" cellspacing="0" width="100%">
      <thead>
         <tr>
            <th>No</th>
            <th>Pelanggan</th>
            <th>Harga</th>
            <th>Total</th>
            <th>Tipe</th>
         </tr>
      </thead>
      <tbody>
         <?php $totalTransaksi = 0; ?>
         <?php $no = 1; foreach($query as $k) : ?>
         <?php 
            $totalTransaksi += $k['hrg_total'];
            // var_dump($totalTransaksi);
            ?>
            <tr>
               <td><?= $no++; ?></td>
               <td><?= $k['nama_user'] ?></td>
               <td><?= number_format($k['harga'], 0, ',', ',') ?></td>
               <td><?= number_format($k['hrg_total'], 0, ',', ',') ?></td>
               <td><?= $k['tipe'] ?></td>
            </tr>
         <?php endforeach; ?>
      </tbody>
      <tfoot>
         <tr>
            <!-- <td colspan="6"></td> -->
            <td colspan="5" align="center"><b>Sub Total</b> <?= number_format($totalTransaksi,0, ',', '.'); ?></td>
         </tr>
      </tfoot>
   </table>
         <table width="100%">
      <tr>
         <td></td>
         <td width="200">
            <p>Pekanbaru, Sukajadi <?= date('Y-m-d'); ?></p>
            <br>
            Surya Taylor, 
            <br><br><br>
            <p>__________________</p>
         </td>
      </tr>
   </table>

   <script>
      window.print();
   </script>
</body>
</html>
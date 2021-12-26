<?php 
require '../../config/db.php';
require '../../config/function.php';
session_start();
$query = query("SELECT * FROM nota INNER JOIN user ON nota.id_user = user.id_user INNER JOIN barang ON barang.id_barang = nota.id_barang LEFT JOIN transaksi ON nota.id_nota = transaksi.id_nota");
$q = query("SELECT * FROM nota INNER JOIN transaksi ON nota.id_nota = transaksi.id_nota WHERE tipe = 'vermak'");
// var_dump($q);
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Laporan Nota Baju & Celana Buat Baru</title>
</head>
<body>
   <?php if(isset($_GET['act'])) : ?>
      <?php if($_GET['act'] == 'baru') : ?>
         <h1 align="center">Laporan NOTA SURYA TAYLOR</h1>
         <table border="1" cellpadding="8" cellspacing="0" width="100%">
               <thead>
                  <tr>
                     <th>No</th>
                     <th>Pelanggan</th>
                     <th>Barang</th>
                     <th>Harga</th>
                     <th>Banyaknya</th>
                     <th>Tipe</th>
                     <th>Total</th>
                  </tr>
               </thead>
               <tbody>
                  <?php 
                  $total = 0;
                  ?>
                  <?php $no = 1; foreach($query as $k) : ?>
                  <?php 
                  $total += $k['hrg_total'];
                  // var_dump($total);
                  ?>
                     <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $k['nama_user'] ?></td>
                        <td><?= $k['nama_barang'] ?></td>
                        <td><?= number_format($k['harga'], 0, ',', '.') ?></td>
                        <td><?= $k['banyaknya'] ?></td>
                        <td><?= $k['tipe'] ?></td>
                        <td><?= number_format($k['hrg_total'], 0, ',', '.') ?></td>
                     </tr>
                  <?php endforeach; ?>
               </tbody>
               <tfoot>
                  <tr>
                     <td colspan="6"></td>
                     <td colspan="7"><b>Sub Total</b> <?= number_format($total,0, ',', '.'); ?></td>
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
      <?php elseif($_GET['act'] == 'vermak') : ?>
         <h1 align="center">Laporan Vermak Surya Taylor</h1>
         <table cellpadding="8" cellspacing="0" border="1" width="100%">
            <thead>
               <tr>
                  <th>No</th>
                  <th>Pelanggan</th>
                  <th>Barang</th>
                  <th>Banyaknya</th>
                  <th>Deskripsi</th>
                  <th>Tipe</th>
                  <th>Total</th>
               </tr>
            </thead>
            <tbody>
               <?php $total = 0; ?>
               <?php $no = 1; foreach($q as $v) : ?>
               <?php $total += $v['hrg_total']; ?>
                  <tr>
                     <td><?= $no++; ?></td>
                     <td><?= $v['nama_pelanggan']; ?></td>
                     <td>
                        <?php if($v['harga'] == 25000) : ?>
                           Potong Sambung - Celana
                        <?php elseif($v['harga'] == 20000) : ?>
                        Potong Biasa - Celana
                        <?php elseif($v['harga'] == 30000) : ?>
                        Kecilkan Pinggang - Celana
                        <?php elseif($v['harga'] == 15000) : ?>
                        Tempel Celana Koyak
                     <?php else: ?>
                        <?php endif; ?>
                     </td>
                     <td><?= $v['banyaknya']; ?></td>
                     <td><?= $v['deskripsi_nota']; ?></td>
                     <td><?= $v['tipe']; ?></td>
                     <td><?= number_format($v['hrg_total'], 0, ',', '.'); ?></td>
                  </tr>
                  <?php endforeach; ?>
            </tbody>
            <tfoot>
                  <tr>
                     <td colspan="6"></td>
                     <td colspan="7"><b>Sub Total</b> <?= number_format($total,0, ',', '.'); ?></td>
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
      <?php endif; ?>
   <?php endif; ?>

   <script>
      window.print();
   </script>
</body>
</html>
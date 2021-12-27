
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
   <h2 align="center">Daftar Transaksi</h2>
   <!-- <a href="tambah.php">Tambah Transaksi</a> -->
   <a href="<?= base_url('') ?>">Utama</a>
   <table border="1" cellpadding="8" cellspacing="0">
      <thead>
         <tr>
            <th>No</th>
            <th>Pelanggan</th>
            <th>Harga</th>
            <th>Tipe</th>
            <th>Total</th>
            <?php if(isset($_SESSION['role'])) : ?>
               <?php if($_SESSION['role'] == 0) : ?>
            <th>Aksi</th>
               <?php endif; ?>
            <?php endif; ?>
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
               <?php if(isset($_SESSION['role'])) : ?>
                  <?php if($_SESSION['role'] == 0) : ?>
               <td>
                  <!-- <a href="edit.php?id=<?= $k['id_user']; ?>">Edit</a> -->
                  <a href="hapus.php?id=<?= $k['id_transaksi']; ?>" onclick="return confirm('Yakin ?')">Hapus</a>
               </td>
                  <?php endif; ?>
               <?php endif; ?>
            </tr>
         <?php endforeach; ?>
      </tbody>
      <tfoot>
         <tr>
            <!-- <td colspan="6"></td> -->
            <?php if(isset($_SESSION['role'])) : ?>
               <?php if($_SESSION['role'] == 1) : ?>
            <td colspan="4" align="center"><b>Sub Total</b> <?= number_format($totalTransaksi,0, ',', '.'); ?></td>
            <td colspan="2"><a href="laporan.php">Cetak Nota</a></td>
               <?php elseif($_SESSION['role'] == 0) : ?>
            <td colspan="5" align="center"><b>Sub Total</b> <?= number_format($totalTransaksi,0, ',', '.'); ?></td>
            <td colspan="2"><a href="laporan.php">Cetak Nota</a></td>
                <?php endif; ?>
            <?php endif; ?>
         </tr>
      </tfoot>
   </table>
</body>
</html>
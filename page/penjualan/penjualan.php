
<?php 
require '../../config/db.php';
require '../../config/function.php';

$query = query("SELECT * FROM penjualan135 INNER JOIN user135 ON penjualan135.id_user135 = user135.id_user135 INNER JOIN kamar135 ON penjualan135.id_kamar135 = kamar135.id_kamar135");
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Daftar Penjualan</title>
</head>
<body>
   <h2 align="center">Daftar Penjualan</h2>
   <a href="tambah.php">Tambah Penjualan</a>
   <a href="<?= base_url('') ?>">Utama</a>
   <table border="1" cellpadding="8" cellspacing="0">
      <thead>
         <tr>
            <th>No</th>
            <th>Nama Pelanggan</th>
            <th>Kamar</th>
            <th>Harga</th>
            <th>Lama Inap</th>
            <th>Diskon</th>
            <th>Aksi</th>
         </tr>
      </thead>
      <tbody>
         <?php $no = 1; foreach($query as $k) : ?>
         <?php 
         
         ?>
            <tr>
               <td><?= $no++; ?></td>
               <td><?= $k['nama_user135'] ?></td>
               <td><?= $k['nama_kmr135'] ?> - <?= $k['kelas135'] ?></td>
               <td><?= number_format($k['harga_sewa135'], 0, ',', '.') ?> / 1 Hari</td>
               <td><?= $k['lama_inap'] ?></td>
               <td>
                  <?php 
                  if ($k['kelas135'] === 'VIP') {
                     $diskon = 90;
                     $totalInap = $k['harga_sewa135'] * $k['lama_inap'];
                     $total = ($diskon * $k['harga_sewa135'] * $k['lama_inap']) / 100; ?>
                     <div style="color: red;">
                        <del>
                     <?= number_format($totalInap,0 ,',', '.'); ?></div>
                     </del>
                     <p>Diskon 90%</p>
                     <mark><?= number_format($total,0 ,',', '.'); ?></mark>
                     <?php
                  } else {
                     echo number_format($k['harga_sewa135'],0 ,',', '.');
                  }
                  ?>
               </td>
               <td>
                  <a href="edit.php?id=<?= $k['id_pen135']; ?>">Edit</a>
                  <a href="hapus.php?id=<?= $k['id_pen135']; ?>" onclick="return confirm('Yakin ?')">Hapus</a>
               </td>
            </tr>
         <?php endforeach; ?>
      </tbody>
   </table>
</body>
</html>
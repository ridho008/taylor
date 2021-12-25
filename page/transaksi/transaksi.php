
<?php 
require '../../config/db.php';
require '../../config/function.php';

$query = query("SELECT * FROM transaksi INNER JOIN user ON transaksi.id_user = user.id_user INNER JOIN nota ON transaksi.id_nota = nota.id_nota INNER JOIN barang ON barang.id_barang = nota.id_barang");
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Daftar Transaksi</title>
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
            <th>Barang</th>
            <th>Aksi</th>
         </tr>
      </thead>
      <tbody>
         <?php $no = 1; foreach($query as $k) : ?>
            <tr>
               <td><?= $no++; ?></td>
               <td><?= $k['nama_user'] ?></td>
               <td><?= number_format($k['harga'], 0, ',', ',') ?></td>
               <td><?= $k['nama_barang'] ?></td>
               <td>
                  <!-- <a href="edit.php?id=<?= $k['id_user']; ?>">Edit</a> -->
                  <a href="hapus.php?id=<?= $k['id_transaksi']; ?>" onclick="return confirm('Yakin ?')">Hapus</a>
               </td>
            </tr>
         <?php endforeach; ?>
      </tbody>
   </table>
</body>
</html>
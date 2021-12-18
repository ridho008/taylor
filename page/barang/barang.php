
<?php 
require '../../config/db.php';
require '../../config/function.php';

$queryBarang = query("SELECT * FROM barang");
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Daftar Barang</title>
</head>
<body>
   <h2 align="center">Daftar Barang</h2>
   <a href="tambah.php">Tambah Barang</a>
   <a href="<?= base_url('') ?>">Utama</a>
   <table border="1" cellpadding="8" cellspacing="0">
      <thead>
         <tr>
            <th>No</th>
            <th>Gambar</th>
            <th>Barang</th>
            <th>warna</th>
            <th>stok</th>
            <th>Harga</th>
            <th>Deskripsi</th>
            <th>Aksi</th>
         </tr>
      </thead>
      <tbody>
         <?php $no = 1; foreach($queryBarang as $k) : ?>
            <tr>
               <td><?= $no++; ?></td>
               <td>
                  <img src="<?= base_url('img/barang/' . $k['gambar_brg']) ?>" width="100">
               </td>
               <td><?= $k['nama_barang'] ?></td>
               <td><?= $k['warna'] ?></td>
               <td><?= $k['stok'] ?></td>
               <td><?= number_format($k['harga_brg'],0,',','.') ?></td>
               <td><?= $k['deskripsi'] ?></td>
               <td>
                  <a href="edit.php?id=<?= $k['id_barang']; ?>">Edit</a>
                  <a href="hapus.php?id=<?= $k['id_barang']; ?>" onclick="return confirm('Yakin ?')">Hapus</a>
               </td>
            </tr>
         <?php endforeach; ?>
      </tbody>
   </table>
</body>
</html>
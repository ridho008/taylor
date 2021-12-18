
<?php 
require '../../config/db.php';
require '../../config/function.php';

$query = query("SELECT * FROM user");
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Daftar Pelanggan</title>
</head>
<body>
   <h2 align="center">Daftar Pelanggan</h2>
   <a href="tambah.php">Tambah Pelanggan</a>
   <a href="<?= base_url('') ?>">Utama</a>
   <table border="1" cellpadding="8" cellspacing="0">
      <thead>
         <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Telepon</th>
            <th>Alamat</th>
            <th>Akses</th>
            <th>Aksi</th>
         </tr>
      </thead>
      <tbody>
         <?php $no = 1; foreach($query as $k) : ?>
            <tr>
               <td><?= $no++; ?></td>
               <td><?= $k['nama_user'] ?></td>
               <td><?= $k['telepon'] ?></td>
               <td><?= $k['alamat'] ?></td>
               <td><?= $k['role'] == '1' ? 'Pelanggan' : 'Administrator'; ?></td>
               <td>
                  <a href="edit.php?id=<?= $k['id_user']; ?>">Edit</a>
                  <a href="hapus.php?id=<?= $k['id_user']; ?>" onclick="return confirm('Yakin ?')">Hapus</a>
               </td>
            </tr>
         <?php endforeach; ?>
      </tbody>
   </table>
</body>
</html>
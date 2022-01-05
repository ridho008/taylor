
<?php 
session_start();
require '../../config/db.php';
require '../../config/function.php';

if (isset($_POST['vermak'])) {
   if(vermak($_POST, $_SESSION['role'] = null) > 0) {
      echo "<script>alert('Pesanan Anda Berhasil Dikirim.');window.location='index.php';</script>";
   } else {
      echo "<script>alert('Pesanan Anda Gagal Dikirim.');window.location='index.php';</script>";
   }
}

$query = query("SELECT * FROM nota INNER JOIN barang ON barang.id_barang = nota.id_barang INNER JOIN user ON user.id_user = nota.id_user WHERE status = 0 AND tipe = 'Baru'");
// var_dump($query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Belanja Masuk - Surya Taylor</title>
   <style>
      table {
         margin: 40px auto;
      }
   </style>
</head>
<body>
   <h2 align="center">Belanja Masuk Surya Taylor</h2>
   <a href="<?= base_url('') ?>">Utama</a>
   <table border="1" cellpadding="8" cellspacing="0">
      <thead>
         <tr>
            <th>No</th>
            <th>Pelanggan</th>
            <th>Barang</th>
            <th>Tipe</th>
            <th>Aksi</th>
         </tr>
      </thead>
      <tbody>
         <?php $no = 1; foreach($query as $k) : ?>
            <tr>
               <td><?= $no++; ?></td>
               <td><?= $k['nama_user'] ?></td>
               <td><?= number_format($k['harga'], 0, ',', ',') ?></td>
               <td><?= $k['tipe'] ?></td>
               <td>
                  <a href="setujui.php?id=<?= $k['id_nota']; ?>" onclick="return confirm('Yakin Menerima Pemesanan ?')">Setujui</a> |
                  <a href="batal.php?id=<?= $k['id_nota']; ?>&stok=<?= $k['id_barang'] ?>" onclick="return confirm('Yakin Membatalkan Pesanan Ini?')">Batalkan</a>
               </td>
            </tr>
         <?php endforeach; ?>
      </tbody>
   </table>
</body>
</html>
<?php 
require '../../config/db.php';
require '../../config/function.php';

$user = query("SELECT * FROM user135");
$kamar = query("SELECT * FROM kamar135");

if (isset($_POST['tambah'])) {
   if(tambah_penjualan($_POST) > 0) {
      echo "<script>alert('Data penjualan Berhasil Ditambahkan.');window.location='penjualan.php';</script>";
   } else {
      echo "<script>alert('Data penjualan Gagal Ditambahkan.');window.location='penjualan.php';</script>";
   }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Tambah Data Penjualan</title>
</head>
<body>
   <h1>Tambah Data Penjualan</h1>
   <form action="" method="post">
      <fieldset>
         <p>
            <label for="nama">Nama Pelanggan: </label>
            <select name="nama" id="nama">
               <option value="">-- Pilih Pelanggan --</option>
               <?php foreach($user as $u) : ?>
                  <option value="<?= $u['id_user135'] ?>"><?= $u['nama_user135'] ?></option>
               <?php endforeach; ?>
            </select>
         </p>
         <p>
            <label for="kamar">kamar Pelanggan: </label>
            <select name="kamar" id="kamar">
               <option value="">-- Pilih Kamar --</option>
               <?php foreach($kamar as $k) : ?>
                     <option value="<?= $k['id_kamar135'] ?>"><?= $k['nama_kmr135'] ?></option>
               <?php endforeach; ?>
            </select>
         </p>
         <p>
            <label for="lama_inap">Lama Inap</label>
            <select name="lama_inap" id="lama_inap">
               <option value="">-- Lama Inap --</option>
               <?php for($i = 1; $i <= 10; $i++) : ?>
                  <option value="<?= $i ?>"><?= $i ?></option>
               <?php endfor; ?>
            </select>
         </p>
         <p>
            <button type="submit" name="tambah">Tambah</button>
            <a href="penjualan.php">Kembali</a>
         </p>
      </fieldset>
   </form>
</body>
</html>
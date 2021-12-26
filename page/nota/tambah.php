<?php 
require '../../config/db.php';
require '../../config/function.php';

$user = query("SELECT * FROM user");
$barang = query("SELECT * FROM barang");

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
   <title>Tambah Data Nota SURYA TAYLOR</title>
</head>
<body>
   <h1>Tambah Data Penjualan</h1>
   <form action="" method="post">
      <fieldset>
         <p>
            <label for="nama_pelanggan">Nama Pelanggan: </label>
            <select name="nama_pelanggan" id="nama_pelanggan">
               <option value="">-- Pilih Pelanggan --</option>
               <?php foreach($user as $u) : ?>
                     <option value="<?= $u['id_user'] ?>"><?= $u['nama_user'] ?></option>
               <?php endforeach; ?>
            </select>
         </p>
         <p>
            <label for="barang">Barang</label>
            <select name="barang" id="barang">
               <option value="">-- Pilih Barang --</option>
               <?php foreach($barang as $b) : ?>
                     <option value="<?= $b['id_barang'] ?>"><?= $b['nama_barang'] ?></option>
               <?php endforeach; ?>
            </select>
         </p>
         <p>
            <label for="banyaknya">Banyaknya</label>
            <input type="number" min="1" value="1" name="banyaknya">
         </p>
         <p>
            <label for="warna">Warna</label>
            <select name="warna" id="warna">
               <option value="">Warna</option>
               <option value="Hitam">Hitam</option>
               <option value="Dongker">Dongker</option>
               <option value="Merah">Merah</option>
               <option value="Putih">Putih</option>
            </select>
         </p>
         <p>
            <input type="text" id="input-masuk">
         </p>
         <p>
            <button type="submit" name="tambah">Tambah</button>
            <a href="nota.php">Kembali</a>
         </p>
      </fieldset>
   </form>

   <script src="../../assets/js/jquery.js"></script>
   <script src="../../assets/js/script.js"></script>
   <script>
      $('#barang').change(function() {
         const id = $(this).val();
         console.log(id)
         $.ajax({
            url : 'http://localhost/taylor/page/nota/proses-barang-ajax.php',
            dataType: 'json',
            method: 'post',
            data : {id: id},
            success: function(response) {
               console.log(response);
               $('#input-masuk').val('3');
            } 
         })
      })
   </script>
</body>
</html>
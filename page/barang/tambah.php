<?php 
require '../../config/db.php';
require '../../config/function.php';

if (isset($_POST['tambah'])) {
   if(tambah_barang($_POST) > 0) {
      echo "<script>alert('Data Barang Berhasil Ditambahkan.');window.location='barang.php';</script>";
   } else {
      echo "<script>alert('Data Barang Gagal Ditambahkan.');window.location='tambah.php';</script>";
   }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Tambah Data Baju & Celana</title>
</head>
<body>
   <h1>Tambah Data Baju & Celana</h1>
   <form action="" method="post" enctype="multipart/form-data">
      <fieldset>
         <p>
            <label for="nama_barang">Nama Barang: </label>
            <input type="text" name="nama_barang" autofocus="on">
         </p>
         <p>
            <label for="stok">Stok</label>
            <input type="number" name="stok" min="1">
         </p>
         <p>
            <label for="harga">Harga/Helai</label>
            <input type="number" name="harga">
         </p>
         <p>
            <label for="warna">Warna</label>
            <select name="warna" id="warna">
               <option value="">-- Pilih Warna --</option>
               <option value="Hitam">Hitam</option>
               <option value="Dongker">Dongker</option>
               <option value="Merah">Merah</option>
               <option value="Putih">Putih</option>
            </select>
         </p>
         <p>
            <label for="deskripsi">deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" cols="30" rows="10"></textarea>
         </p>
         <p>
            <label for="gambar">Gambar</label>
            <input type="file" name="gambar">
         </p>
         <p>
            <button type="submit" name="tambah">Tambah</button>
            <a href="barang.php">Kembali</a>
         </p>
      </fieldset>
   </form>
</body>
</html>
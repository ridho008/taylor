<?php 
require '../../config/db.php';
require '../../config/function.php';

if (isset($_POST['tambah'])) {
   if(tambah_pelanggan($_POST) > 0) {
      echo "<script>alert('Data pelanggan Berhasil Ditambahkan.');window.location='pelanggan.php';</script>";
   } else {
      echo "<script>alert('Data pelanggan Gagal Ditambahkan.');window.location='pelanggan.php';</script>";
   }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Tambah Data Pelanggan</title>
</head>
<body>
   <h1>Tambah Data Pelanggan</h1>
   <form action="" method="post">
      <fieldset>
         <p>
            <label for="nama">Nama Pelanggan: </label>
            <input type="text" name="nama" autofocus="on">
         </p>
         <p>
            <label for="telepon">Telepon Pelanggan: </label>
            <input type="text" name="telepon" min="12">
         </p>
         <p>
            <label for="alamat">Alamat</label>
            <textarea name="alamat" id="alamat" cols="30" rows="10"></textarea>
         </p>
         <p>
            <label for="telepon">Role Akses</label>
            <select name="role" id="role">
               <option value="">-- Role --</option>
               <option value="1">Pelanggan</option>
               <option value="0">Administrator</option>
            </select>
         </p>
         <p>
            <button type="submit" name="tambah">Tambah</button>
            <a href="pelanggan.php">Kembali</a>
         </p>
      </fieldset>
   </form>
</body>
</html>
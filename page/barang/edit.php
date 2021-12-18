<?php 
require '../../config/db.php';
require '../../config/function.php';
$id = $_GET['id'];
$queryMenampilkanBrg = query("SELECT * FROM barang WHERE id_barang = $id")[0];


if (isset($_POST['edit'])) {
   if(edit_barang($_POST) > 0) {
      echo "<script>alert('Data Barang Berhasil Diedit.');window.location='barang.php';</script>";
   } else {
      echo "<script>alert('Data Barang Gagal Diedit.');window.location='edit.php?id=$id';</script>";
   }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Edit Data Data Baju & Celana</title>
</head>
<body>
   <h1>Edit Data Data Baju & Celana</h1>
   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?= $queryMenampilkanBrg['id_barang'] ?>">
      <fieldset>
         <p>
            <label for="nama_barang">Nama Barang: </label>
            <input type="text" name="nama_barang" autofocus="on" value="<?= $queryMenampilkanBrg['nama_barang'] ?>">
         </p>
         <p>
            <label for="stok">Stok</label>
            <input type="number" name="stok" min="10" value="<?= $queryMenampilkanBrg['stok'] ?>">
         </p>
         <p>
            <label for="harga">Harga/Helai</label>
            <input type="number" name="harga" value="<?= $queryMenampilkanBrg['harga_brg'] ?>">
         </p>
         <p>
            <label for="warna">Warna</label>
            <select name="warna" id="warna">
               <option value="">-- Pilih Warna --</option>
               <option value="Hitam" <?= ($queryMenampilkanBrg['warna'] == 'Hitam' ? 'selected' : '') ?>>Hitam</option>
               <option value="Dongker" <?= ($queryMenampilkanBrg['warna'] == 'Dongker' ? 'selected' : '') ?>>Dongker</option>
               <option value="Merah" <?= ($queryMenampilkanBrg['warna'] == 'Merah' ? 'selected' : '') ?>>Merah</option>
               <option value="Putih" <?= ($queryMenampilkanBrg['warna'] == 'Putih' ? 'selected' : '') ?>>Putih</option>
            </select>
         </p>
         <p>
            <label for="deskripsi">deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" cols="30" rows="10"><?= $queryMenampilkanBrg['deskripsi'] ?></textarea>
         </p>
         <p>
            <label for="gambar">Gambar</label><br>
            <img src="<?= base_url('img/barang/' . $queryMenampilkanBrg['gambar_brg']) ?>" width="200">
            <input type="file" name="gambar">
            <input type="hidden" name="gambar_lama" value="<?= $queryMenampilkanBrg['gambar_brg'] ?>">
         </p>
         <p>
            <button type="submit" name="edit">Edit</button>
            <a href="barang.php">Kembali</a>
         </p>
      </fieldset>
   </form>
</body>
</html>
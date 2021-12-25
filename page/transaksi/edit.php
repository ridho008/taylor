<?php 
require '../../config/db.php';
require '../../config/function.php';
$id = $_GET['id'];
$query = query("SELECT * FROM user WHERE id_user = $id")[0];


if (isset($_POST['edit'])) {
   if(edit_pelanggan($_POST) > 0) {
      echo "<script>alert('Data pelanggan Berhasil Diedit.');window.location='pelanggan.php';</script>";
   } else {
      echo "<script>alert('Data pelanggan Gagal Diedit.');window.location='pelanggan.php';</script>";
   }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Edit Data Pelanggan</title>
</head>
<body>
   <h1>Edit Data Pelanggan</h1>
   <form action="" method="post">
      <fieldset>
         <p>
            <input type="hidden" name="id" value="<?= $query['id_user'] ?>">
            <label for="nama">Nama Pelanggan: </label>
            <input type="text" name="nama" autofocus="on" value="<?= $query['nama_user'] ?>">
         </p>
         <p>
            <label for="telepon">Telepon Pelanggan: </label>
            <input type="text" name="telepon" min="12" value="<?= $query['telepon'] ?>">
         </p>
         <p>
            <label for="alamat">Alamat</label>
            <textarea name="alamat" id="alamat" cols="30" rows="10"><?= $query['alamat'] ?></textarea>
         </p>
         <p>
            <label for="telepon">Role Akses</label>
            <select name="role" id="role">
               <option value="">-- Role --</option>
               <option value="1" <?= ($query['role'] == '1' ? 'selected' : ''); ?>>Pelanggan</option>
               <option value="0" <?= ($query['role'] == '0' ? 'selected' : ''); ?>>Administrator</option>
            </select>
         </p>
         <p>
            <button type="submit" name="edit">Edit</button>
            <a href="pelanggan.php">Kembali</a>
         </p>
      </fieldset>
   </form>
</body>
</html>
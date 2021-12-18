<?php 
require '../../config/db.php';
require '../../config/function.php';

$id_pen = $_GET['id'];
$penjual = query("SELECT * FROM penjualan135 INNER JOIN user135 ON penjualan135.id_user135 = user135.id_user135 INNER JOIN kamar135 ON penjualan135.id_kamar135 = kamar135.id_kamar135 WHERE id_pen135 = $id_pen")[0];

$user = query("SELECT * FROM user135");
$kamar = query("SELECT * FROM kamar135");

if (isset($_POST['edit'])) {
   if(edit_penjualan($_POST) > 0) {
      echo "<script>alert('Data penjualan Berhasil Diedit.');window.location='penjualan.php';</script>";
   } else {
      echo "<script>alert('Data penjualan Gagal Diedit.');window.location='penjualan.php';</script>";
   }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Edit Data Penjualan</title>
</head>
<body>
   <h1>Edit Data Penjualan</h1>
   <form action="" method="post">
      <input type="hidden" name="id_pen" value="<?= $penjual['id_pen135']; ?>">
      <fieldset>
         <p>
            <label for="nama">Nama Pelanggan: </label>
            <select name="nama" id="nama">
               <option value="">-- Pilih Pelanggan --</option>
               <?php foreach($user as $u) : ?>
                  <?php 
                  $id_user = $u['id_user135'];
                  $queryPen = mysqli_query($conn, "SELECT * FROM penjualan135 WHERE id_user135 = $id_user");
                  ?>
                  <?php if(!$queryPen) : ?>
                     <option value="">Maaf, Pelanggan Telah Menyewa Kamar Hotel.</option>
                  <?php else : ?>
                     <?php if($penjual['id_user135'] == $u['id_user135']) : ?>
                        <option value="<?= $u['id_user135'] ?>" selected><?= $u['nama_user135'] ?></option>
                     <?php else: ?>
                        <option value="<?= $u['id_user135'] ?>"><?= $u['nama_user135'] ?></option>
                     <?php endif; ?>
                  <?php endif; ?>
               <?php endforeach; ?>
            </select>
         </p>
         <p>
            <label for="kamar">kamar Pelanggan: </label>
            <select name="kamar" id="kamar">
               <option value="">-- Pilih Kamar --</option>
               <?php foreach($kamar as $k) : ?>
                  <?php 
                  $id_kamar = $k['id_kamar135'];
                  $queryKamar = mysqli_query($conn, "SELECT * FROM penjualan135 WHERE id_kamar135 = $id_kamar");
                  ?>
                  <?php if(!$queryKamar) : ?>
                     <option value="">Maaf, Pelanggan Telah Menyewa Kamar Hotel.</option>
                  <?php else: ?>
                     <?php if($penjual['id_kamar135'] == $k['id_kamar135']) : ?>
                        <option value="<?= $k['id_kamar135'] ?>" selected><?= $k['nama_kmr135'] ?></option>
                     <?php else: ?>
                        <option value="<?= $k['id_kamar135'] ?>"><?= $k['nama_kmr135'] ?></option>
                     <?php endif; ?>
                  <?php endif; ?>
               <?php endforeach; ?>
            </select>
         </p>
         <p>
            <label for="lama_inap">Lama Inap</label>
            <select name="lama_inap" id="lama_inap">
               <option value="">-- Lama Inap --</option>
               <?php for($i = 1; $i <= 10; $i++) : ?>
                  <?php if($penjual['lama_inap'] == $i) : ?>
                  <option value="<?= $i ?>" selected><?= $i ?></option>
                  <?php else: ?>
                  <option value="<?= $i ?>"><?= $i ?></option>
                  <?php endif; ?>
               <?php endfor; ?>
            </select>
         </p>
         <p>
            <button type="submit" name="edit">Edit</button>
            <a href="penjualan.php">Kembali</a>
         </p>
      </fieldset>
   </form>
</body>
</html>
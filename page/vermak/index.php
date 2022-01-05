
<?php 
session_start();
require '../../config/db.php';
require '../../config/function.php';

// if(!isset($_SESSION['role'])) {
//   header("Location: ../../login.php");
//   exit;
// }

if (isset($_POST['vermak'])) {
   if(vermak($_POST, $_SESSION['role'] = null) > 0) {
      echo "<script>alert('Pesanan Anda Berhasil Dikirim.');window.location='index.php';</script>";
   } else {
      echo "<script>alert('Pesanan Anda Gagal Dikirim.');window.location='index.php';</script>";
   }
}

if(isset($_SESSION['role'])) {
$namaUser = $_SESSION['nama_user'];
$pelanggan = query("SELECT * FROM user WHERE nama_user = '$namaUser'")[0];
// var_dump($namaUser);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Nota Surya Taylor - Vermak</title>
</head>
<body>
   <h2 align="center">Nota Surya Taylor</h2>
   <a href="<?= base_url('') ?>">Utama</a>
   <fieldset>
      <form action="" method="post">
         <?php if(isset($_SESSION['role']) == 2) : ?>
         <input type="hidden" name="id_user" value="<?= $pelanggan['id_user'] ?>">
         <input type="hidden" name="nama_pelanggan" value="<?= $_SESSION['nama_user'] ?>">
         <?php endif; ?>
         <p>
            <?php if(isset($_SESSION['role'])) : ?>
               <?php if($_SESSION['role'] == 2) : ?>
               <label for="nama_pelanggan">Nama Pelanggan : <?= $_SESSION['nama_user'] ?></label>
               <?php endif; ?> 
            <?php else: ?>
               <label for="nama_pelanggan">Nama Pelanggan</label>
               <input type="text" name="nama_pelanggan">
            <?php endif; ?> 
         </p>
         <p>
            <label for="deskripsi">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" cols="30" rows="10" placeholder="Tulisakan pesanan anda, jenis, desain baju/celana..."></textarea>
         </p>
         <p>
            <label for="banyaknya">Banyaknya</label>
               <input type="number" name="banyaknya" min="1" value="1">
            </p>
         <p>
            <label for="pilih_vermak">Pilihan Vermak</label>
            <select name="pilih_vermak" id="pilih_vermak">
               <option value="">-- Pilih --</option>
               <option value="25000">Potong Sambung - Celana (Rp.25.000)</option>
               <option value="20000">Potong Biasa - Celana (Rp.20.000)</option>
               <option value="30000">Kecilkan Pinggang - Celana (Rp.30.000)</option>
               <option value="15000">Tempel Celana Koyak (Rp.15.000)</option>
            </select>
         </p>
         <p>
            <button type="submit" name="vermak">Kirim</button>
         </p>
      </form>
   </fieldset>
</body>
</html>
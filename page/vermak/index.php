
<?php 
require '../../config/db.php';
require '../../config/function.php';

if (isset($_POST['vermak'])) {
   if(vermak($_POST) > 0) {
      echo "<script>alert('Pesanan Anda Berhasil Dikirim.');window.location='index.php';</script>";
   } else {
      echo "<script>alert('Pesanan Anda Gagal Dikirim.');window.location='index.php';</script>";
   }
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
         <p>
            <label for="nama_pelanggan">Nama Pelanggan</label>
            <input type="text" name="nama_pelanggan" autofocus="on">
         </p>
         <p>
            <label for="deskripsi">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" cols="30" rows="10" placeholder="Tulisakan pesanan anda, jenis, desain baju/celana..."></textarea>
         </p>
         <p>
            <label for="banyaknya">Banyaknya</label>
               <input type="number" name="banyaknya">
            </p>
         <p>
            <label for="harga">Harga Vermak : Rp.50.000</label>
         </p>
         <p>
            <button type="submit" name="vermak">Kirim</button>
         </p>
      </form>
   </fieldset>
</body>
</html>
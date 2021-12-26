<?php 
require '../../config/db.php';
require '../../config/function.php';


if(isset($_GET['act'])) {
   if ($_GET['act'] == 'vermak') {
      $button = 'Edit';
      $name = 'vermak';
      $id_nota = $_GET['id'];
      $query = query("SELECT * FROM nota WHERE id_nota = $id_nota")[0];

      
   }

   if ($_GET['act'] == 'baru') {
      $button = 'Tambah';
      $name = 'baru';
   }
}

if (isset($_POST['vermak'])) {
         if(edit_nota_vermak($_POST) > 0) {
            echo "<script>alert('Data Vermak Berhasil Diedit.');window.location='nota.php';</script>";
         } else {
            echo "<script>alert('Data Vermak Gagal Diedit.');window.location='nota.php';</script>";
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
   <?php 
   if(isset($_GET['act'])){
      if(($_GET['act']=='vermak')){ 
   ?>
   <h1>Edit Data Nota Vermak</h1>
   <form action="" method="post">
      <input type="hidden" name="id_nota" value="<?= $id_nota ?>">
      <fieldset>
         <p>
            <label for="nama">Nama Pelanggan: </label>
            <input type="text" name="nama_pelanggan" value="<?= $query['nama_pelanggan'] ?>">
         </p>
         <p>
            <label for="banyaknya">Banyaknya</label>
            <input type="number" min="1" name="banyaknya" value="<?= $query['banyaknya'] ?>">
         </p>
         <p>
            <label for="deskripsi">Deskripsi</label>
            <textarea name="deskripsi_nota" id="Deskripsi" cols="30" rows="10"><?= $query['deskripsi_nota'] ?></textarea>
         </p>
         <p>
            <label for="tipe">Tipe</label>
            <select name="tipe" id="tipe">
               <option value="">-- Tipe --</option>
               <option value="Baru" <?= ($query['tipe'] == 'Baru' ? 'selected' : '') ?>>Buat Baru</option>
               <option value="Vermak" <?= ($query['tipe'] == 'Vermak' ? 'selected' : '') ?>>Vermak</option>
            </select>
         </p>
         <p>
            <label for="pilih_vermak">Pilihan Vermak</label>
            <select name="pilih_vermak" id="pilih_vermak">
               <option value="">-- Pilih --</option>
               <option value="25000" <?= ($query['harga'] == '25000' ? 'selected' : '') ?>>Potong Sambung - Celana (Rp.25.000)</option>
               <option value="20000" <?= ($query['harga'] == '20000' ? 'selected' : '') ?>>Potong Biasa - Celana (Rp.20.000)</option>
               <option value="30000" <?= ($query['harga'] == '30000' ? 'selected' : '') ?>>Kecilkan Pinggang - Celana (Rp.30.000)</option>
               <option value="15000" <?= ($query['harga'] == '15000' ? 'selected' : '') ?>>Tempel Celana Koyak (Rp.15.000)</option>
            </select>
         </p>
         <p>
            <button type="submit" name="<?= $name ?>"><?= $button ?></button>
            <a href="nota.php">Kembali</a>
         </p>
      </fieldset>
   </form>
<?php }} ?>
</body>
</html>
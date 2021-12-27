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
      $button = 'Edit';
      $name = 'baru';
      $id_nota = $_GET['id'];
      $query = query("SELECT * FROM nota INNER JOIN barang ON barang.id_barang = nota.id_barang INNER JOIN user ON user.id_user = nota.id_user WHERE nota.id_nota = $id_nota")[0];
      var_dump($query['id_user']);
      $barang = query("SELECT * FROM barang");
   }
}

if (isset($_POST['vermak'])) {
         if(edit_nota_vermak($_POST) > 0) {
            echo "<script>alert('Data Vermak Berhasil Diedit.');window.location='nota.php';</script>";
         } else {
            echo "<script>alert('Data Vermak Gagal Diedit.');window.location='nota.php';</script>";
         }
      }

if (isset($_POST['baru'])) {
   if(edit_nota_baru($_POST) > 0) {
      echo "<script>alert('Data Berhasil Diedit.');window.location='nota.php';</script>";
   } else {
      echo "<script>alert('Data Gagal Diedit.');window.location='nota.php';</script>";
   }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>
      <?php if($_GET['act'] == 'baru') : ?>
         Edit Nota Penerima Baju & Celana Baru
      <?php elseif($_GET['act'] == 'vermak') : ?>
         Edit Nota Vermak Baju & Celana
      <?php endif; ?>
   </title>
</head>
<body>
   <?php if(isset($_GET['act'])) : ?>
      <?php if(($_GET['act']=='vermak')) : ?>
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


      <?php elseif(($_GET['act']=='baru')) : ?>
         <h1>Edit Data Penerima Baju & Celana Baru</h1>
         <form action="" method="post">
            <input type="hidden" name="id_nota" value="<?= $id_nota ?>">
            <input type="hidden" name="id_user" value="<?= $query['id_user'] ?>">
            <fieldset>
               <p>
                  <label for="nama">Nama Pelanggan: </label>
                  <input type="text" name="nama_pelanggan" value="<?= $query['nama_user'] ?>">
               </p>
               <p>
                  <label for="banyaknya">Banyaknya</label>
                  <input type="number" min="1" name="banyaknya" value="<?= $query['banyaknya'] ?>">
               </p>
               <p>
                  <label for="pilih_baru">Pilihan Baru</label>
                  <select name="pilih_baru" id="pilih_baru">
                     <option value="">-- Pilih --</option>
                     <?php foreach($barang as $b) : ?>
                        <option value="<?= $b['id_barang'] . ',' . $b['harga_brg'] ?>" <?= ($query['harga'] == $b['harga_brg'] ? 'selected' : '') ?>><?= $b['nama_barang'] . ' - ' . number_format($b['harga_brg'], 0, ',', '.') ?></option>
                     <?php endforeach; ?>
                  </select>
               </p>
               <p>
                  <button type="submit" name="<?= $name ?>"><?= $button ?></button>
                  <a href="nota.php">Kembali</a>
               </p>
            </fieldset>
         </form>
      <?php endif; ?>
   <?php endif; ?>
</body>
</html>
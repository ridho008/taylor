<?php 
require 'config/db.php';
require 'config/function.php';

$barang = query("SELECT * FROM barang");
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Surya Taylor</title>
   <style>
      .box {
         display: inline-block;
         float: left;
         margin: 10px;
         border: 1px solid #444;
         background: #999;
      }

      .box img {
         width: 300px;
         height: 300px;
         object-fit: cover;
         object-position: center;
      }

      .box .title {
         text-align: center;
      }
   </style>
</head>
<body>
   <h1 align="center">Aplikasi Buat & Vermak Baju Celana</h1>
      <div align="center">
         <nav>
           <a href="http://localhost/taylor">Utama</a> |
           <a href="<?= base_url('page/pelanggan/pelanggan.php') ?>">Pelanggan</a> |
           <a href="<?= base_url('page/transaksi/transaksi.php') ?>">Transaksi</a> |
           <a href="<?= base_url('page/barang/barang.php') ?>">Baju & Celana</a>
           <a href="<?= base_url('page/nota/nota.php') ?>">Nota</a>
         </nav> 
      </div>
      <br>
      <fieldset>
         <h2 align="center">Menerima Jahitan Baru Pria & Wanita</h2>
         <p>Ingin Vermak Levis ? Silahkan Isi Formulir <a href="<?= base_url('page/vermak/index.php') ?>">Disini</a></p>
         <?php foreach($barang as $b) : ?>
         <div class="box">
            <img src="<?= base_url('img/barang/' . $b['gambar_brg']) ?>">
            <div class="title">
               <h3><?= $b['nama_barang'] ?></h3>
               <p>
                  Harga : <?= number_format($b['harga_brg'],0,',','.') ?>
                  <select name="warna" id="warna">
                     <option value="">Warna</option>
                     <option value="Hitam">Hitam</option>
                     <option value="Dongker">Dongker</option>
                     <option value="Merah">Merah</option>
                     <option value="Putih">Putih</option>
                  </select>
                  <br>
                  <button type="submit" name="pesan">Pesan</button>
               </p>
            </div>
         </div>
         <?php endforeach; ?>
      </fieldset>
</body>
</html>
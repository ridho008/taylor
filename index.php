<?php 
session_start(); 
require 'config/db.php';
require 'config/function.php';

if(!isset($_SESSION['role'])) {
  header("Location: login.php");
  exit;
}
$namaUser = $_SESSION['nama_user'];
$pelanggan = query("SELECT * FROM user WHERE nama_user = '$namaUser'")[0];
// var_dump($_SESSION['nama_user'], $pelanggan['id_user']);


$barang = query("SELECT * FROM barang");
$user = query("SELECT * FROM user");

if (isset($_POST['pesan'])) {
   if(pesan($_POST) > 0) {
      echo "<script>alert('Barang Berhasil Dipesan.');window.location='index.php';</script>";
   } else {
      echo "<script>alert('Barang Gagal Dipesan.');window.location='index.php';</script>";
   }
}
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
           Hai, <?= $_SESSION['nama_user'] ?>
            <a href="logout.php" onclick="return confirm('Yakin Keluar Akun ?')"><mark><b>Keluar</b></mark></a>
         </nav> 
      </div>
      <br>
      <fieldset>
         <h2 align="center">Menerima Jahitan Baru Pria & Wanita</h2>
         <p>Ingin Vermak Levis ? Silahkan Isi Formulir <a href="<?= base_url('page/vermak/index.php') ?>">Disini</a></p>
         <?php foreach($barang as $b) : ?>
            <form action="" method="post">
         <input type="hidden" name="id_barang" value="<?= $b['id_barang'] ?>">
         <input type="hidden" name="harga" value="<?= $b['harga_brg'] ?>">
         <input type="hidden" name="tipe" value="Baru">
         <input type="hidden" name="id_user" value="<?= $pelanggan['id_user'] ?>">
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
                  <!-- <select name="id_user" id="id_user">
                     <?php foreach($user as $u) : ?>
                        <?php if($u['role'] != 0) : ?>
                        <option value="<?= $u['id_user'] ?>"><?= $u['nama_user'] ?></option>
                        <?php endif; ?>
                     <?php endforeach; ?>
                  </select> -->
                  <p>
                     <input type="number" name="banyaknya">
                  </p>
                  <br>
                  <button type="submit" name="pesan">Pesan</button>
               </p>
            </div>
            </form>
         </div>
         <?php endforeach; ?>
      </fieldset>
</body>
</html>
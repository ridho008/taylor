<?php 
session_start(); 
require 'config/db.php';
require 'config/function.php';
error_reporting(0);

// if(!isset($_SESSION['role'])) {
//   header("Location: login.php");
//   exit;
// }
var_dump($_SESSION['nama_user']);
if(isset($_SESSION['role'])) {
   $namaUser = $_SESSION['nama_user'];
   $pelanggan = query("SELECT * FROM user WHERE nama_user = '$namaUser'")[0];
   // var_dump($_SESSION['role']);
   if ($_SESSION['role'] == 0) {
      $role = "Admin";
   } elseif($_SESSION['role'] == 1) {
      $role = "Pemimpin";
   } elseif($_SESSION['role'] == 2) {
      $role = "Pelanggan";
   }
}
// var_dump($_SESSION['nama_user'], $pelanggan['id_user']);


$barang = query("SELECT * FROM barang");
$user = query("SELECT * FROM user");

if (isset($_SESSION['role'])) {
   if($_SESSION['role'] == 2) {
      if (isset($_POST['pesan'])) {
         if(pesan($_POST) > 0) {
            echo "<script>alert('Barang Berhasil Dipesan.');window.location='index.php';</script>";
         } else {
            echo "<script>alert('Barang Gagal Dipesan.');window.location='index.php';</script>";
         }
      }
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
           <?php if(isset($_SESSION['role'])) : ?>
            <?php if($_SESSION['role'] == 0) : ?>
                 <a href="<?= base_url('page/pelanggan/pelanggan.php') ?>">Pelanggan</a> |
                 <a href="<?= base_url('page/transaksi/transaksi.php') ?>">Transaksi</a> |
                 <a href="<?= base_url('page/barang/barang.php') ?>">Baju & Celana</a>
                 <a href="<?= base_url('page/nota/nota.php') ?>">Nota</a>
                 <a href="<?= base_url('page/belanja/index.php') ?>">Belanja Masuk</a>
              <?php elseif($_SESSION['role'] == 1) : ?>
                 <a href="<?= base_url('page/transaksi/transaksi.php') ?>">Transaksi</a> |
                 <a href="<?= base_url('page/nota/nota.php') ?>">Nota</a>
               <?php elseif($_SESSION['role'] == 2) : ?>
                 <a href="<?= base_url('page/keranjang/index.php') ?>">Belanja</a>
               <?php endif; ?>
            <?php endif; ?>
           
           <?php if(isset($_SESSION['role'])) : ?>
           Hai, <?= $_SESSION['nama_user'] ?> (<?= $role ?>)
            <a href="logout.php" onclick="return confirm('Yakin Keluar Akun ?')"><mark><b>Keluar</b></mark></a>
         <?php else: ?>
            <a href="login.php">Masuk</a>
         <?php endif; ?>
         </nav> 
      </div>
      <br>
      <fieldset>
         <h2 align="center">Menerima Jahitan Baru Pria & Wanita</h2>
         <?php if($_SESSION['role'] == 2 || empty($_SESSION['role'])) : ?>
         <p align="center">Ingin Vermak Levis ? Silahkan Isi Formulir <a href="<?= base_url('page/vermak/index.php') ?>">Disini</a></p>
         <?php endif; ?>
         <?php foreach($barang as $b) : ?>
            <form action="" method="post">
         <input type="hidden" name="id_barang" value="<?= $b['id_barang'] ?>">
         <input type="hidden" name="harga" value="<?= $b['harga_brg'] ?>">
         <input type="hidden" name="tipe" value="Baru">
         <?php if($_SESSION['role'] == 2) : ?>
         <input type="hidden" name="id_user" value="<?= $pelanggan['id_user'] ?>">
         <?php endif; ?>
         <div class="box">
            <img src="<?= base_url('img/barang/' . $b['gambar_brg']) ?>">
            <div class="title">
               <h3><?= $b['nama_barang'] ?></h3>
               <p>
                  Stok : <?= $b['stok'] ?> | 
                  Harga : <?= number_format($b['harga_brg'],0,',','.') ?>
                  <?php if($_SESSION['role'] == 2) : ?>
                  <select name="warna" id="warna">
                     <option value="">--Warna--</option>
                     <option value="Hitam">Hitam</option>
                     <option value="Dongker">Dongker</option>
                     <option value="Merah">Merah</option>
                     <option value="Putih">Putih</option>
                  </select>
                  <p>
                     <input type="number" name="banyaknya">
                  </p>
                  <br>
                  <button type="submit" name="pesan">Pesan</button>
                  <?php elseif($_SESSION['role'] == null) : ?>
                  <button type="button" onclick="loginDulu()" id="pesan">Pesan</button>
                  <?php endif; ?>
               </p>
            </div>
            </form>
         </div>
         <?php endforeach; ?>
      </fieldset>

   <script>
      const tombolPesan = document.querySelector('#pesan');
      tombolPesan.addEventListener('click', function() {
         console.log('ok')
      })

      function loginDulu() {
         const tombolPesan = document.getElementById('#pesan');
         alert("Login Terlebih Dahulu.");
         window.location = "login.php";
      }
   </script>
</body>
</html>
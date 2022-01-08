
<?php 
require '../../config/db.php';
require '../../config/function.php';
session_start();
$query = query("SELECT * FROM nota INNER JOIN user ON nota.id_user = user.id_user INNER JOIN barang ON barang.id_barang = nota.id_barang LEFT JOIN transaksi ON nota.id_nota = transaksi.id_nota WHERE tipe = 'Baru'");
$q = query("SELECT * FROM nota INNER JOIN transaksi ON nota.id_nota = transaksi.id_nota WHERE tipe = 'Vermak'");
// var_dump($_SESSION['role']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Daftar Nota</title>
   <style>
      .box {
         float: left;
         margin: 10px;
         display: inline-block;
      }
   </style>
</head>
<body>
   <h2 align="center">Daftar Nota SURYA TAYLOR</h2>
   <div align="center">
         <nav>
           <a href="http://localhost/taylor">Utama</a> |
           <a href="<?= base_url('page/pelanggan/pelanggan.php') ?>">Pelanggan</a> |
           <a href="<?= base_url('page/transaksi/transaksi.php') ?>">Transaksi</a> |
           <a href="<?= base_url('page/barang/barang.php') ?>">Baju & Celana</a>
           <a href="<?= base_url('page/nota/nota.php') ?>">Nota</a>
           Hai, <?= $_SESSION['nama_user'] ?>
            <a href="../../logout.php" onclick="return confirm('Yakin Keluar Akun ?')"><mark><b>Keluar</b></mark></a>
         </nav> 
      </div>
   <div class="box">
   <h3>Nota Baju & Celana Buat Baru</h3>
   <!-- <a href="tambah.php">Tambah Nota</a> -->
      <table border="1" cellpadding="8" cellspacing="0">
         <thead>
            <tr>
               <th>No</th>
               <th>Pelanggan</th>
               <th>Barang</th>
               <th>Harga</th>
               <th>Banyaknya</th>
               <th>Tipe</th>
               <th>Status</th>
               <th>Total</th>
               <?php if(isset($_SESSION['role'])) : ?>
                     <?php if($_SESSION['role'] == 0) : ?>
               <th>Aksi</th>
               <?php endif; ?>
                  <?php endif; ?>
            </tr>
         </thead>
         <tbody>
            <?php 
            $totalBaru = 0;
            ?>
            <?php $no = 1; foreach($query as $k) : ?>
            <?php 
            $totalBaru += $k['hrg_total'];
            // var_dump($totalBaru);
            ?>
               <tr>
                  <td><?= $no++; ?></td>
                  <td><?= $k['nama_user'] ?></td>
                  <td><?= $k['nama_barang'] ?></td>
                  <td><?= number_format($k['harga'], 0, ',', '.') ?></td>
                  <td><?= $k['banyaknya'] ?></td>
                  <td><?= $k['tipe'] ?></td>
                  <td>
                  <?php if($k['status'] == 0) : ?>
                     <p style="color: yellowgreen;">Pending</p>
                  <?php elseif($k['status'] == 1) : ?>
                     <p style="color: green;">Pending</p>
                  <?php elseif($k['status'] == 2) : ?>
                     <p style="color: red;">Pending</p>
                  <?php endif; ?>
                  </td>
                  <td><?= number_format($k['hrg_total'], 0, ',', '.') ?></td>
                  <?php if(isset($_SESSION['role'])) : ?>
                     <?php if($_SESSION['role'] == 0) : ?>
                  <td>
                     <a href="edit.php?act=baru&id=<?= $k['id_nota']; ?>">Edit</a>
                     <a href="hapus.php?id=<?= $k['id_nota']; ?>" onclick="return confirm('Yakin ?')">Hapus</a>
                  </td>
                     <?php endif; ?>
                  <?php endif; ?>
               </tr>
            <?php endforeach; ?>
         </tbody>
         <tfoot>
            <tr>
               <!-- <td colspan="6"></td> -->
               <?php if(isset($_SESSION['role'])) : ?>
                  <?php if($_SESSION['role'] == 0) : ?>
               <td colspan="5" align="center"><b>Sub Total</b> <?= number_format($totalBaru,0, ',', '.'); ?></td>
               <td colspan="4"><a href="laporan_tgl.php?act=baru">Cetak Berdasarkan Tanggal</a> | <a href="laporan.php?act=baru">Cetak Nota</a></td>
                  <?php elseif($_SESSION['role'] == 1) : ?>
                     <td colspan="6" align="center"><b>Sub Total</b> <?= number_format($totalBaru,0, ',', '.'); ?></td>
                     <td colspan="4"><a href="laporan.php?act=baru">Cetak Nota</a></td>
                  <?php endif; ?>
               <?php endif; ?>
            </tr>
         </tfoot>
      </table>
   </div>

   <div class="box">
      <h3>Nota Vermak Levis</h3>
      <table cellpadding="8" cellspacing="0" border="1">
         <thead>
            <tr>
               <th>No</th>
               <th>Pelanggan</th>
               <th>Barang</th>
               <th>Harga</th>
               <th>Banyaknya</th>
               <th>Deskripsi</th>
               <th>Tipe</th>
               <th>Total</th>
               <?php if(isset($_SESSION['role'])) : ?>
                     <?php if($_SESSION['role'] == 0) : ?>
               <th>Aksi</th>
               <?php endif; ?>
                  <?php endif; ?>
            </tr>
         </thead>
         <tbody>
            <?php $total_vermak = 0; ?>
            <?php $no = 1; foreach($q as $v) : ?>
            <?php 
            $total_vermak += $v['hrg_total'];
            // var_dump($total);
            ?>
               <tr>
                  <td><?= $no++; ?></td>
                  <td><?= $v['nama_pelanggan']; ?></td>
                  <td>
                     <?php if($v['harga'] == 25000) : ?>
                        Potong Sambung - Celana
                     <?php elseif($v['harga'] == 20000) : ?>
                     Potong Biasa - Celana
                     <?php elseif($v['harga'] == 30000) : ?>
                     Kecilkan Pinggang - Celana
                     <?php elseif($v['harga'] == 15000) : ?>
                     Tempel Celana Koyak
                  <?php else: ?>
                     <?php endif; ?>
                  </td>
                  <td><?= number_format($v['harga'],0, ',','.'); ?></td>
                  <td><?= $v['banyaknya']; ?></td>
                  <td><?= $v['deskripsi_nota']; ?></td>
                  <td><?= $v['tipe']; ?></td>
                  <td><?= number_format($v['hrg_total'], 0, ',', '.'); ?></td>
                  <?php if(isset($_SESSION['role'])) : ?>
                     <?php if($_SESSION['role'] == 0) : ?>
                  <td>
                     <a href="edit.php?act=vermak&id=<?= $v['id_nota']; ?>">Edit</a>
                     <a href="hapus.php?id=<?= $v['id_nota']; ?>" onclick="return confirm('Yakin ?')">Hapus</a>
                  </td>
                     <?php endif; ?>
                  <?php endif; ?>
               </tr>
               <?php endforeach; ?>
         </tbody>
         <tfoot>
            <tr>
               <!-- <td colspan="6"></td> -->
               <?php if(isset($_SESSION['role'])) : ?>
               <?php if($_SESSION['role'] == 0) : ?>
                  <td colspan="7" align="center"><b>Sub Total</b> <?= number_format($total_vermak,0, ',', '.'); ?></td>
                  <td colspan="4"><a href="laporan.php?act=vermak">Cetak Nota</a> || <a href="laporan_tgl.php?act=vermak">Cetak Berdasarkan Tanggal</a></td>
                  <?php elseif($_SESSION['role'] == 1) : ?>
                     <td colspan="6" align="center"><b>Sub Total</b> <?= number_format($total_vermak,0, ',', '.'); ?></td>
                     <td colspan="4"><a href="laporan.php?act=baru">Cetak Nota</a></td>
                  <?php endif; ?>
               <?php endif; ?>
            </tr>
         </tfoot>
      </table>
   </div>
</body>
</html>
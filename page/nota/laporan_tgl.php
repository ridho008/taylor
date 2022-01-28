<?php 
require '../../config/db.php';
require '../../config/function.php';
session_start();

if(isset($_POST['filter'])){
   $tgl = $_POST['tgl_nota'];
   $sql = mysqli_query($conn,"SELECT * FROM nota INNER JOIN user ON nota.id_user = user.id_user INNER JOIN barang ON barang.id_barang = nota.id_barang LEFT JOIN transaksi ON nota.id_nota = transaksi.id_nota WHERE tgl_nota = '$tgl'");
} else {
   $sql = mysqli_query($conn,"SELECT * FROM nota INNER JOIN user ON nota.id_user = user.id_user INNER JOIN barang ON barang.id_barang = nota.id_barang LEFT JOIN transaksi ON nota.id_nota = transaksi.id_nota");
}

if (isset($_POST['filter_vermak'])) {
   $tgl = $_POST['tgl_nota'];
   $q = mysqli_query($conn,"SELECT * FROM nota INNER JOIN transaksi ON nota.id_nota = transaksi.id_nota WHERE tgl_nota = '$tgl' AND tipe = 'vermak'");
} else {
   $q = query("SELECT * FROM nota INNER JOIN transaksi ON nota.id_nota = transaksi.id_nota WHERE tipe = 'vermak'");

}

// http://localhost/taylor/page/nota/laporan_tgl.php?tgl_nota=2022-01-07&filter=
// var_dump($_POST['tgl_nota'], $_POST['filter'])
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Laporan Surya Taylor - Berdasarkan Tanggal</title>
   <style>
      .filter-tgl {
         margin: 20px auto;
         text-align: center;
      }

      @media print
      {    
          .no-print, .no-print *
          {
              display: none !important;
          }
      }
   </style>
</head>
<body>
   <div class="filter-tgl">
      <?php if(isset($_GET['act'])) : ?>
         <?php if($_GET['act'] == 'baru') : ?>
         <h2>Laporan Baru Surya Taylor - Berdasarkan Tanggal</h2>
         <form method="post" class="no-print">
               <label>Pilih Tanggal</label>
               <input type="date" name="tgl_nota">
               <button type="submit" name="filter">Cari</button>
               <a href="<?= base_url('page/nota/nota.php') ?>">Kembali</a>
         </form>
      <br>

      <table border="1" cellpadding="10" cellspacing="0" width="100%">
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
            </tr>
         </thead>   
            <tbody>
               <?php 
                  $total = 0;
                  ?>
               <?php $no = 1; while($k = mysqli_fetch_assoc($sql)) : ?>
                  <?php 
                  $total += $k['hrg_total'];
                  // var_dump($total);
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
                     <p style="color: green;">Diterima</p>
                  <?php elseif($k['status'] == 2) : ?>
                     <p style="color: red;">Ditolak</p>
                  <?php endif; ?>
                  </td>
                  <td><?= number_format($k['hrg_total'], 0, ',', '.') ?></td>
               </tr>
            <?php endwhile; ?>
            </tbody>
            <tfoot>
               <tr>
                  <td colspan="6"></td>
                  <td colspan="7"><b>Sub Total</b> <?= number_format($total,0, ',', '.'); ?></td>
               </tr>
            </tfoot>
      </table>
      <?php if(isset($_POST['filter'])) : ?>
         <script>
         window.print();
         </script>
      <?php endif; ?>
      <?php elseif($_GET['act'] == 'vermak') : ?>
         <h2>Laporan Vermak Surya Taylor - Berdasarkan Tanggal</h2>
         <form method="post" class="no-print">
               <label>Pilih Tanggal</label>
               <input type="date" name="tgl_nota">
               <button type="submit" name="filter_vermak">Cari</button>
               <a href="<?= base_url('page/nota/nota.php') ?>">Kembali</a>
         </form>
         <table cellpadding="8" cellspacing="0" border="1" width="100%">
            <thead>
               <tr>
                  <th>No</th>
                  <th>Pelanggan</th>
                  <th>Barang</th>
                  <th>Banyaknya</th>
                  <th>Deskripsi</th>
                  <th>Tipe</th>
                  <th>Total</th>
               </tr>
            </thead>
            <tbody>
               <?php if(!empty($q)) : ?>
               <?php $total = 0; ?>
               <?php $no = 1; foreach($q as $v) : ?>
               <?php $total += $v['hrg_total']; ?>
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
                     <td><?= $v['banyaknya']; ?></td>
                     <td><?= $v['deskripsi_nota']; ?></td>
                     <td><?= $v['tipe']; ?></td>
                     <td><?= number_format($v['hrg_total'], 0, ',', '.'); ?></td>
                  </tr>
                  <?php endforeach; ?>
               <?php else: ?>
                  Laporan Vermak Kosong
               <?php endif; ?>
            </tbody>
            <tfoot>
                  <tr>
                     <td colspan="6"></td>
                     <td colspan="7"><b>Sub Total</b> <?= number_format($total,0, ',', '.'); ?></td>
                  </tr>
               </tfoot>
         </table>
         <?php if(isset($_POST['filter_vermak'])) : ?>
         <script>
         window.print();
         </script>
      <?php endif; ?>
         <?php endif; ?>
      <?php endif; ?>
   </div>
</body>
</html>
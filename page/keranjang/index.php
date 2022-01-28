<?php  
session_start();
require '../../config/db.php';
require '../../config/function.php';
$nama_user = $_SESSION['nama_user'];

$queryUser = mysqli_query($conn, "SELECT * FROM user WHERE nama_user = '$nama_user'");
$rowUser = mysqli_fetch_assoc($queryUser);
$idUser = $rowUser['id_user'];

$queryNota = query("SELECT * FROM nota INNER JOIN user ON nota.id_user = user.id_user INNER JOIN barang ON barang.id_barang = nota.id_barang WHERE user.id_user = $idUser AND tipe = 'Baru' AND status != 3");
$queryNotaVermak = query("SELECT * FROM nota INNER JOIN transaksi ON nota.id_nota = transaksi.id_nota WHERE nota.id_user = $idUser AND tipe = 'Vermak'");
// var_dump($queryNota);

if(isset($_POST['diterima'])) {
   if (sampai($_POST) > 0) {
      echo "<script>alert('Terima Kasih Telah Konfirmasi.');window.location='index.php';</script>";
   } else {
      echo "<script>alert('Gagal.');window.location='index.php';</script>";
   }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Belanja - SuryaTaylor</title>
</head>
<body>
   <div align="center">
      <h1>Barang Yang Telah Dipesan</h1>
         <nav>
           <a href="http://localhost/taylor">Utama</a>
           Hai, <?= $_SESSION['nama_user'] ?>
            <a href="../../logout.php" onclick="return confirm('Yakin Keluar Akun ?')"><mark><b>Keluar</b></mark></a>
         </nav> 
      </div>
   <table border="1" cellpadding="10" cellspacing="0" width="100%">
      <thead>
         <tr>
            <th>No</th>
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
            $totalBaru = 0;
            ?>
         <?php $no = 1; foreach($queryNota as $k) : ?>
         <?php 
            $total = $k['harga'] * $k['banyaknya'];
            $totalBaru += $total;
            // var_dump($total);
            ?>
            <tr>
               <td><?= $no++; ?></td>
               <td><?= $k['nama_barang'] ?></td>
               <td><?= number_format($k['harga'], 0, ',', '.') ?></td>
               <td><?= $k['banyaknya'] ?></td>
               <td><?= $k['tipe'] ?></td>
               <td>
                  <?php if($k['status'] == 0) : ?>
                     <p style="color: yellowgreen;">Pending</p>
                  <?php elseif($k['status'] == 1) : ?>
                     <p style="color: green;">Barang Telah Dikirim</p>
                     <form action="" method="post">
                        <input type="hidden" name="id_nota" value="<?= $k['id_nota']; ?>">
                        <input type="hidden" name="sampai" value="3">
                        <button type="submit" name="diterima" onclick="return confirm('Apakah Barang Telah Diterima ?')">Diterima</button>
                     </form>
                  <?php elseif($k['status'] == 2) : ?>
                     <p style="color: red;">Ditolak</p>
                  <?php endif; ?>
               </td>
               <td><?= number_format($total, 0, ',', '.') ?></td>
            </tr>
         <?php endforeach; ?>
      </tbody>
      <tfoot>
         <tr>
            <td colspan="6" align="center"><b>Sub Total</b></td>
            <td colspan="6"><b><?= number_format($totalBaru,0, ',', '.'); ?></b></td>
         </tr>
      </tfoot>
   </table>
   <br>
   <table cellpadding="8" cellspacing="0" border="1" width="100%">
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
            <?php $no = 1; foreach($queryNotaVermak as $v) : ?>
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
                  <td colspan="7" align="center"><b>Sub Total</b></td>
                     <td colspan="6" align="center"><b><?= number_format($total_vermak,0, ',', '.'); ?></td>
            </tr>
         </tfoot>
      </table>
</body>
</html>
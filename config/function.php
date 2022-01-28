<?php
require 'db.php';
function query($query) {
   global $conn;
   $result = mysqli_query($conn, $query);
   $rows = [];

   while( $row = mysqli_fetch_assoc($result) ) {
      $rows[] = $row;
   }
   return $rows;
}

function base_url($url) {
   $base_url = "http://localhost/taylor/";
   if($base_url != null) {
      return $base_url . $url; 
   } else {
      return $base_url;
   }
}

function tambah_barang($data) {
   global $conn;
   $nama_barang = htmlspecialchars($data['nama_barang']);
   $stok = htmlspecialchars($data['stok']);
   $harga = htmlspecialchars($data['harga']);
   $warna = htmlspecialchars($data['warna']);
   $deskripsi = htmlspecialchars($data['deskripsi']);

   // Upload file gambar
   $gambar = upload();
   if(!$gambar) {
      return false;
   }

   mysqli_query($conn, "INSERT INTO barang VALUES (null, '$nama_barang', '$deskripsi', '$warna', '$stok', '$harga', '$gambar')");
   return mysqli_affected_rows($conn);
}

function upload($gambar_lama = null)
{
   $namaFile = $_FILES['gambar']['name'];
   $ukuranFile = $_FILES['gambar']['size'];
   $error = $_FILES['gambar']['error'];
   $tmpName = $_FILES['gambar']['tmp_name'];

   // cek apakah tidak ada gambar yang diupload
   if( $error === 4 ) {
      echo "<script>
            alert('pilih gambar terlebih dahulu');
            </script>
      ";
      return false;
   }

   // cek apakah yang diupload adalah gambar
   $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
   $ekstensiGambar = explode('.', $namaFile);
   $ekstensiGambar = strtolower(end($ekstensiGambar));

   if( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
      echo "<script>
            alert('yang anda upload bukan gambar!');
            </script>
      ";
      return false;
   }

   // cek jika ukuran gambar terlalu besar
   if( $ukuranFile > 1000000 ) {
      echo "<script>
            alert('ukuran gambar terlalu besar!');
            </script>
      ";
      return false;
   }


   // gambar siap diupload
   // genere nama gambar
   $namaFileBaru = uniqid();
   $namaFileBaru .= '.';
   $namaFileBaru .= $ekstensiGambar;
   

   move_uploaded_file($tmpName, "../../img/barang/" . $namaFileBaru);
   if ($gambar_lama) {
      unlink('../../img/barang/' . $gambar_lama);
   }

   return $namaFileBaru;

}

function edit_barang($data) {
   global $conn;

   $id = htmlspecialchars($data['id']);
   $nama_barang = htmlspecialchars($data['nama_barang']);
   $stok = htmlspecialchars($data['stok']);
   $harga = htmlspecialchars($data['harga']);
   $warna = htmlspecialchars($data['warna']);
   $deskripsi = htmlspecialchars($data['deskripsi']);
   $gambar_lama = htmlspecialchars($data['gambar_lama']);

   if( $_FILES["gambar"]["error"] === 4) {
      $gambar = $gambar_lama;
   } else {
      $gambar = upload($gambar_lama);
   }

   mysqli_query($conn, "UPDATE barang SET nama_barang = '$nama_barang', deskripsi = '$deskripsi', warna = '$warna', stok = '$stok', harga_brg = '$harga', gambar_brg = '$gambar' WHERE id_barang = $id");
   return mysqli_affected_rows($conn);
}

function tambah_pelanggan($data) {
   global $conn;
   $nama = htmlspecialchars($data['nama']);
   $telepon = htmlspecialchars($data['telepon']);
   $alamat = htmlspecialchars($data['alamat']);
   $role = htmlspecialchars($data['role']);

   if ($nama == null || $telepon == null || $alamat == null || $role == null) {
      echo "<script>alert('Inputan Tidak Boleh Kosong!');window.location='tambah.php';</script>";
   }

   mysqli_query($conn, "INSERT INTO user VALUES (null, '$nama', '$role', '$telepon', '$alamat')");
   return mysqli_affected_rows($conn);
}

function edit_pelanggan($data) {
   global $conn;
   $id = htmlspecialchars($data['id']);
   $nama = htmlspecialchars($data['nama']);
   $telepon = htmlspecialchars($data['telepon']);
   $alamat = htmlspecialchars($data['alamat']);
   $role = htmlspecialchars($data['role']);

   if ($nama == null || $telepon == null || $alamat == null || $role == null) {
      echo "<script>alert('Inputan Tidak Boleh Kosong!');window.location='edit.php?id=$id';</script>";
   }

   mysqli_query($conn, "UPDATE user SET nama_user = '$nama', role = '$role', telepon = '$telepon', alamat = '$alamat' WHERE id_user = '$id'");
   return mysqli_affected_rows($conn);
}

function sewa($data) {
   global $conn;
   $id_user = htmlspecialchars($data['id_user']);
   $id_kamar = htmlspecialchars($data['id_kamar']);
   $lama_inap = htmlspecialchars($data['lama_inap']);

   mysqli_query($conn, "INSERT INTO penjualan135 VALUES (null, '$id_kamar', '$id_user', '$lama_inap')");
   return mysqli_affected_rows($conn);
}

function tambah_penjualan($data) {
   global $conn;

   $id_kamar = htmlspecialchars($data['kamar']);
   $nama_pen = htmlspecialchars($data['nama']);
   $lama_inap = htmlspecialchars($data['lama_inap']);

   mysqli_query($conn, "INSERT INTO penjualan135 VALUES (null, '$id_kamar', '$nama_pen', '$lama_inap')");
   return mysqli_affected_rows($conn);
}

function edit_penjualan($data) {
   global $conn;

   $id_pen = htmlspecialchars($data['id_pen']);
   $id_kamar = htmlspecialchars($data['kamar']);
   $nama_pen = htmlspecialchars($data['nama']);
   $lama_inap = htmlspecialchars($data['lama_inap']);

   mysqli_query($conn, "UPDATE penjualan135 SET id_kamar135 = '$id_kamar', id_user135 = '$nama_pen', lama_inap = '$lama_inap' WHERE id_pen135 = $id_pen");
   return mysqli_affected_rows($conn);
}

function pesan($data) {
   global $conn;
   $id_user = htmlspecialchars($data['id_user']);
   $banyaknya = htmlspecialchars($data['banyaknya']);
   $id_barang = htmlspecialchars($data['id_barang']);
   $harga = htmlspecialchars($data['harga']);
   $warna = htmlspecialchars($data['warna']);
   $tipe = htmlspecialchars($data['tipe']);

   if ($warna == null) {
      echo "<script>alert('Warna Wajib Dipilih.');window.location='index.php';</script>";
      return false;
   }

   // Mengurangi stok barang setelah di pesan
   $queryBarang = mysqli_query($conn, "SELECT * FROM barang WHERE id_barang = $id_barang");
   $resultBrg = mysqli_fetch_assoc($queryBarang);
   $rowBrg = $resultBrg['stok'];
   // var_dump($rowBrg); die;
   $kurangiStok = $rowBrg - $banyaknya;

   $totalHarga = $harga * $banyaknya;
   $tglSekarang = date('Y-m-d');
   $barang = mysqli_query($conn, "UPDATE barang SET stok = '$kurangiStok' WHERE id_barang = $id_barang") or die(mysqli_error($conn));

   if ($barang) {
      $queryNota = mysqli_query($conn, "INSERT INTO nota VALUES (null, '$id_barang', '$banyaknya', '$harga', '$id_user', '$warna', null, null, '$tipe', 0, '$tglSekarang')") or die(mysqli_error($conn));

      if ($queryNota) {
         $last_id = mysqli_insert_id($conn);
         mysqli_query($conn, "INSERT INTO transaksi VALUES (null, '$id_user', '$totalHarga', '$last_id')") or die(mysqli_error($conn));
      }
   }

   return mysqli_affected_rows($conn);
}

function vermak($data, $role) {
   global $conn;
   // var_dump($data); die;
   $deskripsi = htmlspecialchars($data['deskripsi']);
   $nama_pelanggan = htmlspecialchars($data['nama_pelanggan']);
   $banyaknya = htmlspecialchars($data['banyaknya']);
   $pilih_vermak = htmlspecialchars($data['pilih_vermak']);
   if ($role == 2) {
      $id_user = htmlspecialchars($data['id_user']);
   }

   if ($pilih_vermak == null || $deskripsi == null) {
      echo "<script>alert('Inputan Wajib Diisi.');window.location='index.php';</script>";
      return false;
   }

   $hargaPerHelai = 1 * $pilih_vermak;
   $totalHarga = $banyaknya * $pilih_vermak;

   if($role == 2) {
      $queryNota = mysqli_query($conn, "INSERT INTO nota VALUES (null, null, '$banyaknya', '$hargaPerHelai', '$id_user', null, '$deskripsi', '$nama_pelanggan', 'Vermak')");

      if ($queryNota) {
         $last_id = mysqli_insert_id($conn);
         mysqli_query($conn, "INSERT INTO transaksi VALUES (null, '$id_user', '$totalHarga', '$last_id')");
      }

   } elseif($role == null) {
      $queryUser = mysqli_query($conn, "INSERT INTO user VALUES (null, '$nama_pelanggan', '2', null, null)") or die(mysqli_error($conn));
      if ($queryUser) {
         $id_user_terakhir = mysqli_insert_id($conn);
         $queryNota = mysqli_query($conn, "INSERT INTO nota VALUES (null, null, '$banyaknya', '$hargaPerHelai', '$id_user_terakhir', null, '$deskripsi', '$nama_pelanggan', 'Vermak')") or die(mysqli_error($conn));

         if ($queryNota) {
            $last_id = mysqli_insert_id($conn);
            mysqli_query($conn, "INSERT INTO transaksi VALUES (null, '$id_user_terakhir', '$totalHarga', '$last_id')") or die(mysqli_error($conn));
         }
      }

   }
   return mysqli_affected_rows($conn);
}

function edit_nota_vermak($data) {
   global $conn;
   $id_nota = htmlspecialchars($data['id_nota']);
   $deskripsi_nota = htmlspecialchars($data['deskripsi_nota']);
   $nama_pelanggan = htmlspecialchars($data['nama_pelanggan']);
   $banyaknya = htmlspecialchars($data['banyaknya']);
   $tipe = htmlspecialchars($data['tipe']);
   $pilih_vermak = htmlspecialchars($data['pilih_vermak']);

   $hargaPerHelai = 1 * $pilih_vermak;
   $totalHarga = $banyaknya * $pilih_vermak;

   $queryNota = mysqli_query($conn, "UPDATE nota SET harga = '$hargaPerHelai', deskripsi_nota = '$deskripsi_nota', nama_pelanggan = '$nama_pelanggan', tipe = '$tipe', banyaknya = '$banyaknya' WHERE id_nota = $id_nota");

   if($queryNota) {
      mysqli_query($conn, "UPDATE transaksi SET hrg_total = '$totalHarga' WHERE id_nota = $id_nota");
   }

   return mysqli_affected_rows($conn);
}

function edit_nota_baru($data) {
   global $conn;
   $id_nota = htmlspecialchars($data['id_nota']);
   $id_user = htmlspecialchars($data['id_user']);
   $nama_pelanggan = htmlspecialchars($data['nama_pelanggan']);
   $banyaknya = htmlspecialchars($data['banyaknya']);
   $pilih_baru = htmlspecialchars($data['pilih_baru']);
   $pecah = explode(',', $pilih_baru);
   $harga = intval($pecah[1]);
   // var_dump($harga); die;
   $id_barang = intval($pecah[0]);

   $total = $harga * $banyaknya;

   $queryUser = mysqli_query($conn, "UPDATE user SET nama_user = '$nama_pelanggan' WHERE id_user = $id_user") or die(mysqli_error($conn));

   if ($queryUser) {
      $queryNota = mysqli_query($conn, "UPDATE nota SET banyaknya = '$banyaknya', id_barang = '$id_barang', harga = '$harga' WHERE id_nota = $id_nota") or die(mysqli_error($conn));
      if ($queryNota) {
         mysqli_query($conn, "UPDATE transaksi SET hrg_total = '$total' WHERE id_nota = $id_nota") or die(mysqli_error($conn));
      }
   }

   return mysqli_affected_rows($conn);
}

function sampai($data) {
   global $conn;
   $status = htmlspecialchars($data['sampai']);
   $id_nota = htmlspecialchars($data['id_nota']);
   mysqli_query($conn, "UPDATE nota SET status = '$status' WHERE id_nota = $id_nota") or die(mysqli_error($conn));
   return mysqli_affected_rows($conn);
}
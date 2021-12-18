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
<?php 
session_start();
require 'config/db.php';
require 'config/function.php';

if(isset($_POST['masuk'])) {
  $username = htmlspecialchars($_POST['username']);
  $password = htmlspecialchars($_POST['password']);

  $result = mysqli_query($conn, "SELECT * FROM user WHERE nama_user = '$username'") or die(mysqli_error($conn));
  $row = mysqli_fetch_assoc($result);
  if ($row != null) {
      // Administrator
      if ($row['role'] == 0) {
        $_SESSION['nama_user'] = $row['nama_user'];
        $_SESSION['role'] = $row['role'];
        header("Location: index.php");
        // Pemimpin
      } else if($row['role'] == 1) {
         $_SESSION['nama_user'] = $row['nama_user'];
         $_SESSION['role'] = $row['role'];
         header("Location: index.php");
         // Pelanggan
      } else if($row['role'] == 2) {
         $_SESSION['nama_user'] = $row['nama_user'];
         $_SESSION['role'] = $row['role'];
         header("Location: index.php");
      }
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Masuk - SURYA TAYLOR</title>
   <style>
      .container {
         margin: 30px;
      }

      .card-body {
         width: 500px;
         padding: 20px;
         margin: auto;
         box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
      }
   </style>
</head>
<body>
   <div class="container">
      <div class="card-body" align="center">
         <form action="" method="post">
            <p>
               <label for="username">Username</label>
               <input type="text" name="username" id="username" autofocus="on">
            </p>
            <p>
               <label for="password">Password</label>
               <input type="password" name="password" id="password">
            </p>
            <p>
               <button type="submit" name="masuk">Masuk</button>
               <a href="index.php">Website</a>
            </p>
         </form>
      </div>
   </div>
</body>
</html>
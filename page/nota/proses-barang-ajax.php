<?php 
require '../../config/db.php';

$id_brg = $_POST['id'];
$query = mysqli_query($conn, "SELECT * FROM barang WHERE id_barang = '$id_brg'");
$row = mysqli_fetch_assoc($query);
var_dump($id_brg);

echo json_encode($row);


?>
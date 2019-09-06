<?php 	
session_start();
// mendapatkan id_produk dari url
$id_produk = $_GET['id'];

// jika sudah ada produk dikeranjang, maka produk itu jumlahnya di +1
if(isset($_SESSION['keranjang'][$id_produk]))
{
	$_SESSION['keranjang'][$id_produk]+=1;
}
// jika belum ada dikeranjang, maka produk itu dianggap dibeli 1
else
{
	$_SESSION['keranjang'][$id_produk] = 1;
}


// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";

// pindahkan ke halaman jumlah
echo "<script>location='jumlah.php';</script>";
 ?>
<?php include 'koneksi.php';
session_start();
//koneksi ke database



// jika tidak ada session pelanggan(belum login)
if (!isset ($_SESSION["pelanggan"]) OR empty($_SESSION["pelanggan"]))
{
	echo "<script>alert('silahkan login');</script>";
	echo "<script>location='login.php';<script>";
	exit();
}

// mendapatkan id_pembelian dari url
$idpem = $_GET['id'];
$ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pembelian='$idpem'");
$detpem = $ambil->fetch_assoc();

// mendapatkan id_pelanggan yang beli
$id_pelanggan_beli = $detpem["id_pelanggan"];
// mendapatkan id_pelanggan yang login
$id_pelanggan_login = $_SESSION["pelanggan"]["id_pelanggan"];

if ($id_pelanggan_login ==$id_pelanggan_beli)
{
	echo "<script>location='nota.php';<script>";
	exit();
}
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>pembayaran</title>
 	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
 </head>
 <body>
 <?php include 'menu.php'; ?>

	 <div class="container">
	 	<h1>Konfirmasi Pembayaran</h1>
	 	<p>kirim bukti pembayaran anda</p>
	 	<div class="alert alert-info">total tagihan anda <strong>Rp. <?php echo number_format($detpem["total_pembelian"]) ?></strong></div>

	 	<form method="post" enctype="multipart/form-data">
	 	<table>
		<div class="form-group">
			<label>Nama Suplayer</label>
			<input type="text" class="form-control" name="nama suplayer">
		</div>
		<div class="form-group">
			<label>Bank</label>
			<input type="text" class="form-control" name="bank">
		</div>
		<div class="form-group">
			<label>Jumlah</label>
			<input type="number" class="form-control" name="jumlah" min="1">
		</div>
		<div class="form-group">
			<label>Bukti</label>
			<input type="file" name="bukti"></td>
		</div>
			<button class="btn btn-primary" name="Kirim">Kirim</button>
	 	</form>
	 </div>

 <?php 
 // jika ada tombol kirim
 if (isset($_POST["kirim"]))
 {
 	// upload dulu foto bukti
 	$namabukti = $_FILES["bukti"]["name"];
 	$lokasibukti = $_FILES["bukti"]["tmp_name"];
 	$namafiks = $namabukti;
 	move_uploaded_file($lokasibukti, "bukti_pembayaran/$namafiks");

 	$nama = $_POST["nama"];
 	$bank = $_POST["bank"];
 	$jumlah = $_POST["jumlah"];
 	$tanggal = date("Y-m-d");

 	$koneksi->query("INSERT INTO pembayaran(id_pembelian,nama,bank,jumlah,tanggal,bukti) VALUES ('$idpem','$nama','$bank','$jumlah','$tanggal','$namafiks') ");

 	// update data pembelian
 	$koneksi->query("UPDATE pembelian SET status_pembelian='sudah kirim pembayaran' WHERE id_pembelian='$idpem'");

 	echo "<script>alert('Terimakasih');</script>";
	echo "<script>location='riwayat.php';<script>";
 }
 ?>

 </body>
 </html>
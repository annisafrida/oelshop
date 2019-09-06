<?php include 'koneksi.php';?>
<!DOCTYPE html>
<html>
<head>
	<title>nota pembelian</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>

<?php include 'menu.php'; ?>

<section class="konten">
	<div class="container">
		


	<!-- nota disini diambil dari nota yang ada di admin -->
	<h2>Detail Pembelian</h2>
<?php 	
$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan
	ON pembelian.id_pelanggan=pelanggan.id_pelanggan
	WHERE pembelian.id_pembelian='$_GET[id]'");
$detail = $ambil->fetch_assoc();
 ?>
 

 
 <!-- jika pelanggan yang beli tidak ada sama dengan pelanggan yang login, maka akan ke riwayat.php karena tidak berhak melihat nota orang lain -->
 <!-- pelanggan yang beli harus pelanggan yang sudah login -->
 <?php 
 // mendapatkan id_pelanggan yang beli
 $idpelangganyangbeli = $detail["id_pelanggan"];

 // mendapatkan id_pelanggan yang login
 $idpelangganyanglogin = $_SESSION["pelanggan"]["id_pelanggan"];

 if ($idpelangganyangbeli=$idpelangganyanglogin)
 {
 	echo "<script>alert('!!!');</script>";
 	echo "<script>location='riwayat.php';</script>";
 	exit();
 }
  ?>


<div class="row">
	<div class="col-md-4">
		<h3>Pembelian</h3>
		<strong>No Pembelian: <?php echo $detail['id_pembelian'] ?></strong><br>
		Tanggal: <?php echo $detail['tanggal_pembelian']; ?><br>
		Total: Rp. <?php echo number_format($detail['total_pembelian']) ?>
	</div>
	<div class="col-md-4">
		<h3>Pelanggan</h3>
		<strong><?php echo $detail['nama_pelanggan']; ?></strong>
		<p>
			<?php echo $detail['no_telp']; ?> <br>
 			<?php echo $detail['email_pelanggan']; ?>
		</p>
	</div>
	<div class="col-md-4">
		<h3>Pengiriman</h3>
		<strong><?php echo $detail['nama_kota'] ?></strong><br>
		ongkos kirim: Rp. <?php echo number_format($detail['tarif']); ?><br>
		Alamat: <?php echo $detail['alamat_pengiriman'] ?>
	</div>
</div>

 <table class="table table-bordered">	
 	<thead>	
 		<tr>	
 			<th>no</th>
 			<th>nama produk</th>
 			<th>harga</th>
 			<th>jumlah</th>
 			<th>subtotal</th>
 		</tr>
 	</thead>
 	<tbody>	
 		<?php $nomor=1; ?>
 		<?php $ambil=$koneksi->query("SELECT * FROM pembelian_produk WHERE id_pembelian='$_GET[id]'"); ?>
 		<?php while($pecah=$ambil->fetch_assoc()) { ?>
 		<tr>	
 			<td><?php echo $nomor; ?></td>
 			<td><?php echo $pecah['nama']; ?></td>
 			<td>Rp. <?php echo number_format($pecah['harga']); ?></td>
 			<td><?php echo $pecah['harga']; ?></td>
 			<td><?php echo $pecah['jumlah']; ?></td>
 			<td>Rp. <?php echo number_format($pecah['subharga']); ?></td>
 		</tr>
 		<?php $nomor++; ?>
 	    <?php } ?>
 	</tbody>
 </table>


	</div>
</section>

</body>
</html>
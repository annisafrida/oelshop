<?php include 'koneksi.php';
session_start();
//koneksi ke database


// jika tidak ada session pelanggan(belum login)
if (!isset ($_SESSION["pelanggan"]) OR empty($_SESSION["pelanggan"]))
{
	echo "<script>alert('silahkan login');</script>";
	echo "<script>location='login.php';<script>";
	exit ();
}
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Toko Oelshop</title>
 	<link rel="stylesheet" href="admin//assets/css/bootstrap.css">
 </head>
 <body>


 	<?php include 'menu.php'; ?>


 <section class="riwayat">
 	<div class="container">
 		<h3>Riwayat Belanja <?php echo $_SESSION["pelanggan"]["nama_pelanggan"] ?></h3>

 		<table class="table table-bordered">
 			<thead>
 				<tr>
 					<th>No</th>
 					<th>Tanggal</th>
 					<th>Status</th>
 					<th>Total</th>
 					<th>Opsi</th>
 				</tr>
 			</thead>
 			<tbody>
 				<?php
 				$nomor=1;
 				// mendapatkan id_pelanggan yang login dari session
 				$id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];

 				$ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pelanggan='$id_pelanggan'");
 				while($pecah = $ambil->fetch_assoc()){
 				?>
 				<tr>
 					<td><?php echo $nomor; ?></td>
 					<td><?php echo $pecah["tanggal_pembelian"] ?></td>
 					<td><?php echo $pecah["status_pembelian"] ?></td>
 					<td>Rp. <?php echo number_format($pecah["total_pembelian"]) ?></td>
 					<td>
 						<a href="nota.php?id=<?php echo $pecah["id_pembelian"] ?>" class="btn btn-info">Nota</a>
 						<a href="pembayaran.php?id=<?php echo $pecah["id_pembelian"]; ?>" class="btn btn-success">Pembayaran</a>
 					</td>
 				</tr>
 				<?php $nomor++; ?>
 				<?php } ?>
 			</tbody>
 		</table>
 	</div>
 </section>
 
 </body>
 </html>
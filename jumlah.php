<?php session_start(); ?>
<?php include 'koneksi.php'; ?>
<?php 
// mendapatkan id_produk dari url
$id_produk = '$_GET[id]';

// query ambil data
$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
$detail = $ambil->fetch_assoc();


 ?>
<!DOCTYPE html>
<html>
<head>
	<title>detail produk</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">

</head>
<body>

<?php include 'menu.php'; ?>

<section class="konten">
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<img src="foto_produk/<?php echo $detail["foto_produk"]; ?>" alt="" class="img-responsive">
			</div>
			<div class="col-md-4"></div>
			<h2><?php echo $detail["nama_produk"] ?></h2>
		

			<form method="post">
				<div class="form-group">
					<div class="input-group">
						<input type="number" min="1" class="form-control" name="jumlah">
						<div class="input-group-btn">
							<a href="keranjang.php?halaman=keranjang" class="btn btn-primary">Beli</a>
						</div>
					</div>
				</div>
			</form>

			<?php 
			// jika ada tombol beli
			if (isset($_POST["Beli"]))
			{
				// mendapatkan jumlah yang diinputkan
				$jumlah = $_POST["jumlah"];
				// masukan di keranjang belanja
				$_SESSION["keranjang"][$jumlah] = $jumlah;

				echo "<script>alert('produk telah masuk pada keranjang belanja');</script>";
				echo "<script>location='keranjang.php';</script>";
			}
			 ?>
			
		</div>
	</div>
</section>

</body>
</html>

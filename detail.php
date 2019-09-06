<?php session_start(); ?>
<?php include 'koneksi.php'; ?>
<?php 
// mendapatkan id_produk dari url
$id_produk = $_GET["id"];

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
			<h4>Rp. <?php echo number_format($detail["harga_produk"]); ?></h4>

			<form method="post">
				<div class="form-group">
					<div class="input-group">
						<div class="form-group">
   						 <label>Deskripsi</label>
  						  <textarea class="form-control" name="deskripsi" rows="5"></textarea>
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
				$_SESSION["keranjang"][$id_produk] = $jumlah;

				echo "<script>alert('produk telah masuk pada keranjang belanja');</script>";
				echo "<script>location='keranjang.php';</script>";
			}
			 ?>
			
		</div>
	</div>
</section>

</body>
</html>
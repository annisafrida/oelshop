<?php include 'koneksi.php';
session_start();
$koneksi = new mysqli("localhost","root","","oelshop");
?>
<!DOCTYPE html>
<html>
<head>
	<title>login pelanggan</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>


<?php include 'menu.php'; ?>

<div class="container">
	<div class="row">
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Login Pelanggan</h3>
				</div>
				<div class="panel-body">
					<form method="post">
						<div class="form-group">
							<label>Email</label>
							<input type="email" class="form-control" name="email">
						</div>
						<div class="form-group">	
							<label>Password</label>
							<input type="password" class="form-control" name="password">
						</div>
						<button class="btn btn-primary" name="login">LOGIN</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>


<?php 	
// jika ada tombol login(tekan tombol tersebut)
if (isset($_POST["login"]))
{

	$email = $_POST["email"];
	$password = $_POST["password"];
	// lakukan query dengan mengecek akun pada tabel di db
	$ambil = $koneksi->query("SELECT * FROM pelanggan
		WHERE email_pelanggan='$email' AND password_pelanggan='$password'");

	// mengitung akun yang terambil
	$akunyangcocok = $ambil->num_rows;

	// jika 1 akun yang cocok maka akan login
	if ($akunyangcocok==1)
	{
		// anda berhasil login
		// mendapatkan akun dalam bentuk array
		$akun =$ambil->fetch_assoc();
		// simpan dalam session pelanggan
		$_SESSION["pelanggan"] = $akun;
		echo "<script>alert('anda berhasil login');</script>";

		// jika sudah belanja
		if (isset($_SESSION["keranjang"]) OR !empty($_SESSION["keranjang"]))
		{
			echo "<script>location='checkout.php';</script>";
		}
		else
		{
			echo "<script>location='riwayat.php';</script>";
		}
	}
	else
	{
		// anda gagal login
		echo "<script>alert('anda gagal login, silahkan login kembali');</script>";
		echo "<script>location='login.php';</script>";
	}
}

 ?>

</body>
</html>
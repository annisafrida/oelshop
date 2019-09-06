<h2>Ubah Produk</h2>
<?php 
session_start();


include 'koneksi.php';
$ambil=$koneksi->query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
$pecah= $ambil->fetch_assoc();


 ?>

 <form method="post" enctype="multipart/form-data">
   <div class="form-group">
     <label>Nama Produk</label>
     <input type="text" name="nama" class="form-control" value="<?php echo $pecah['nama_produk']; ?>">
   </div><br>
    <div class="form-group">
     <label>Harga Rp</label>
     <input type="number"  class="form-control" name="harga" value="<?php echo $pecah['harga_produk']; ?>">
   </div><br>
    <div class="form-group">
     <img src=".../foto_produk/<?php echo $pecah['foto_produk'] ?>" width="200">
   </div><br>
   <button class="btn btn-primary" name="save">Simpan</button>

   
 </form>
<?php   
session_start();


include 'koneksi.php';
?>
<h2>Tambah Produk</h2>

<form method="post" enctype="multipart/form-data">
  <div class="from-group">
    <label>nama</label>
    <input type="text" class="form-control" name="nama">
  </div><br>
  <div class="form-group">
    <label>Harga (Rp)</label>
    <input type="number" class="form-control" name="harga">
  </div><br>
  <div class="form-group">
    <label>Deskripsi</label>
    <textarea class="form-control" name="deskripsi" rows="5"></textarea>
  </div><br>
  <div class="from-group">
    <label>Foto</label>
    <input type="file" class="form-control" name="foto">
  </div><br>
  <button class="btn btn-primary" name="save">Simpan</button>
</form>
<?php
if (isset($_POST['save']))
{
  $nama = $_FILES['foto']['name'];
  $lokasi = $_FILES['foto']['tmp_name'];
  move_uploaded_file($lokasi, ".../foto_produk/".$nama);
  $koneksi->query("INSERT INTO produk (nama_produk,harga_produk,foto_produk,deskripsi_produk)
    VALUES('$_POST[nama]','$_POST[harga]','$nama','$_POST[deskripsi]')");

  echo " <div class='alert alert-info'>Data Tersimpan</div>";
 echo "<meta http-equiv='refresh' content='1;url=produk.php?halaman=produk'>";

} 
 ?>

<?php 
//
include '../koneksi.php';
//
error_reporting();
//
session_start();
//
include '../header.php';
if ($_SESSION['level']=="") {
	header("location:../index.php?pesan=login");
}

if (isset($_POST['submit'])){
	
    include '../koneksi.php';
    //menggambil data dari halaman sebelumnya
    $id_produk = $_POST['id_produk'];
        $nama = $_POST['nama'];
        $harga = $_POST['harga'];
        $stok = $_POST['stok'];
        //query mengupdate data
        $query = "UPDATE produk SET id_produk='$id_produk', nama='$nama', harga='$harga', stok='$stok' where id_produk='$id_produk'";
        mysqli_query($koneksi, $query);
    
        //mengalihkan ke halaman akun.php
        header("location:data_produk.php?pesan=update");
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Edit produk</title>
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
	<script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
  	<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-image: url('../img/bg3.png'); background-size:30em;">




<br>
	<div class="judul">
		<h1 align="center" style="">Edit produk</h1>
	</div>

	<br>
	<?php  
include '../koneksi.php';
$id_produk = $_GET['id_produk'];
$sql = "SELECT * from produk where id_produk='$id_produk'";
$result = mysqli_query($koneksi, $sql);
$nomor = 1;
while ($data = mysqli_fetch_assoc($result)) {
	?>
	<div class="border border-start-9 shadow-lg p-3 mb-5 bg-body-tertiary rounded" style="width:350px; margin:auto;">
    	<form action="" method="POST" class="login-email">
			<div class="mb-3">
				<label class="form-label">Nama</label>
				<input type="hidden" class="form-control"placeholder="" name="id_produk" value="<?php echo $data['id_produk'] ?>" required>
				<input type="text" class="form-control"placeholder="Nama" name="nama" value="<?php echo $data['nama'] ?>" required>
			</div>
			<div class="mb-3">
				<label class="form-label">Harga</label>
				<input type="number" class="form-control"placeholder="Harga" name="harga" value="<?php echo $data['harga'] ?>" required>
			</div>
			<div class="mb-3">
				<label class="form-label">Stok</label>
				<input type="number" class="form-control" placeholder="Stok" name="stok" value="<?php echo $data['stok'] ?>" required>
			</div>
            <div class="d-grid gap-2">
				<button name="submit" class="btn btn-success">Simpan</button>	
			</div>
		</form>
		<a href="akun.php" class="tombol"><button class="btn btn-primary" style=" margin-top: 5px;">Lihat semua data</button></a>
	</div>
<?php } ?>


</body>
</html>
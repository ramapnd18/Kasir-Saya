<?php 
//
include '../koneksi.php';
//
error_reporting(0);
//
session_start();
//
include '../header.php';
if ($_SESSION['level']=="") {
	header("location:../index.php?pesan=login");
}

if (isset($_POST['submit'])){
	$nama = $_POST['nama'];
	$harga = $_POST['harga'];
	$stok = $_POST['stok'];

	$sql = "SELECT * from produk where nama='$nama'";
	$result = mysqli_query($koneksi,$sql);

	if (!$result->num_rows>0) {
		$sql = "INSERT INTO produk (id_produk, nama, harga, stok) values ('', '$nama', '$harga','$stok') ";
		$result = mysqli_query($koneksi, $sql);

		//
		if ($result) {
			header("location:data_produk.php?pesan=input");
		//
		} else {
				echo "<script>alert('Woops!, Terjadi Kesalahan')</script>";
		}
	//
	}else{
			echo "<script>alert('Woops!, Nama Sudah Terdaftar')</script>";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Tambah Produk</title>
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
    <link rel="shortcut icon" href="../img/logo_bapenda1.png">
	<script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
		<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-image: url('../img/bg3.png'); background-size:30em;">



<br>
	<div class="judul">
		<h1 align="center" style="">Tambah Produk</h1>
	</div>

	<br>

	<div class="border border-start-0 shadow-lg p-3  bg-body-tertiary rounded" style="width:300px; margin:auto;">
		<form action="" method="POST" class="login-email">
			<div class="mb-3">
				<label class="form-label">Nama</label>
				<input type="text" class="form-control"placeholder="Nama" name="nama" value="<?php echo $nama;  ?>" required>
			</div>
			<div class="mb-3">
				<label class="form-label">Harga</label>
				<input type="number" class="form-control"placeholder="Harga" name="harga" value="<?php echo $harga;  ?>" required>
			</div>
			<div class="mb-3">
				<label class="form-label">Stok</label>
				<input type="number" class="form-control" placeholder="Stok" name="stok" value="<?php echo $stok;  ?>" required>
			</div>
            <div class="d-grid gap-2">
				<button name="submit" class="btn btn-success">Simpan</button>	
			</div>
		</form>
		<a href="akun.php" class="tombol"><button class="btn btn-primary" style=" margin-top: 5px;">Lihat semua data</button></a>
	</div>
    <br>
</body>
</html>
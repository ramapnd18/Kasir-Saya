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
	$nama_pengguna = $_POST['nama_pengguna'];
	$kata_sandi = $_POST['kata_sandi'];
    $level = $_POST['level'];

	$sql = "SELECT * from pengguna where nama_pengguna='$nama_pengguna'";
	$result = mysqli_query($koneksi,$sql);

	if (!$result->num_rows>0) {
		$sql = "INSERT INTO pengguna (id_pengguna, nama, nama_pengguna, kata_sandi, level) values ('', '$nama', '$nama_pengguna','$kata_sandi', '$level') ";
		$result = mysqli_query($koneksi, $sql);

		//
		if ($result) {
			header("location:akun.php?pesan=input");
		//
		} else {
				echo "<script>alert('Woops!, Terjadi Kesalahan')</script>";
		}
	//
	}else{
			echo "<script>alert('Woops!, Nama Pengguna Sudah Terdaftar')</script>";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Tambah Pengguna</title>
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
    <link rel="shortcut icon" href="../img/logo_bapenda1.png">
	<script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
		<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-image: url('../img/bg3.png'); background-size:30em;">



<br>
	<div class="judul">
		<h1 align="center" style="">Tambah Pengguna</h1>
	</div>

	<br>

	<div class="border border-start-0 shadow-lg p-3  bg-body-tertiary rounded" style="width:300px; margin:auto;">
		<form action="" method="POST" class="login-email">
			<div class="mb-3">
				<label class="form-label">Nama</label>
				<input type="text" class="form-control"placeholder="Nama" name="nama" value="<?php echo $nama;  ?>" required>
			</div>
			<div class="mb-3">
				<label class="form-label">Nama Pengguna</label>
				<input type="text" class="form-control"placeholder="Nama Pengguna" name="nama_pengguna" value="<?php echo $nama_pengguna;  ?>" required>
			</div>
			<div class="mb-3">
				<label class="form-label">Kata Sandi</label>
				<input type="password" class="form-control" placeholder="Kata Sandi" name="kata_sandi" value="<?php echo $kata_sandi;  ?>" required>
			</div>
			
            <div class="d-grid gap-2 mb-3">
				<label>Jenis Akun</label>
                <select class="form-select" id="level" name="level">
						<option value="admin" <?php if ($row['level'] == 'admin') echo 'selected'; ?>>Admin</option>
						<option value="kasir" <?php if ($row['level'] == 'kasir') echo 'selected'; ?>>Kasir</option>
              		</select>
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
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
    $id_pelanggan = $_POST['id_pelanggan'];
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $telepon = $_POST['telepon'];
        //query mengupdate data
        $query = "UPDATE pelanggan SET id_pelanggan='$id_pelanggan', nama='$nama', alamat='$alamat', telepon='$telepon' where id_pelanggan='$id_pelanggan'";
        mysqli_query($koneksi, $query);
    
        //mengalihkan ke halaman akun.php
        header("location:data_pelanggan.php?pesan=update");
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Edit pelanggan</title>
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
	<script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
  	<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-image: url('../img/bg3.png'); background-size:30em;">




<br>
	<div class="judul">
		<h1 align="center" style="">Edit Pelanggan</h1>
	</div>

	<br>
	<?php  
include '../koneksi.php';
$id_pelanggan = $_GET['id_pelanggan'];
$sql = "SELECT * from pelanggan where id_pelanggan='$id_pelanggan'";
$result = mysqli_query($koneksi, $sql);
$nomor = 1;
while ($data = mysqli_fetch_assoc($result)) {
	?>
	<div class="border border-start-9 shadow-lg p-3 mb-5 bg-body-tertiary rounded" style="width:350px; margin:auto;">
    <form action="" method="POST" class="login-email">
			<div class="mb-3">
				<label class="form-label">Nama</label>
				<input type="hidden" class="form-control"placeholder="" name="id_pelanggan" value="<?php echo $data['id_pelanggan'] ?>" required>
				<input type="text" class="form-control"placeholder="Nama" name="nama" value="<?php echo $data['nama'] ?>" required>
			</div>
			<div class="mb-3">
				<label class="form-label">Alamat</label>
				<input type="text" class="form-control"placeholder="Alamat" name="alamat" value="<?php echo $data['alamat'] ?>" required>
			</div>
			<div class="mb-3">
				<label class="form-label">Kata Sandi</label>
				<input type="text" class="form-control" placeholder="Kata Sandi" name="telepon" value="<?php echo $data['telepon'] ?>" required>
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
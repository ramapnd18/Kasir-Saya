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
$id_pengguna = $_POST['id_pengguna'];
    $nama = $_POST['nama'];
    $nama_pengguna = $_POST['nama_pengguna'];
    $kata_sandi = $_POST['kata_sandi'];
    $level = $_POST['level'];
    //query mengupdate data
    $query = "UPDATE pengguna SET id_pengguna='$id_pengguna', nama='$nama', nama_pengguna='$nama_pengguna', kata_sandi='$kata_sandi', level='$level' where id_pengguna='$id_pengguna'";
    mysqli_query($koneksi, $query);

    //mengalihkan ke halaman akun.php
    header("location:akun.php?pesan=update");


}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Ubah Pengguna</title>
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
	<script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
  	<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-image: url('../img/bg3.png'); background-size:30em;">




<br>
	<div class="judul">
		<h1 align="center" style="">Ubah Data akun</h1>
	</div>

	<br>
	<?php  
include '../koneksi.php';
$id_pengguna = $_GET['id_pengguna'];
$sql = "SELECT * from pengguna where id_pengguna='$id_pengguna'";
$result = mysqli_query($koneksi, $sql);
$nomor = 1;
while ($data = mysqli_fetch_assoc($result)) {
	?>
	<div class="border border-start-9 shadow-lg p-3 mb-5 bg-body-tertiary rounded" style="width:350px; margin:auto;">
		<form action="" method="post">
		<table class="table table-borderless">
			<tr>
				<td>
					<input type="hidden" name="id_pengguna" value="<?php echo $data['id_pengguna'] ?>">
				</td>
			</tr>
			<tr>
				<td>Nama</td>
				<td><input type="text" name="nama" value="<?php echo $data['nama'] ?>" class="form-control"></td>
			</tr>
			<tr>
				<td>Nama Pengguna</td>
				<td><input type="text" name="nama_pengguna" value="<?php echo $data['nama_pengguna'] ?>" class="form-control"></td>
			</tr>
			<tr>
				<td>Kata Sandi</td>
				<td><input type="password" name="kata_sandi" value="<?php echo $data['kata_sandi'] ?>" class="form-control"></td>
			</tr>
            <tr>
                <td><label>Jenis Akun</label></td>
                <td>
                <div class="d-grid gap-2 mb-3">
					<select class="form-select" id="level" name="level">
						<option value="admin" <?php if ($row['level'] == 'admin') echo 'selected'; ?>>Admin</option>
						<option value="kasir" <?php if ($row['level'] == 'kasir') echo 'selected'; ?>>Kasir</option>
              		</select>
			    </div>
                </td>
            </tr>
			<tr>
				<td colspan="2">
                <div class="d-grid gap-2">
					<button name="submit" class="btn btn-success">Simpan</button>
			    </div>
                </td>
			</tr>
		</table>
		</form>
		<a href="akun.php" class="tombol"><button class="btn btn-primary" style="margin-top: 5px;">Lihat semua data</button></a>
	</div>
<?php } ?>


</body>
</html>
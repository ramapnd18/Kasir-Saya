<!DOCTYPE html>
<html>
<head>
	<title>Data Pengguna</title>
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
	<script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body style="background-image: url('../img/bg3.png'); background-size:30em;">
<?php
include '../koneksi.php';
//
error_reporting(0);
//
session_start();
//
include '../header.php';
if ($_SESSION['level'] != "admin") {
    header("Location: ../index.php");
    exit;
  }

if (isset($_GET['pesan'])) {
	$pesan = $_GET['pesan'];
	if ($pesan == "input") {
		echo "<div class='text-bg-primary p-3' style='text-align: center;'>Data berhasil di tambahkan.</div>";
	}else if ($pesan == "update") {
		echo "<div class='text-bg-success p-3' style='text-align: center;'>Data berhasil di update.</div>";
	}else if ($pesan == "hapus") {
		echo "<div class='text-bg-danger p-3' style='text-align: center;'>Data berhasil di hapus.</div>";
	}
}
?>

	<div class="container content-wrapper border-start-9 shadow-lg p-3 mt-5 bg-body-tertiary rounded" style="" >
		<div style=""><h1>Data Pengguna</h1>
		<div class="">
	
		<a href="tambah_akun.php" class="tombol"><button class="btn btn-primary mb-3" style="">Tambah Pengguna</button></a>
		<a href="print.php" target="_blank" class="tombol"><button class="btn btn-primary mb-3" style=""><img src="../img/print.png" alt="print" style="width:20px; color:white;"></button></a>

		</div>
		</div>
	
		<div class="table-responsive">
		<table border="1" class="table table-bordered table-hover" >
		<tr>
			<th>No</th>	
			<th>Nama</th>
			<th>Nama Pengguna</th>
			<th>Kata Sandi</th>
            <th>Jenis Akun</th>
			<th>Aksi</th>
		</tr>
		<?php

		include "../koneksi.php";	
		$result = mysqli_query($koneksi,"SELECT * from pengguna ");		
		$nomor = 1;
		while ($data = mysqli_fetch_assoc($result)) {
			
		
		?>
			<tr>
				<td><?php echo $nomor++; ?></td>
				<td><?php echo $data['nama']; ?></td>
				<td><?php echo $data['nama_pengguna']; ?></td>
				<td><?php echo $data['kata_sandi']; ?></td>
                <td><?php echo $data['level']; ?></td>
				<td>
					<a class="edit" href="edit_akun.php?id_pengguna=<?php echo $data['id_pengguna']; ?>"><button class="btn btn-primary">Edit</button></a>
					<a class="hapus" href="hapus_akun.php?id_pengguna=<?php echo $data['id_pengguna']; ?>"><button class="btn btn-danger">Hapus</button></a>
				</td>
			</tr>
		<?php } ?>
	</table>
		</div>
	</div>
    <br>
</body>
</html>
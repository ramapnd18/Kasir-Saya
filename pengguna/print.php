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
if ($_SESSION['level'] != "admin") {
    header("Location: ../index.php");
    exit;
  }

?>

	<div class="container content-wrapper border-start-9 shadow-lg p-3 mt-5 bg-body-tertiary rounded" style="" >
		<div style=""><h1>Data Pengguna</h1>
		</div>
	
		<div class="table-responsive">
		<table border="1" class="table table-bordered table-hover" >
		<tr>
			<th>No</th>	
			<th>Nama</th>
			<th>Nama Pengguna</th>
			<th>Kata Sandi</th>
            <th>Jenis Akun</th>
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
			</tr>
		<?php } ?>
	</table>
		</div>
	</div>
	<script>
		window.print()
	</script>
</body>
</html>
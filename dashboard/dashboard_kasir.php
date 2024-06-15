<!DOCTYPE html>
<html>
<head>
	<title>Admin</title>
  <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
  <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
  <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-image: url(''); background-size:30em;">
	<?php
session_start();
include '../header.php';
//cek apakah yang mengakses halaman ini sudah login
if ($_SESSION['level'] == "") {
	header("location:index.php?pesan=gagal");
}
?>

  <div class="container content-wrapper border-start-9 shadow-lg p-3 mt-5 bg-body-tertiary rounded" style="" >
	<div style="margin:auto; width: 200px;"><img src="../img/logok.png" style="width:100%;" class=""></div>
		<div style=""><h1>Selamat datang di Dashboard Kasir!</h1>
		<p class="write">Pusat kontrol untuk mengelola sistem Anda.</p>
	</div>
</body>
</html>
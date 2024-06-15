<?php
//mengaktifkan session pada php
session_start();

//menghubungkan php dengan koneksi database
include 'koneksi.php';

//menangkap data yang dikirimkan dari form login
$nama_pengguna = $_POST['nama_pengguna'];
$kata_sandi = $_POST['kata_sandi'];

//menyeleksi data user dengan nama_pengguna dan kata_sandi yang sesuai
$login = mysqli_query($koneksi, "SELECT * from pengguna where nama_pengguna='$nama_pengguna' and kata_sandi='$kata_sandi'");
//menghitung jumlah data yang ditentukan
$cek = mysqli_num_rows($login);

//cek apakah nama_pengguna dan kata_sandi di temukan pada database
if ($cek>0) {
	$data = mysqli_fetch_assoc($login);

	//cek jika user login sebagain admin
	if ($data['level'] =="admin") {
		
		//buat session login dan nama_pengguna
		$_SESSION['nama_pengguna']=$nama_pengguna;
		$_SESSION['level'] ="admin";
		//alihkan ke halaman dashboard admin
		header("location:dashboard/dashboard_admin.php");

		//cek jika user login sebagai kasir
	}else if ($data['level'] == "kasir") {
		
		//buat session login dan nama_pengguna
		$_SESSION['id_pengguna']=$data['id_pengguna'];
		$_SESSION['nama_pengguna']=$nama_pengguna;
		$_SESSION['level'] ="kasir";
		//alihkan ke halaman dashboard pembeli
		header("location:dashboard/dashboard_kasir.php");
	}else{
		//alihkan ke halaman login kembali
	header("location:index.php?pesan=gagal"); 
	}
}else{

	//alihkan ke halaman login kembali
	header("location:index.php?pesan=gagal");
}

?>
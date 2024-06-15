<?php
  include 'koneksi.php';
  //
  error_reporting(0);
  //
  session_start();
  //
  if ($_SESSION['level']=="admin") {
    ?>
    <nav class="navbar navbar-expand-lg sticky-top "  data-bs-theme="dark" style="background-color:#62120e; color:white; font-weight: bold;">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Admin</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="../dashboard/dashboard_admin.php">Beranda</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../pengguna/akun.php">Data Pengguna</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../pelanggan/data_pelanggan.php">Data Pelanggan</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../produk/data_produk.php">Data Produk</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../penjualan/data_penjualan.php">Data Penjualan</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../logout.php">Keluar</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    <?php
  } else if ($_SESSION['level']=="kasir") {
    ?>
    <nav class="navbar navbar-expand-lg sticky-top "  data-bs-theme="dark" style="background-color:#62120e; color:white; font-weight: bold;">
        <div class="container-fluid">
          <a class="navbar-brand" href="#"> Kasir</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="../dashboard/dashboard_kasir.php">Beranda</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../pelanggan/data_pelanggan.php">Data Pelanggan</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../produk/data_produk.php">Data Produk</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../penjualan/data_penjualan.php">Data Penjualan</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../logout.php">Keluar</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    <?php
  }
?>
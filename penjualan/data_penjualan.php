<!DOCTYPE html>
<html lang="en">
<head>
  <title>Data Penjualan</title>
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
	<script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<?php
  session_start();

  include '../header.php';
  include '../koneksi.php';
  
  // Check for admin login
  if ($_SESSION['level'] != "admin" && $_SESSION['level'] != "kasir") {
    header("Location: ../index.php");
    exit;
  }


  // Get all sales data with joins
  $sql = "SELECT p.id_penjualan, p.tanggal, p.total_harga,
          u.nama AS nama_kasir, pl.nama AS nama_pelanggan,
          pr.nama AS nama_produk, p.jumlah, p.harga_satuan
          FROM penjualan p
          INNER JOIN pengguna u ON p.id_pengguna = u.id_pengguna
          INNER JOIN pelanggan pl ON p.id_pelanggan = pl.id_pelanggan
          INNER JOIN produk pr ON p.id_produk = pr.id_produk";
  $result = mysqli_query($koneksi, $sql);
?>


<div class="container content-wrapper border-start-9 shadow-lg p-3 mt-5 bg-body-tertiary rounded">
  <div class="row">
    <div class="col-md-12">
      <main class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <h1 class="tittle mt-3">Data Penjualan</h1>
        <a href="tambah_penjualan.php" class="btn btn-primary mb-3">Tambah Penjualan</a>
        <a href="print.php" target="_blank" class="tombol"><button class="btn btn-primary mb-3" style=""><img src="../img/print.png" alt="print" style="width:20px; color:white;"></button></a>
        <div class="table-responsive">
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>ID Penjualan</th>
                <th>Tanggal Penjualan</th>
                <th>Kasir</th>
                <th>Pelanggan</th>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Total Bayar</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
             if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['id_penjualan'] . "</td>";
                echo "<td>" . $row['tanggal'] . "</td>";
                echo "<td>" . $row['nama_kasir'] . "</td>";
                echo "<td>" . $row['nama_pelanggan'] . "</td>";
                echo "<td>" . $row['nama_produk'] . "</td>";
                echo "<td>" . $row['jumlah'] . "</td>";
                echo "<td>" . $row['harga_satuan'] . "</td>";
                echo "<td>" . $row['total_harga'] . "</td>";

                echo "<td>";
                  echo "<a href='edit_penjualan.php?id_penjualan=" . $row['id_penjualan'] . "' class='btn btn-primary'>Edit</a>";
                  echo "<a href='hapus_penjualan.php?id_penjualan=" . $row['id_penjualan'] . "' class='btn btn-danger'>Hapus</a>";
                  echo "</td>";
                echo "</tr>";
              }
              } else {
                echo "<tr><td colspan='5'>Tidak ada data Penjualan</td></tr>";
              }
              ?>
            </tbody>
          </table>
        </div>
      </main>
    </div>
  </div>
</div>

</body>
</html>
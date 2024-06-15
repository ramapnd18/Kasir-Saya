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
	$kasir = $_POST['kasir'];
	$pengguna = $_POST['pengguna'];
	$pelanggan = $_POST['pelanggan'];
	$produk = $_POST['produk'];
	$jumlah = $_POST['jumlah'];

    $harga_satuan_query = "SELECT harga from produk where id_produk = '$produk'";
    $harga_result = mysqli_query($koneksi, $harga_satuan_query);

    if ($harga_result && mysqli_num_rows($harga_result)>0) {
        $data = mysqli_fetch_assoc($harga_result);
        $harga_satuan = $data['harga'];
    }else{
        $harga_satuan = 0;
    }

    //hitung total
    $total_harga = $jumlah * $harga_satuan;

    //insert
		$sql = "INSERT INTO penjualan (id_penjualan, tanggal, id_pengguna, id_pelanggan, id_produk, jumlah, harga_satuan, total_harga) 
        values ('', NOW(), '$kasir', '$pelanggan', '$produk', '$jumlah', '$harga_satuan', '$total_harga') ";
		$result = mysqli_query($koneksi, $sql);

		//
		if ($result) {
            $jumlah_query = "SELECT stok from produk where id_produk = '$produk'";
            $jumlah_result = mysqli_query($koneksi, $jumlah_query);
            $data = mysqli_fetch_assoc($jumlah_result);
            $awaljumlah=$data['stok'];
            $akhir_jumlah=$awaljumlah-$jumlah;
            $sql = "UPDATE produk set stok='$akhir_jumlah' where id_produk='$produk'";
            $result_jumlah = mysqli_query($koneksi, $sql);

            if ($result_jumlah) {
                header("location:data_penjualan.php");
                
            }
		//
		} else {
				echo "Error:" . mysqli_error($koneksi);
		}
	//

}

    $sql = "SELECT * from pengguna";
	$result_pengguna = mysqli_query($koneksi,$sql);

    $sql = "SELECT * from pelanggan";
	$result_pelanggan = mysqli_query($koneksi,$sql);
    
    $sql = "SELECT * from produk";
	$result_produk = mysqli_query($koneksi,$sql);

    $hargaSatuanData =[];
    while ($data = mysqli_fetch_assoc($result_produk)) {
        $hargaSatuanData [$data['id_produk']] = $data['harga'];
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Tambah penjualan</title>
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
    <link rel="shortcut icon" href="../img/logo_bapenda1.png">
	<script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
		<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="">



<br>
	<div class="judul">
		<h1 align="center" style="">Tambah penjualan</h1>
	</div>

	<br>

	<div class="border border-start-0 shadow-lg p-3  bg-body-tertiary rounded" style="width:300px; margin:auto;">
		<form action="" method="POST" class="login-email">
			<div class="mb-3">
				<label class="form-label">Kasir</label>
				<select name="kasir" id="kasir" class="form-control">
                    <?php
                        while ($data = mysqli_fetch_assoc($result_pengguna)) {
                            ?>
                            <option value="<?php echo $data['id_pengguna']?>"><?php echo $data['nama']?></option>
                            <?php
                        }
                    ?>
                </select>
			</div>
            <div class="mb-3">
				<label class="form-label">Pelanggan</label>
				<select name="pelanggan" id="pelanggan" class="form-control">
                    <?php
                        while ($data = mysqli_fetch_assoc($result_pelanggan)) {
                            ?>
                            <option value="<?php echo $data['id_pelanggan']?>"><?php echo $data['nama']?></option>
                            <?php
                        }
                        ?>
                </select>
			</div>
            <div class="mb-3">
                <label class="form-label">Jumlah</label>
                <input type="number" class="form-control"placeholder="Jumlah" name="jumlah" id="jumlah"  required>
            </div>
            <div class="mb-3">
				<label class="form-label">Produk</label>
                <select name="produk" id="produk" class="form-control" onchange="updateHargaSatuan()">
                    <?php
                        mysqli_data_seek($result_produk, 0);
                        while ($data = mysqli_fetch_assoc($result_produk)) {
                            ?>
                            <option value="<?php echo $data['id_produk']?>"><?php echo $data['nama']?></option>
                            <?php
                        }
                    ?>
                </select>
			</div>
            <div class="mb-3">
                <label class="form-label">Harga satuan</label>
                <input type="number" class="form-control"placeholder="Harga satuan" name="harga_satuan" id="harga_satuan"  readonly required>
            </div>
            <div class="mb-3">
                <label class="form-label">Total Harga</label>
                <input type="number" class="form-control"placeholder="Total" name="harga_total" id="harga_total"  readonly required>
            </div>
            <div class="d-grid gap-2">
				<button name="submit" class="btn btn-success">Simpan</button>	
			</div>
		</form>
		<a href="data_penjualan.php" class="tombol"><button class="btn btn-primary" style=" margin-top: 5px;">Lihat semua data</button></a>
	</div>
    <br>

    <script>
        var hargaSatuanData = <?php echo json_encode($hargaSatuanData); ?>;

        function updateHargaSatuan() {
            // mengambil id yang terpilih
            var selectProdukId = document.getElementById('produk').value;

            //update harga_satuan filed
            document.getElementById("harga_satuan").value = hargaSatuanData[selectProdukId] || '';

            //hitung dan update total harga
            updateTotalHarga();

        }

        function updateTotalHarga() {
            //ambil value jumlah dan harga_satuan
            var jumlah = document.getElementById('jumlah').value;
            var hargaSatuan = document.getElementById('harga_satuan').value;
            
            //hitung
            var totalHarga = jumlah * hargaSatuan;

            //upate
            document.getElementById('harga_total').value = totalHarga;
        }
    </script>
</body>
</html>
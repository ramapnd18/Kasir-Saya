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

?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit penjualan</title>
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
    <link rel="shortcut icon" href="../img/logo_bapenda1.png">
	<script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
		<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="">

<?php
session_start();

// Check for admin login
if (!isset($_SESSION['level']) || $_SESSION['level'] != "admin") {
    header("Location: index.php");
    exit;
}

// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "db_kasir");

// Check if an ID is provided in the URL
if (isset($_GET['id_penjualan'])) {
    $penjualan_id = $_GET['id_penjualan'];

    // Fetch the penjualan record from the database
    $penjualan_query = "SELECT * FROM penjualan WHERE id_penjualan = '$penjualan_id'";
    $penjualan_result = mysqli_query($conn, $penjualan_query);

    if ($penjualan_result && mysqli_num_rows($penjualan_result) > 0) {
        $penjualan_row = mysqli_fetch_assoc($penjualan_result);

        // Get lists of kasir, pelanggan, and produk for dropdowns
        $kasir_sql = "SELECT * FROM pengguna";
        $kasir_result = mysqli_query($conn, $kasir_sql);

        $pelanggan_sql = "SELECT * FROM pelanggan";
        $pelanggan_result = mysqli_query($conn, $pelanggan_sql);

        $produk_sql = "SELECT * FROM produk";
        $produk_result = mysqli_query($conn, $produk_sql);

        // Fetch harga_satuan data for all products
        $hargaSatuanData = [];
        while ($produk_row = mysqli_fetch_assoc($produk_result)) {
            $hargaSatuanData[$produk_row['id_produk']] = $produk_row['harga'];
        }
    } else {
        echo "Penjualan not found.";
        exit;
    }
} else {
    echo "ID not provided in the URL.";
    exit;
}

// **Process form submission**
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
     // Get data from the form
    $id_pengguna = $_POST['id_pengguna'];
    $id_pelanggan = $_POST['id_pelanggan'];
    $id_produk = $_POST['id_produk'];
    $jumlah = $_POST['jumlah'];

    // Fetch harga_satuan based on the selected product
    $harga_satuan_query = "SELECT harga FROM produk WHERE id_produk = '$id_produk'";
    $harga_satuan_result = mysqli_query($conn, $harga_satuan_query);

    if ($harga_satuan_result && mysqli_num_rows($harga_satuan_result) > 0) {
        $harga_satuan_row = mysqli_fetch_assoc($harga_satuan_result);
        $harga_satuan = $harga_satuan_row['harga'];
    } else {
        $harga_satuan = 0; // Set a default value or handle the error accordingly
    }

    // Calculate the total price
    $total_harga = $jumlah * $harga_satuan;

    // Update the data in the database
    $update_sql = "UPDATE penjualan SET id_pengguna='$id_pengguna', id_pelanggan='$id_pelanggan', id_produk='$id_produk', jumlah='$jumlah', harga_satuan='$harga_satuan', total_harga='$total_harga' WHERE id_penjualan='$penjualan_id'";

    if (mysqli_query($conn, $update_sql)) {
        // Redirect to the data penjualan page
        header("Location: data_penjualan.php");
    } else {
        echo "Error updating penjualan: " . mysqli_error($conn);
    }
}
?>

<br>
	<div class="judul">
		<h1 align="center" style="">Edit penjualan</h1>
	</div>

	<br>
    <div class="border border-start-9 shadow-lg p-3 mb-5 bg-body-tertiary rounded" style="width:350px; margin:auto;">
    	<form action="" method="POST" class="login-email">

            <div class="mb-3">
                <label for="kasir" class="form-label">Kasir</label>
                <select name="id_pengguna" id="pengguna" class="form-select">
                    <?php
                    while ($kasir_row = mysqli_fetch_assoc($kasir_result)) {
                        $selected = ($kasir_row['id_pengguna'] == $penjualan_row['id_pengguna']) ? 'selected' : '';
                        echo "<option value='" . $kasir_row['id_pengguna'] . "' $selected>" . $kasir_row['nama'] . "</option>";
                    }
                    ?>
                </select>
            </div>
        
            <div class="mb-3">
                <label for="pelanggan" class="form-label">Pelanggan</label>
                <select name="id_pelanggan" id="pelanggan" class="form-select">
                    <?php
                    while ($pelanggan_row = mysqli_fetch_assoc($pelanggan_result)) {
                        $selected = ($pelanggan_row['id_pelanggan'] == $penjualan_row['id_pelanggan']) ? 'selected' : '';
                        echo "<option value='" . $pelanggan_row['id_pelanggan'] . "' $selected>" . $pelanggan_row['nama'] . "</option>";
                    }
                    ?>
                </select>
            </div>
        
            <div class="mb-3">
                <label for="jumlah" class="form-label">Jumlah Beli</label>
                <input type="number" class="form-control" id="jumlah" name="jumlah" value="<?php echo $penjualan_row['jumlah']; ?>" required>
            </div>
        
            <div class="mb-3">
                <label for="produk" class="form-label">Produk</label>
                <select name="id_produk" id="produk" class="form-select" onchange="updateHargaSatuan()">
                    <?php
                    mysqli_data_seek($produk_result, 0); // Reset the pointer to the beginning
                    while ($produk_row = mysqli_fetch_assoc($produk_result)) {
                        $selected = ($produk_row['id_produk'] == $penjualan_row['id_produk']) ? 'selected' : '';
                        echo "<option value='" . $produk_row['id_produk'] . "' $selected>" . $produk_row['nama'] . "</option>";
                    }
                    ?>
                </select>
            </div>
        
            <div class="mb-3">
                <label for="harga_satuan" class="form-label">Harga Satuan</label>
                <input type="number" class="form-control" id="harga_satuan" name="harga_satuan" value="<?php echo $penjualan_row['harga_satuan']; ?>" readonly required>
            </div>
        
            <div class="mb-3">
                <label for="total" class="form-label">Total Harga</label>
                <input type="number" class="form-control" id="total" name="total" value="<?php echo $penjualan_row['total_harga']; ?>" readonly required>
            </div>
            <div class="d-grid gap-2">
				<button name="submit" class="btn btn-success">Simpan</button>	
			</div>
        </form>
		<a href="data_penjualan.php" class="tombol"><button class="btn btn-primary" style=" margin-top: 5px;">Lihat semua data</button></a>
	</div>

</div>
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
            document.getElementById('total').value = totalHarga;
        }
    </script>
</body>
</html>
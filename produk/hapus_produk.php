<?php  

include '../koneksi.php';
//menggambil data dari halaman sebelumnya
$id_produk = $_GET['id_produk'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Hapus produk</title>
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
    <link rel="shortcut icon" href="../img/logo_bapenda1.png">
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body style="background-image: url('../img/bg3.png'); background-size:30em;">
    <div class="border border-start-9 shadow-lg p-3 mb-5 bg-body-tertiary rounded" style="width:350px; margin:auto; margin-top:50px ;">
        <h1 align="center">Yakin dihapus?</h1>
        <form action="" method="post">
        <div class="d-grid gap-2 mb-3">
        <button name="yakin" class="btn btn-danger">Yakin</button>
        </div>
        <div class="d-grid gap-2 mb-3">
        <button name="batal" class="btn btn-success">Batal</button>			
        </div>
        </form>
    </div>
    
</body>
</html>
<?php
if (isset($_POST['yakin'])){

//query menghapus data
$query = "DELETE from produk where id_produk='$id_produk'";
mysqli_query($koneksi, $query);
//mengalihkan ke halaman akun.php
header("location:data_produk.php?pesan=hapus");

} else if(isset($_POST['batal'])){
    header("location:data_produk.php");
}
?>
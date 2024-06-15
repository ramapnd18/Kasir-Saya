<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "db_kasir";

$koneksi = new mysqli($servername, $username, $password, $database);

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>

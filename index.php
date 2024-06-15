<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <title>Kasir</title>
</head>
<body>

    <!-- Isi dalam div.container pada halaman kasir -->
<div class="container content-wrapper border-start-9 shadow-lg p-3 mt-5 bg-body-tertiary rounded text-center" style="width:300px;">
<img src="img/logok.png" alt="Logo" class="w-50 mx-auto mb-4" >
    <h1>Aplikasi Kasir</h1>
    <!-- Formulir login -->
    <form id="loginForm" method="post" action="login.php">
        <div class="mb-3">
            <label class="form-label">Nama Pengguna:</label>
            <input type="text" class="form-control" id="nama_pengguna" name="nama_pengguna" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Kata Sandi:</label>
            <input type="password" class="form-control" id="kata_sandi" name="kata_sandi" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>

</body>
</html>
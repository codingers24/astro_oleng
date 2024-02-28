<?php
session_start();

// Check for admin login
if (!isset($_SESSION['level']) || $_SESSION['level'] != "admin") {
    header("Location: index.php");
    exit;
}

// Connect to database
$conn = mysqli_connect("localhost", "root", "", "database_kasir");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['tambah_pelanggan'])) {
    // Get form data
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $telepon = mysqli_real_escape_string($conn, $_POST['telepon']); 
    // $level = mysqli_real_escape_string($conn, $_POST['level']);

    // Insert user into database
    $sql = "INSERT INTO pelanggan (nama, alamat, telepon) VALUES ('$nama', '$alamat', '$telepon')";
    if (mysqli_query($conn, $sql)) {
        header("Location: data_pelanggan.php?success=1");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pelanggan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    </nav>

<div class="container content-wrapper">
    <div class="row">
        <div class="col-md-12">
            <main class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <h1 class="display-4">Tambah Pelanggan</h1>

                <form action="" method="post">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" required>
                    </div>
                    <div class="mb-3">
                        <label for="telepon" class="form-label">Telepon</label>
                        <input type="text" class="form-control" id="telepon" name="telepon" required>
                    </div>
                    
                    <button type="submit" name="tambah_pelanggan" class="btn btn-primary">Tambah Pelanggan</button>
                </form>

            </main>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
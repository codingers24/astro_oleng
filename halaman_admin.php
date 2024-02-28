<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman Menu Admin</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css"> </head>
<body>

 <?php
session_start();

if (!isset($_SESSION['level']) || $_SESSION['level'] != "admin") {
    header("Location: index.php");
    exit;
}

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Admin Panel</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="pengguna/data_pengguna.php">Data Pengguna</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="pelanggan/data_pelanggan.php">Data Pelanggan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="produk/data_produk.php">Data Produk</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="penjualan/data_penjualan.php">Data Penjualan</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container content-wrapper">
  <div class="row">
    <div class="col-md-12">
      <h1 class="display-4">Selamat datang di Dashboard Admin!</h1>
      <p class="lead">Pusat kontrol untuk mengelola sistem Anda.</p>
      <a href="halaman_admin.php?logout=1" class="btn btn-danger">Logout</a>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
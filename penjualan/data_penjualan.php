<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Penjualan</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../style.css">
</head>
<body>

<?php
  session_start();

  // Check for admin login
  if (!isset($_SESSION['level']) || $_SESSION['level'] != "admin") {
    header("Location: index.php");
    exit;
  }

  // Connect to database
  $conn = mysqli_connect("localhost", "root", "", "database_kasir");

  // Get all sales data with joins
  $sql = "SELECT p.id_penjualan, p.tanggal, p.total_harga,
          u.nama AS nama_kasir, pl.nama AS nama_pelanggan,
          pr.nama AS nama_produk, p.jumlah, p.harga_satuan
          FROM penjualan p
          INNER JOIN pengguna u ON p.id_kasir = u.id_pengguna
          INNER JOIN pelanggan pl ON p.id_pelanggan = pl.id_pelanggan
          INNER JOIN produk pr ON p.id_produk = pr.id_produk";
  $result = mysqli_query($conn, $sql);
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
          <a class="nav-link " aria-current="page" href="../halaman_admin.php">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../pengguna/data_pengguna.php">Data Pengguna</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../pelanggan/data_pelanggan.php">Data Pelanggan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../produk/data_produk.php">Data Produk</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="../penjualan/data_penjualan.php">Data Penjualan</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container content-wrapper">
  <div class="row">
    <div class="col-md-12">
      <main class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <h1 class="display-4">Data Penjualan</h1>
        <a href="tambah_penjualan.php" class="btn btn-primary mb-3">Tambah Penjualan</a>
        <div class="table-responsive">
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                
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
      <a href="../halaman_admin.php?logout=1" class="btn btn-danger">Logout</a>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
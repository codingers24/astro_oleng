<?php
session_start();

// Check for admin login
if (!isset($_SESSION['level']) || $_SESSION['level'] != "admin") {
  header("Location: index.php");
  exit;
}

// Connect to database
$conn = mysqli_connect("localhost", "root", "", "database_kasir");

// Get user ID from query string
if (!isset($_GET['id_produk'])) {
  header("Location: data_produk.php");
  exit;
}
$id_produk = $_GET['id_produk'];

// Retrieve user data
$sql = "SELECT * FROM produk WHERE id_produk = '$id_produk'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if (!$row) {
  header("Location: data_produk.php");
  exit;
}

// Process form submission
if (isset($_POST['submit'])) {
  $nama = $_POST['nama'];
  $harga = $_POST['harga'];
  $stok = $_POST['stok'];
  

  // Update user in database
  $sql = "UPDATE produk SET nama='$nama', harga='$harga', stok='$stok' WHERE id_produk='$id_produk'";
  mysqli_query($conn, $sql);

  header("Location: data_produk.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Produk</title>
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
          <h1 class="display-4">Edit Produk</h1>

          <form action="edit_produk.php?id_produk=<?php echo $id_produk; ?>" method="post">
            <div class="mb-3">
              <label for="nama" class="form-label">Nama</label>
              <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $row['nama']; ?>" required>
            </div>
            <div class="mb-3">
              <label for="harga" class="form-label">Harga </label>
              <input type="text" class="form-control" id="harga" name="harga" value="<?php echo $row['harga']; ?>" required>
            </div>
            <div class="mb-3">
              <label for="stok" class="form-label">Stok</label>
              <input type="stok" class="form-control" id="stok" name="stok" value="<?php echo $row['stok']; ?>">
            </div>
            
            <button type="submit" class="btn btn-primary" name="submit">Simpan</button>
          </form>

        </main>
      </div>
    </div>
 </div>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

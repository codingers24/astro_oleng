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
if (!isset($_GET['id_pengguna'])) {
  header("Location: data_pengguna.php");
  exit;
}
$id_pengguna = $_GET['id_pengguna'];

// Retrieve user data
$sql = "SELECT * FROM pengguna WHERE id_pengguna = '$id_pengguna'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if (!$row) {
  header("Location: data_pengguna.php");
  exit;
}

// Process form submission
if (isset($_POST['submit'])) {
  $nama = $_POST['nama'];
  $nama_pengguna = $_POST['nama_pengguna'];
  $kata_sandi = $_POST['kata_sandi'];
  $level = $_POST['level'];

  // Update user in database
  $sql = "UPDATE pengguna SET nama='$nama', nama_pengguna='$nama_pengguna', kata_sandi='$kata_sandi', level='$level' WHERE id_pengguna='$id_pengguna'";
  mysqli_query($conn, $sql);

  header("Location: data_pengguna.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Pengguna</title>
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
          <h1 class="display-4">Edit Pengguna</h1>

          <form action="edit_pengguna.php?id_pengguna=<?php echo $id_pengguna; ?>" method="post">
            <div class="mb-3">
              <label for="nama" class="form-label">Nama</label>
              <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $row['nama']; ?>" required>
            </div>
            <div class="mb-3">
              <label for="nama_pengguna" class="form-label">Nama Pengguna</label>
              <input type="text" class="form-control" id="nama_pengguna" name="nama_pengguna" value="<?php echo $row['nama_pengguna']; ?>" required>
            </div>
            <div class="mb-3">
              <label for="kata_sandi" class="form-label">Kata Sandi</label>
              <input type="kata_sandi" class="form-control" id="kata_sandi" name="kata_sandi" value="<?php echo $row['kata_sandi']; ?>">
            </div>
            <div class="mb-3">
              <label for="level" class="form-label">Level</label>
              <select class="form-select" id="level" name="level">
                <option value="admin" <?php if ($row['level'] == 'admin') echo 'selected'; ?>>Admin</option>
                <option value="kasir" <?php if ($row['level'] == 'kasir') echo 'selected'; ?>>Kasir</option>
              </select>
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

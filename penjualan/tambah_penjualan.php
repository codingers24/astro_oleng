<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Penjualan</title>
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

// **Process form submission**
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get data from the form
    $id_kasir = $_POST['id_kasir'];
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

    $sql_stock_update  = "UPDATE produk SET stok = stok - '$jumlah' WHERE id_produk = '$id_produk'";

    if (mysqli_query($conn, $sql_stock_update)) 
    {
        $sql_insert = "INSERT INTO penjualan (tanggal, id_kasir, id_pelanggan, id_produk, jumlah, harga_satuan, total_harga) VALUES (NOW(), '$id_kasir', '$id_pelanggan', '$id_produk', '$jumlah', '$harga_satuan', '$total_harga')";
        
        if (mysqli_query($conn, $sql_insert)) {
             header("Location: data_penjualan.php");
        } else {
        echo "Error: " . mysqli_error($conn);
        }
    } 
    else 
    {
    echo "Error updating product stock: " . mysqli_error($conn);
  }
}

// Get lists of kasir, pelanggan, and produk
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
                <h1 class="display-4">Tambah Penjualan</h1>
                <form action="" method="post">

                    <div class="mb-3">
                        <label for="kasir" class="form-label">Kasir</label>
                        <select name="id_kasir" id="kasir" class="form-select">
                            <?php
                            while ($kasir_row = mysqli_fetch_assoc($kasir_result)) {
                                echo "<option value='" . $kasir_row['id_pengguna'] . "'>" . $kasir_row['nama'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="pelanggan" class="form-label">Pelanggan</label>
                        <select name="id_pelanggan" id="pelanggan" class="form-select">
                            <?php
                            while ($pelanggan_row = mysqli_fetch_assoc($pelanggan_result)) {
                                echo "<option value='" . $pelanggan_row['id_pelanggan'] . "'>" . $pelanggan_row['nama'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah Beli</label>
                        <input type="number" class="form-control" id="jumlah" name="jumlah" required>
                    </div>

                      <div class="mb-3">
                      <label for="produk" class="form-label">Produk</label>
                        <select name="id_produk" id="produk" class="form-select" onchange="updateHargaSatuan()">
                            <?php
                            mysqli_data_seek($produk_result, 0); // Reset the pointer to the beginning
                            while ($produk_row = mysqli_fetch_assoc($produk_result)) {
                                echo "<option value='" . $produk_row['id_produk'] . "'>" . $produk_row['nama'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    
                    <div class="mb-3">
                        <label for="harga_satuan" class="form-label">Harga Satuan</label>
                        <input type="number" class="form-control" id="harga_satuan" name="harga_satuan" value="" readonly required>
                    </div>

                    <div class="mb-3">
                        <label for="total" class="form-label">Total Harga</label>
                        <input type="number" class="form-control" id="total" name="total" value="" readonly required>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </main>
        </div>
    </div>
</div>

<script>
    var hargaSatuanData = <?php echo json_encode($hargaSatuanData); ?>;

    function updateHargaSatuan() {
        // Get the selected product id
        var selectedProductId = document.getElementById("produk").value;

        // Update the harga_satuan field based on the selected product
        document.getElementById("harga_satuan").value = hargaSatuanData[selectedProductId] || '';

        // Calculate and update the total harga
        updateTotalHarga();
    }

    function updateTotalHarga() {
        // Get the values of jumlah and harga_satuan
        var jumlah = document.getElementById("jumlah").value;
        var hargaSatuan = document.getElementById("harga_satuan").value;

        // Calculate the total harga
        var totalHarga = jumlah * hargaSatuan;

        // Update the total harga field
        document.getElementById("total").value = totalHarga;
    }
</script>

</body>
</html>

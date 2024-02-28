<?php
session_start();

// Check for admin login
if (!isset($_SESSION['level']) || $_SESSION['level'] != "admin") {
    header("Location: index.php");
    exit;
}

// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "database_kasir");

// Get user ID from URL parameter
$id_penjualan = $_GET['id_penjualan'];

// Escape the user ID to prevent SQL injection
$id_penjualan = mysqli_real_escape_string($conn, $id_penjualan);

// Prepare and execute SQL query to delete the user
$sql = "DELETE FROM penjualan WHERE id_penjualan = $id_penjualan";
$result = mysqli_query($conn, $sql);

// Check if deletion was successful
if ($result) {
    // Redirect to data_pengguna.php with success message
    header("Location: data_penjualan.php?hapus=sukses");
} else {
    // Display an error message
    echo "Gagal menghapus pengguna.";
}

// Close database connection
mysqli_close($conn);
?>

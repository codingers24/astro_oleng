<?php
// Start session to access session variables
session_start();

// Check for admin login
if (!isset($_SESSION['level']) || $_SESSION['level'] != "admin") {
    header("Location: index.php"); // Redirect to index if not admin
    exit;
}

// Connect to database
$conn = mysqli_connect("localhost", "root", "", "database_kasir"); // Replace with your actual database credentials

// Get user ID from URL parameter
$id_pengguna = $_GET['id_pengguna'];

// Escape the user ID to prevent SQL injection
$id_pengguna = mysqli_real_escape_string($conn, $id_pengguna);

// Prepare and execute SQL query to delete the user
$sql = "DELETE FROM pengguna WHERE id_pengguna = $id_pengguna";
$result = mysqli_query($conn, $sql);

// Check if deletion was successful
if ($result) {
    // Redirect to data_pengguna.php with success message
    header("Location: data_pengguna.php?hapus=sukses");
} else {
    // Display an error message
    echo "Gagal menghapus pengguna.";
}

// Close database connection
mysqli_close($conn);
?>
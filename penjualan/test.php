// Koneksi ke database
$conn = new mysqli("localhost", "username", "password", "nama_database");

// Mengambil data produk
$query_produk = "SELECT * FROM produk";
$result_produk = $conn->query($query_produk);

// Menampilkan data produk
while($row_produk = $result_produk->fetch_assoc()) {
   echo "ID: " . $row_produk['id_produk'] . ", Nama: " . $row_produk['nama_produk'] . ", Harga: $" . $row_produk['harga'] . "<br>";
}

// Menutup koneksi
$conn->close();

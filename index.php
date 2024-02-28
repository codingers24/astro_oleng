<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Selamat Datang!</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <!-- <link rel="stylesheet" href="style.css"> -->
</head>
<body>

  <div class="container-fluid vh-100 d-flex align-items-center justify-content-center">
    <div class="card border-0 rounded-3 shadow-sm bg-gradient-primary">
      <div class="card-header border-bottom-0 text-center">
        <img src="logo.png" alt="Logo" class="w-50 mx-auto mb-4">
        <h2 class="card-title display-4">Selamat Datang</h2>
      </div>
      <div class="card-body p-4 text-center"> <form action="cek_login.php" method="post">
          <div class="mb-3">
            <label for="nama_pengguna" class="form-label">Nama Pengguna</label>
            <input type="text" class="form-control form-control-lg" id="nama_pengguna" name="nama_pengguna" placeholder="Masukkan nama pengguna Anda" required>
          </div>
          <div class="mb-3">
            <label for="kata_sandi" class="form-label">Password</label>
            <input type="kata_sandi" class="form-control form-control-lg" id="kata_sandi" name="kata_sandi" placeholder="Masukkan kata sandi Anda" required>
          </div>
          <button type="submit" class="btn btn-info btn-lg">Masuk</button>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
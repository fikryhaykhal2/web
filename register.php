<?php
session_start();
if (isset($_SESSION['login'])) {
  header("location:index.php");
  exit;
}
include "koneksi.php";
if (isset($_POST['daftar'])) {
  $username = $_POST['username'];
  $password = mysqli_real_escape_string($koneksi, password_hash($_POST['password'], PASSWORD_BCRYPT));

  $query = mysqli_query($koneksi, "SELECT username FROM tb_user WHERE username='$username'");
  if (mysqli_num_rows($query) > 0) {
    header("location:register.php?pesan=username dah ada!");
    return false;
  }
  mysqli_query($koneksi, "INSERT INTO tb_user VALUE('$username','$password')");
  echo "<script>alert('Registrasi Sukses');document.location.href='login.php';</script>";
}
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <title>Hello, world!</title>
</head>

<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <?php if (isset($_GET['pesan'])) { ?>
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Login gagal!</strong><?php echo $_GET['pesan']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php } ?>
        <div class="card mt-5">
          <div class="card-header text-center">
            Register
          </div>
          <div class="card-body">
            <form action="" method="post">
              <label for="basic-url" class="form-label">Username</label>
              <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon3"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664z" />
                  </svg></span>
                <input type="text" class="form-control" name="username" placeholder="masukkan username" id="basic-url" aria-describedby="basic-addon3">
              </div>
              <label for="basic-url" class="form-label">Password</label>
              <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon3"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-unlock" viewBox="0 0 16 16">
                    <path d="M11 1a2 2 0 0 0-2 2v4a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h5V3a3 3 0 0 1 6 0v4a.5.5 0 0 1-1 0V3a2 2 0 0 0-2-2M3 8a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V9a1 1 0 0 0-1-1z" />
                  </svg></span>
                <input type="password" class="form-control" name="password" placeholder="masukkan username" id="basic-url" aria-describedby="basic-addon3">
              </div>
              <div class="mb-3 row mt-3">
                <button type="submit" name="daftar" class="btn btn-primary">Daftar</button>
              </div>
              <div class="text-center">
                Punya akun? Masuk <a href="login.php">Disini</a>

              </div>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>
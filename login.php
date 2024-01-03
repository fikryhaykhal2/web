<?php
session_start();
if (isset($_SESSION['login'])) {
  header("location:index.php");
  exit;
}
if (isset($_SESSION))
  include "koneksi.php";
if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  //username
  $query = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE username='$username'");
  $data = mysqli_fetch_array($query);
  if ($data) {
    //password
    if (password_verify($password, $data['password'])) {
      //set sesstion
      $_SESSION['login'] = true;
      echo "<script>alert('Login Berhasil');document.location.href='index.php';</script>";
    } else {
      header("location:login.php?pesan=Password Salah");
      return false;
    }
  } else {
    header("location:login.php?pesan=Username Tidak Ditemukan");
    return false;
  }
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
            <strong>Login Gagal!</strong><?php echo $_GET['pesan'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php } ?>
        <div class="card mt-4">
          <div class="card-header text-center">
            Login
          </div>
          <div class="card-body">
            <form action="" method="post">
              <label for="basic-url" class="form-label">Username</label>
              <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon3"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                    <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                  </svg></span>
                <input type="text" class="form-control" name="username" placeholder="masukkan username" id="basic-url" aria-describedby="basic-addon3">
              </div>
              <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon3"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-unlock-fill" viewBox="0 0 16 16">
                    <path d="M11 1a2 2 0 0 0-2 2v4a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h5V3a3 3 0 0 1 6 0v4a.5.5 0 0 1-1 0V3a2 2 0 0 0-2-2" />
                  </svg></span>
                <input type="password" class="form-control" name="password" placeholder="masukkan password" id="basic-url" aria-describedby="basic-addon3">
              </div>
              <div class="row mb-3">
                <button type="submit" name="login" class="btn btn-primary">login</button>
              </div>
              <div class="text-center">
                Belum punya akun ? daftar <a href="register.php">disini</a>
              </div>
            </form>
          </div>
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
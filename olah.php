<!doctype html>
<?php
include "koneksi.php";
$id = '';
$judul = '';
$pengarang = '';
$penerbit = '';
$kategori = '';
$gambar = '';

if (isset($_GET['edit'])) {
  $id = $_GET['edit'];
  $query = mysqli_query($koneksi, "SELECT * FROM tb_buku WHERE id='$id'");
  $data = mysqli_fetch_array($query);
  $judul = $data['judul'];
  $pengarang = $data['pengarang'];
  $penerbit = $data['penerbit'];
  $kategori = $data['kategori'];
  $gambar = $data['gambar'];
}
?>

<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <title>Belajar CRUD</title>
</head>

<body>
  <div class="container">
    <nav class="navbar navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand">Daftar Buku</a>
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </nav>
    <figure class="text-center mt-3">
      <blockquote class="blockquote">
        <p>Kelolah Data Buku</p>
      </blockquote>
      <figcaption class="blockquote-footer">
        CRUD <cite title="Source Title">Create, Read, Update, Delete</cite>
      </figcaption>
    </figure>
    <form action="proses.php" method="post" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?php echo $id; ?>">
      <div class="mb-3 row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Judul</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="judul" placeholder="Masukkan Judul" value="<?php echo $judul; ?>">
        </div>
      </div>
      <div class="mb-3 row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Pengarang</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="pengarang" placeholder="Masukkan pengarang" value="<?php echo $pengarang; ?>">
        </div>
      </div>
      <div class="mb-3 row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Penerbit</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="penerbit" placeholder="Masukkan Penerbit" value="<?php echo $penerbit; ?>">
        </div>
      </div>
      <div class="mb-3 row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Kategori</label>
        <div class="col-sm-10">
          <select id="" class="form-control" name="kategori">
            <option value="Umum" <?php if ($kategori == 'Umum') echo 'selected'; ?>>Umum</option>
            <option value="Komputer" <?php if ($kategori == 'Komputer')  echo 'selected'; ?>>Komputer</option>
          </select>
        </div>
      </div>
      <div class="mb-3 row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Gambar</label>
        <div class="col-sm-10">
          <?php
          if (isset($_GET['edit'])) {
            echo '
            <img src="image/' . $gambar . '" width="100">
            <input type="file" class="form-control mt-3" name="gambar">
            
            ';
          } else {
            echo '
            <input type="file" class="form-control mt-3" name="gambar">
            
            ';
          }
          ?>
        </div>
      </div>
      <div class="mb-3 row">
        <?php
        if (isset($_GET['edit'])) {
          echo '
          <button type="submit" name="btnProses" value="update" class="btn btn-primary">Simpan Perubahan</button>
          ';
        } else {
          echo '
          <button type="submit" name="btnProses" value="upload" class="btn btn-primary">Tambah Data</button>
          ';
        }

        ?>
      </div>
  </div>
  </form>
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
<!DOCTYPE html>
<html lang="en">

<?php
session_start();
if (!isset($_SESSION['login'])) {
  header("location:login.php");
  exit;
}

include 'koneksi.php';
// Set halaman default
$halamanAktif = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$jdh = 5;
$batasAwal = ($halamanAktif - 1) * $jdh;

if (isset($_POST['btnCari'])) {
  $cari = $_POST['cari'];
  $_SESSION['cari'] = $cari;
} elseif (!isset($_SESSION['cari'])) {
  $cari = '';
} else {
  $cari = $_SESSION['cari'];
}

$query = mysqli_query($koneksi, "SELECT * FROM tb_buku WHERE judul LIKE '%$cari%' OR pengarang LIKE '%$cari%' OR penerbit LIKE '%$cari%' OR kategori LIKE '%$cari%' LIMIT $batasAwal, $jdh");
$jumlahData = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM tb_buku WHERE judul LIKE '%$cari%' OR pengarang LIKE '%$cari%' OR penerbit LIKE '%$cari%' OR kategori LIKE '%$cari%'"));
$jumlahHalaman = ceil($jumlahData / $jdh);
?>

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <title>Hello, world!</title>
</head>

<body>
  <div class="container">

    <nav class="navbar navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand">Navbar</a>
        <form class="d-flex" method="POST">
          <input class="form-control me-2" type="search" placeholder="Search" name="cari" aria-label="Search">
          <button class="btn btn-outline-success" type="submit" name="btnCari">Search</button>
          <a href="logout.php" style="margin-left: 3px;"><button type="button" class="btn btn-outline-danger">Logout</button></a>
        </form>
      </div>
    </nav>
    <figure class="text-center mt-3">
      <blockquote class="blockquote">
        <p>A well-known quote, contained in a blockquote element.</p>
      </blockquote>
      <figcaption class="blockquote-footer">
        Someone famous in <cite title="Source Title">Source Title</cite>
      </figcaption>
    </figure>
    <a href="olah.php"><button type="button" class="btn btn-primary">Olah</button></a>
    <table class="table mt-3 table-bordered" style="text-align: center;">
      <thead class="table table-bordered">
        <tr>
          <th scope="col">No</th>
          <th scope="col">Judul</th>
          <th scope="col">Pengarang</th>
          <th scope="col">Penerbit</th>
          <th scope="col">Kategori</th>
          <th scope="col">Gambar</th>
          <th scope="col">Aksi</th>
        </tr>
      </thead>
      <?php
      $no = $batasAwal + 1;

      while ($data = mysqli_fetch_array($query)) {
      ?>
        <tbody>
          <tr>
            <th scope="row"><?php echo $no; ?></th>
            <td><?php echo $data['judul']; ?></td>
            <td><?php echo $data['pengarang']; ?></td>
            <td><?php echo $data['penerbit']; ?></td>
            <td><?php echo $data['kategori']; ?></td>
            <td><img src="image/<?php echo $data['gambar']; ?>" alt="" width="100px"></td>
            <td>
              <a href="edit.php?edit=<?php echo $data['id']; ?>">Edit</a>
              <a href="proses.php?hapus=<?php echo $data['id']; ?>">Hapus</a>
            </td>
          </tr>
        </tbody>
      <?php
        $no++;
      } ?>
    </table>
    <nav>
      <ul class="pagination justify-content-center">
        <li class="page-item <?php echo ($halamanAktif == 1) ? 'disabled' : ''; ?>">
          <a href="?halaman=<?php echo $halamanAktif - 1; ?>" class="page-link">Sebelumnya</a>
        </li>
        <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
          <li class="page-item <?php echo ($i == $halamanAktif) ? 'active' : ''; ?>">
            <a href="?halaman=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a>
          </li>
        <?php endfor; ?>
        <li class="page-item <?php echo ($halamanAktif == $jumlahHalaman) ? 'disabled' : ''; ?>">
          <a href="?halaman=<?php echo $halamanAktif + 1; ?>" class="page-link">Selanjutnya</a>
        </li>
      </ul>
    </nav>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>
<?php
include "koneksi.php";
if (isset($_POST['btnProses'])) {
  $judul = $_POST['judul'];
  $pengarang = $_POST['pengarang'];
  $penerbit = $_POST['penerbit'];
  $kategori = $_POST['kategori'];

  if ($_POST['btnProses'] == 'upload') {
    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES["gambar"]["tmp_name"];
    move_uploaded_file($tmp, "image/" . $gambar);

    mysqli_query($koneksi, "INSERT INTO tb_buku VALUES('','$judul','$pengarang','$penerbit','$kategori', '$gambar')");
    echo "<script>alert('Data Berhasil Di Tambahkan!');document.location.href='index.php';</script>";
  } else {
    if ($_FILES['gambar']['name'] != '') {
      $query = mysqli_query($koneksi, "SELECT * FROM tb_buku WHERE id='$_POST[id]'");
      $data = mysqli_fetch_array($query);
      unlink("image/" . $data['gambar']);

      $gambar = $_FILES['gambar']['name'];
      $tmp = $_FILES["gambar"]["tmp_name"];
      move_uploaded_file($tmp, "image/" . $gambar);

      mysqli_query($koneksi, "UPDATE tb_buku SET judul='$judul',pengarang='$pengarang',penerbit='$penerbit',kategori='$kategori',gambar='$gambar' WHERE id='$_POST[id]'");
      echo "<script>alert('Data Berhasil Di Ubah!');document.location.href='index.php';</script>";
    } else {
      mysqli_query($koneksi, "UPDATE tb_buku SET judul='$judul',pengarang='$pengarang',penerbit='$penerbit',kategori='$kategori' WHERE id='$_POST[id]'");
      echo "<script>alert('Data Berhasil Di Ubah!');document.location.href='index.php';</script>";
    }
  }
} else if ($_GET['hapus']) {
  $query = mysqli_query($koneksi, "SELECT * FROM tb_buku WHERE id='$_GET[hapus]'");
  $data = mysqli_fetch_array($query);
  unlink("image/" . $data['gambar']);

  mysqli_query($koneksi, "DELETE FROM tb_buku WHERE id='$_GET[hapus]'");
  echo "<script>alert('Data Berhasil Di Hapus!');document.location.href='index.php';</script>";
}

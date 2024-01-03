<?php
$koneksi = mysqli_connect("localhost", "root", "", "buku");
if ($koneksi) {
  echo "Koneksi Berhasil";
}

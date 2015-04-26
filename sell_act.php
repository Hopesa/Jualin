<?php
require('/includes/config.php');
$nama = $_POST['nama'];
$kategori = $_POST['kategori'];
$harga = $_POST['harga'];
$stock = $_POST['stock'];
$lokasi = $_POST['lokasi'];
$deskripsi = $_POST['deskripsi'];
$id_user = $_POST['iduser'];
$gambar = $_POST['gambar'];
$sql = "INSERT INTO `barang`(`id_user`, `nama_barang`, `kategori`, `harga`, `stock`, `lokasi`,`deskripsi`, `gambar`) VALUES ('" . $id_user . "','" . $nama . "','" . $kategori . "','" . $harga . "','" . $stock . "', '" . $lokasi . "','" . $deskripsi. "','" . $gambar. "');";
$query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
echo '<html><script>
           window.alert("' . $_SESSION["username"] . ', Item anda Berhasil Dijual")
           window.location.href="sell.php";
       </SCRIPT></html>';
?>
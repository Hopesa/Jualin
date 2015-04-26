<?php
require('element.php');
$id_barang=$_GET['id_barang'];
$jml_pesan = $_POST['jumlah'];
$user = $_SESSION['username'];
$sql = "SELECT id_user FROM users WHERE username = '$user'";
$query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
$data = mysql_fetch_assoc($query);
$id_user = $data["id_user"];
if(empty($id_user)){
    $id_user=2;
    $user="Guest";
}
$sql= mysql_query("SELECT * FROM `barang` WHERE `id_barang`=$id_barang");
$data=mysql_fetch_array($sql);
$jml_transaksi = $data['harga']*$jml_pesan;
$status="Pending";
$stok=$data['stock'];
$stok = $stok - $jml_pesan;
if ($stok>=0 && $jml_pesan>0){

$simpan=mysql_query("insert into cart_pending(`id_user`, `id_barang`,`jml_transaksi`, `jml_pesan`, `lokasi`, `status`) values('$id_user','$id_barang','$jml_transaksi','$jml_pesan','$data[lokasi]','$status')") or trigger_error("Query Failed: " . mysql_error());

$edit=mysql_query("UPDATE `tgsphp`.`barang` SET `stock` = '$stok' WHERE `barang`.`id_barang` = $id_barang;") or trigger_error("Query Failed: " . mysql_error());
    echo '<html><script>
           window.alert("' . $user . ' Barang Masuk Ke Cart")
           window.location.href="cart.php";
       </SCRIPT></html>';
}
else{
    echo '<html><script>
           window.alert("' . $user . ', Barang Gagal Masuk Ke Cart (Stok Tidak Mencukupi Atau Jumlah Pesan Salah)")
            window.history.back();
       </SCRIPT></html>';
}
?>
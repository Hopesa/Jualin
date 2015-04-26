<?php
require('element.php');
$user = $_SESSION['username'];
$sql = "SELECT id_user FROM users WHERE username = '$user'";
$query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
$data = mysql_fetch_assoc($query);
$id_user = $data["id_user"];
if(empty($id_user)){
    $id_user=2;
    $user="Guest";
}
if (isset($_GET['action'])) {
	switch ($_GET['action']) {
		case 'delete':
            $_GET['id'];
            $id_barang = $_GET['id'];
            $data= mysql_query("select * from cart_pending where             id_barang='$id_barang'")or trigger_error("Query                   Failed: ".mysql_error());
            $data=mysql_fetch_array($data);
            $jumlah = $data['jml_pesan'];
            $sql= mysql_query("SELECT * FROM `barang` WHERE                   `id_barang`=$id_barang") or trigger_error("Query                   Failed: ".mysql_error());
            $data=mysql_fetch_array($sql);
            $stok = $data ['stock'];
            $stok = $stok + $jumlah;
            $edit=mysql_query("UPDATE `tgsphp`.`barang` SET                   `stock` = '$stok' WHERE `barang`.`id_barang` =                 $id_barang;") or trigger_error("Query Failed: " .                 mysql_error());
            $sql = "DELETE FROM `cart_pending` WHERE                             id_barang=$id_barang";
            $query = mysql_query($sql) or trigger_error("Query                   Failed: ".mysql_error());
		break;
		case 'update':
		   $_GET['id'];
            $id_barang = $_GET['id'];
            $sql = "UPDATE FROM `cart_pending` WHERE                             id_barang=$id_barang";
            $query = mysql_query($sql) or trigger_error("Query                   Failed: ".mysql_error());
            echo'<html><script>window.location.href="cart.php";
            </SCRIPT></html>';	
        
		break;
        case 'deleteall':
        
        break;
        case 'checkout':
        echo'<html><script>window.location.href="checkout.php";
            </SCRIPT></html>';
        break;
	}
}


?>

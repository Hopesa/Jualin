<?php
//Admin Action stated here
require('element.php');
$user = $_SESSION['username'];
$sql = "SELECT * FROM users WHERE username = '$user'";
$query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
$dataid = mysql_fetch_assoc($query);
$level = $dataid["rank"];
if($level<100){echo "403 Not Authorized Transaction Fail"; exit;}
//Action
if (isset($_GET['action'])) {
	switch (strtolower($_GET['action'])) {
		case 'update-trans-ver':
            $idb = $_GET['id'];
            $sql = mysql_query("UPDATE `cart_final` SET `status`='Seller Pending' WHERE id_final = '$idb'") or trigger_error("Query Failed: " . mysql_error());
        break;
        case 'update-trans-selver':
            $idb = $_GET['id'];
            $sql = mysql_query("UPDATE `cart_final` SET `status`='Pending Delivery' WHERE id_final = '$idb'") or trigger_error("Query Failed: " . mysql_error());
        break;
    }
}
    ?>
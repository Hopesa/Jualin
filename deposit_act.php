<?php
require_once 'deposit.php';
$jml = $_POST['jml'];
$sql = "INSERT INTO deposit (`id_user`, `jml`) VALUES ('" . $id_user . "', '" . $jml . "');";
$query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
?>
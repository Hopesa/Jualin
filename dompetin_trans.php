<?php
require('element.php');
if (loggedIn()) {

$user = $_SESSION['username'];
$sql = "SELECT id_user FROM users WHERE username = '$user'";
$query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
$dataid = mysql_fetch_assoc($query);
$id_user = $dataid["id_user"];//ID User grabbed
$sql ="SELECT * from dompetin_pending WHERE id_user = $id_user and status ='pending'";//Newest Data Marked By Pending
$query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
$data = mysql_fetch_array($query);
$total = $data['total']+$data['id_check'];
$output="";
$output.='<h1>Konfirmasi Pembayaran</h1><br><h4>Mohon Transfer sebesar IDR '.$total.' Ke $rek An $atasnama</h4>';
echo $output;
$sql = "UPDATE dompetin_pending SET status='Pending Verifikasi' where id_user = $id_user;";
$query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
}
else{
    echo 'Access Denied 403';
}
?>
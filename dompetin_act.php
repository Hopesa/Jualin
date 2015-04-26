<?php
//Dompetin Act
require('element.php');
$jmldp=$_POST['jmldp'];
$method=$_POST['method'];
$user = $_SESSION['username'];
$kode = rand(10, 999);
$sql = "SELECT id_user FROM users WHERE username = '$user'";
$query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
$dataid = mysql_fetch_assoc($query);
$id_user = $dataid["id_user"];//ID User grabbed
$sql ="SELECT * from alamat WHERE id_user = $id_user";
//Inserting into Dompetin
$sql="INSERT INTO `dompetin_pending`(`id_user`, `id_check`, `total`, `method`,`status`) VALUES ('$id_user','$kode','$jmldp','$method','Pending')";
$query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
echo '<html><script>
           window.alert("' . $_SESSION["username"] . ' Permintaan Anda Kami Terima, Mohon Lanjutkan Proses Berikut")
           window.location.href="dompetin_trans.php";
       </SCRIPT></html>';
?>
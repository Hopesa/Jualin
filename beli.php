<?php
$kdbarang=$_POST['txtkd'];
$tglbeli=date('Y-m-d');
$wktbeli=date('H:i:s');
$simpan=mysql_query("insert into barang values('','$kdbarang','1','$tglbeli','$wktbeli','$nama[uname]')");
if($simpan)
{
echo "<meta http-equiv='refresh' content='0; url=?page=katalog'>";
}

?>
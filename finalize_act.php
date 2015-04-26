<?php
//Finalize_ACT

//Taking Data From Current Checkout State\
require('element.php');
$user = $_SESSION['username'];
$top = $_POST['top'];
$mid = $_POST['mid'];
$bot = $_POST['bot'];
$payment = $_POST['payment'];
$kode = $_POST['kode'];
$note = $_POST['note'];
$note .= $note;
$sub = $_POST['sub-total'];
$total = $_POST['total'];
$shipping = 0;//change this in beta
//Taking ID User
$sql = "SELECT id_user FROM users WHERE username = '$user'";
$query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
$dataid = mysql_fetch_assoc($query);
$id_user = $dataid["id_user"];//ID User grabbed
$sql ="SELECT * from alamat WHERE id_user = $id_user";
$query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
$data_alamat = mysql_fetch_assoc($query);//Location Grabbed
//Inserting data
$sql ="INSERT INTO `cart_final`(`id_user`, `top`, `mid`, `bot`, `telp`, `postal`, `negara`, `alamat`, `kota`, `prov`, `descrip`, `shipcost`, `method`, `pay_code`, `sub_total`, `total`, `status`) VALUES ('$id_user','$top','$mid','$bot','$data_alamat[no_telp]','.$data_alamat[postal]','$data_alamat[negara]','$data_alamat[jalan]','$data_alamat[kota]','$data_alamat[provinsi]','$note','$shipping','$payment','$kode','$sub','$total','Pending Verifikasi')";
$query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
//Taking ID Final for ID Transaction
// insert a datarow, primary key is auto_increment
   // value is a unique key
$idtrans = mysql_insert_id();
echo $idtrans;
$sql= "select * from cart_pending where id_user='$id_user'";
$querya = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
if($querya === FALSE) { 
    die(mysql_error()); //error handling
}
while($data=mysql_fetch_array($querya)){
$sql="INSERT INTO `transaksi-brg`(`id_user`, `id_transaksi`, `id_barang`, `jml_transaksi`, `jml_pesan`, `lokasi`, `status`) VALUES ('$id_user','$idtrans','$data[id_barang]','$data[jml_transaksi]','$data[jml_pesan]','$data[lokasi]','Pending')";
$query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
//Taking Individual Seller IDs
$idb = $data['id_barang'];
$sql= mysql_query("SELECT * FROM `barang` WHERE `id_barang`=$idb")or trigger_error("Query Failed: " . mysql_error());;
$databr=mysql_fetch_array($sql);
$nmbrng = $databr['nama_barang'];
//This For Pulling Seller Username (Barang >> Users)
$sql= mysql_query("SELECT username FROM `users` WHERE `id_user`=$databr[id_user]");
$userdata = mysql_fetch_array($sql);;
$username = $userdata['username'];

//Sending "Notification" to Seller via Message
$user='';
$user = 'SYSTEM';
$sql = "SELECT id_user FROM users WHERE username = '$user'";
$query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
$dataid = mysql_fetch_assoc($query);
$iduser = 0;
$form = true;
$otitle = '';
$orecip = '';
$omessage = '';
//We check if the value is right

	$otitle = 'Notifikasi Pemberitahuan : Barang Anda Telah Dipesan';
	$orecip = $username;//test only (Real ones send message to different seller
	$omessage .= 'Barang anda,'.$nmbrng.' telah terjual ke user '.$_SESSION['username'].', Mohon Di tindak lanjuti setelah status menjadi Verified';
	//We remove slashes depending on the configuration
	if(get_magic_quotes_gpc())
	{
		$otitle = stripslashes($otitle);
		$orecip = stripslashes($orecip);
		$omessage = stripslashes($omessage);
	}
	//We check if all the fields are filled
		//We protect the variables
		$title = $otitle;
		$recip = $orecip;
		$message = $omessage;
		//We check if the recipient exists
		$dn1 = mysql_fetch_array(mysql_query('select count(id_user) as recip, id_user as recipid, (select count(*) from message) as npm from users where username="'.$recip.'"'));
			//We check if the recipient is not the actual user
			if($dn1['recipid']!=$iduser)
			{
				$id = $dn1['npm']+1;
				//We send the message
				if(mysql_query('insert into message (id, id2, title, user1, user2, message, timestamp, user1read, user2read)values("'.$id.'", "1", "'.$title.'", "'.$iduser.'", "'.$dn1['recipid'].'", "'.$message.'", "'.time().'", "yes", "no")') or trigger_error("Query Failed: " . mysql_error())) 
				{
					$form = false;
				}
				else
				{
					//Otherwise, we say that an error occured
					$error = 'An error occurred while sending the message';
				}
			}
			else
			{
				//Otherwise, we say the user cannot send a message to himself
				$error = 'You cannot send a message to yourself.';
			}
		
		
if($form)
{
//We display a message if necessary
if(isset($error))
{
	echo '<div class="message">'.$error.'</div>';
}
}
}
$sql="delete from cart_pending where id_user = $id_user";
$query = mysql_query($sql);
if($payment='bank'){
$output="";
$output.='<center><h1>Konfirmasi Pembayaran</h1><br><h4>Mohon Transfer sebesar IDR '.$total.' Ke $rek An $atasnama</h4><center>';
echo $output;}
?>
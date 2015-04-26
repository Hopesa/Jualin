<?php
require('/includes/config.php');

$sOutput .= '<div id="register-body">';
$user = $_SESSION['username'];
    $sql = "SELECT id_user FROM users WHERE username = '$user'";
    $query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
    $data = mysql_fetch_assoc($query);
    $id_user = $data["id_user"];
    $sql = "SELECT * FROM alamat WHERE id_user = '$id_user'";
    $result = mysql_query($sql);

// If the user is logged in display them a message.	
	$sOutput .= '<h2>Edit Profile</h2>
		' . $sError . '
		<form name="register" method="post" action="' . $_SERVER['PHP_SELF'] . '?action=register">
            No Telp: <input type="number" name="telp" value="" /><br /><br />
            Alamat: <input type="text" name="jalan" value="" /><br /><br />
            Kota: <input type="text" name="kota" value="" /><br /><br />
            Provinsi: <input type="text" name="provinsi" value="" /><br /><br />
            Negara: <input type="text" name="negara" value="" /><br /><br />
			<input type="submit" name="submit" value="Register!" />
		</form>
		<br />
		<h4>Would you like to <a href="login.php">login</a>?</h4>';
}


$sOutput .= '</div>';
$sql = "UPDATE `alamat` SET `jalan`=[value-2],`kota`=[value-3],`provinsi`=[value-4],`negara`=[value-5],`no_telp`=[value-6] WHERE `id_user` = '".$id_user."';
// display our output.
echo $sOutput;
?>
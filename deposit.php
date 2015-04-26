<?php
require('/includes/config.php');
echo"what";
$sOutput .= '<div id="index-body">';
if (loggedIn()) {
    $user = $_SESSION['username'];
    $sql = "SELECT id_user FROM users WHERE username = '$user'";
    $query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
    $data = mysql_fetch_assoc($query);
    $id_user = $data["id_user"];
    
	$sOutput .= '<h2>Welcome!</h2>
    
		Hello, ' . $_SESSION['username'] . ' how are you today?, your ID is ' . $data["id_user"] .'<br />
		<h4>Do you want to Deposit?</h4>
       <form name="deposit" method="post" action="deposit_act.php">
			Jumlah Deposit: <input type="text" name="jml" value="" /><br />
			<input type="submit" name="submit" value="Deposit" />
		</form>';

}else {
	$sOutput .= '<h2>Forbidden/h2><br />
		<h4>Would you like to <a href="login.php">login</a>?</h4>
		<h4>Create a new <a href="register.php">account</a>?</h4>';

}
$sOutput .= '</div>';
echo $sOutput;
    ?>
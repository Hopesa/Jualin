<?php
require('/includes/config.php');
error_reporting(E_ALL ^ E_WARNING);
//ReChaptcha 2.0
$siteKey = '6Lew9AQTAAAAAE40l6V4t2gE-IVlTkNY3NsOI0HV';
$secret = '6Lew9AQTAAAAADd9GvRj-IWgVKCkAvxtLR0FkPSD';

        $captcha;
        if(isset($_POST['g-recaptcha-response'])){
          $captcha=$_POST['g-recaptcha-response'];
        }
        if(!$captcha){
          echo '<h2>Please check the the captcha form.</h2>';
          exit;
        }
        $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6Lew9AQTAAAAADd9GvRj-IWgVKCkAvxtLR0FkPSD KEY&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
        if($response.success==false)
        {
          echo '<h2>Spam Detected, Dispatching Memetic Cognito Hazard</h2>';
        }else
        {
          if (isset($_GET['action'])) {
	switch (strtolower($_GET['action'])) {
		case 'register':
			// If the form was submitted lets try to create the account.
			if (isset($_POST['username']) && isset($_POST['password']) && ($_POST['telp']) && ($_POST['jalan']) &&($_POST['kota']) && ($_POST['provinsi']) && ($_POST['negara'])) {
				if (createAccount($_POST['username'],$_POST['password'],$_POST['email'],$_POST['telp'],$_POST['jalan'],$_POST['kota'],$_POST['provinsi'],$_POST['negara'])) {
					$sOutput .= '<html><script>
           window.alert(" Anda Berhasil mendaftar, Silahkan Login")
           window.location.href="login.php";
       </SCRIPT></html>';
				}else {
					// unset the action to display the registration form.
					unset($_GET['action']);
				}				
			}else {
				$_SESSION['error'] = "Username and or Password was not supplied.";
				unset($_GET['action']);
			}
		break;
	}
}
        }

$sOutput .= '<div id="register-body">';



// If the user is logged in display them a message.
if (loggedIn()) {
	$sOutput .= '<html><script>
           window.alert("' . $_SESSION["username"] . ' Anda Sudah Terdaftar")
           window.location.href="login.php";
       </SCRIPT></html>';
				
// If the action is not set, we want to display the registration form
}elseif (!isset($_GET['action'])) {
	// incase there was an error 
	// see if we have a previous username
	$sUsername = "";
	if (isset($_POST['username'])) {
		$sUsername = $_POST['username'];
	}
	
	$sError = "";
	if (isset($_SESSION['error'])) {
		$sError = '<span id="error">' . $_SESSION['error'] . '</span><br />';
	}
	
	$sOutput .= '<h2>Register for this site</h2>
		' . $sError . '
		<form name="register" method="post" action="' . $_SERVER['PHP_SELF'] . '?action=register">
			Username: <input type="text" name="username" value="' . $sUsername . '" /><br />
            email: <input type="text" name="email"/><br />
			Password: <input type="password" name="password" value="" /><br /><br />
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

// display our output.
echo $sOutput;
?>
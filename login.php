<?php 
require('element.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Login | Jualin.id</title>
   <?php
echo $style
    ?>
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head><!--/head-->

<body>
	<?php
    echo $header;
?>
	
	<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Login to your account</h2>
						<form name="login" method="post" action="login_act.php?action=login">
							<input type="text" placeholder="username" name="username" />
							<input type="password" placeholder="password" name="password" />
							<span>
								<input type="checkbox" class="checkbox"> 
								Keep me signed in
							</span>
							<button type="submit" class="btn btn-default">Login</button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>New User Signup!</h2>
						<form name="register" method="post" action="register.php?action=register">
            <input type="text"name="username" placeholder="username"/>
			<input type="password" name="password"  placeholder="password"/>
            <input type="email"name="email" placeholder="Email@Email.com"/>
            <input type="number" name="telp"  placeholder="+62000"/>
            <input type="text" name="jalan" placeholder="Jalan" />
            <input type="text" name="kota"  placeholder="Kota"/>
            <input type="text" name="provinsi"  placeholder="Provinsi"/>
            <input type="text" name="negara"  placeholder="Negara"/><br>
                            <div class="g-recaptcha" data-sitekey="6Lew9AQTAAAAAE40l6V4t2gE-IVlTkNY3NsOI0HV"></div><br>
							<button type="submit" class="btn btn-default">Signup</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
	
	
<?php
echo $footer;
echo $script;
?>
</body>
</html>
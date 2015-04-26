<?php
//ReviewACT

require('element.php');
//We Check Anti Spam
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
            exit;
        }else
        {
//First We Check And Flush
if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['review'])){
    if ($_POST['username'] = $_SESSION['username']){
        
$user = $_POST['username'];
$review = $_POST['review'];
$email =$_POST['email'];
$idb = $_POST['idb'];
$sql = mysql_query("SELECT * from users where username = '$user';");
$data = mysql_fetch_array($sql);
        //insert
$sql = mysql_query("INSERT into review (`id_user`,`id_barang`,`review`,`email`) value ('$data[id_user]','$idb','$review','$email');")or trigger_error("Query Failed: " . mysql_error());
echo '<html><script>
           window.alert("' . $user . ', Review Anda telah terposting")
            window.history.back();
       </SCRIPT></html>';
}
 else{
     echo '<html><script>
           window.alert("Username dengan Username Login tidak cocok")
            window.history.back();
       </SCRIPT></html>';
 }
}
   else{
       echo '<html><script>
           window.alert("Field Belum diisi")
            window.history.back();
       </SCRIPT></html>';
   }
   }
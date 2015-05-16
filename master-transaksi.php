<?php
//This is CAF File (Central Admin File)
//We Check User Login Again/Not Now
//We Check User Level
require('element.php');
$user = $_SESSION['username'];
$sql = "SELECT * FROM users WHERE username = '$user'";
$query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
$dataid = mysql_fetch_assoc($query);
$level = $dataid["rank"];
$id_user = $dataid["id_user"];//ID User grabbed
if($level!=1000){echo "403 Not Authorized Please Exit this Page"; exit;}
//Taking data
$sql = mysql_query("SELECT * FROM `cart_final` where status='Pending Verifikasi'") or trigger_error("Query Failed: " . mysql_error());
$newtranspenver=mysql_num_rows($sql);

$sql = mysql_query("SELECT * FROM `cart_final` where status='Pending Konfirmasi'") or trigger_error("Query Failed: " . mysql_error());
$penkon=mysql_num_rows($sql);

$sql = mysql_query("SELECT * FROM `cart_final` where status='Seller Pending'") or trigger_error("Query Failed: " . mysql_error());
$selpentrans=mysql_num_rows($sql);

$sql = mysql_query("SELECT * FROM `cart_final` where status='Pending Verifikasi Resi'") or trigger_error("Query Failed: " . mysql_error());
$penveres=mysql_num_rows($sql);

$sql = mysql_query("SELECT * FROM `cart_final` where status='Pending Delivery'") or trigger_error("Query Failed: " . mysql_error());
$deliverypen=mysql_num_rows($sql);

$sql = mysql_query("SELECT * FROM `cart_final` where status='Selesai'") or trigger_error("Query Failed: " . mysql_error());
$sls=mysql_num_rows($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Admin Master Panel | Jualin.id</title>
    <?php
   echo $style
    ?>
</head><!--/head-->

<body>
<?php
    
    echo $header;
?>
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Admin Master</li>
				</ol>
			</div>
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			<div class="heading">
				<center><h3>Financial Master Panel(Pre-Alpha)</h3>
				<p>Jualin.id Status and Management.</p></center>
			</div>
			<div class="row">
				
				<div class="col-sm-12">
					<div class="total_area">
						<ul>
                            <li>Transaksi Baru Hari Ini<span><?php echo $newtranspenver ?></span></li>
							<li>Konfirmasi Transaksi <span><?php echo $penkon ?></span> </li>
							<li>Transaksi Pending Verifikasi <span><?php echo $newtranspenver ?></span> </li>
							<li>Transaski Seller Pending <span><?php echo $selpentrans ?></span> </li>
							<li>Transaski Dalam Proses Delivery <span><?php echo $deliverypen ?></span> </li>
                            <li>Transaksi Selesai <span><?php echo $sls ?></span> </li>
						</ul>
					</div>
				</div>
                <div class="col-sm-12">
					<div class="total_area">
                        <center><h3>Transaksi Baru Pending Verifikasi</h3></center>
						<ul>
                 <?php          
        $sql = mysql_query("SELECT * FROM `cart_final` where status='Pending Verifikasi'");
while($data=mysql_fetch_array($sql)){
$sOutput="";
$sOutput.='<a href="trans.php?transid='.$data['id_final'].'"/><li>ID Transaksi: '.$data['id_final'].'<span>'.$data['status'].'</span></li></a>';
echo $sOutput;
}?>
						</ul>
					</div>
				</div>
                <div class="col-sm-12">
					<div class="total_area">
                        <center><h3>Transaksi Baru Pending Konfirmasi</h3></center>
						<ul>
                 <?php          
        $sql = mysql_query("SELECT * FROM `cart_final` where status='Pending Konfirmasi'");
while($data=mysql_fetch_array($sql)){
$sOutput="";
$sOutput.='<a href="trans.php?transid='.$data['id_final'].'"/><li>ID Transaksi: '.$data['id_final'].'<span>'.$data['status'].'</span></li></a>';
echo $sOutput;
}?>
						</ul>
					</div>
				</div>
                <div class="col-sm-12">
					<div class="total_area">
                        <center><h3>Transaksi Baru Pending Seller</h3></center>
						<ul>
                 <?php          
        $sql = mysql_query("SELECT * FROM `cart_final` where status='Seller Pending'");
while($data=mysql_fetch_array($sql)){
$sOutput="";
$sOutput.='<a href="trans.php?transid='.$data['id_final'].'"/><li>ID Transaksi: '.$data['id_final'].'<span>'.$data['status'].'</span></li></a>';
echo $sOutput;
}?>
						</ul>
					</div>
				</div>
                <div class="col-sm-12">
					<div class="total_area">
                        <center><h3>Transaksi Dalam Proses Delivery</h3></center>
						<ul>
                 <?php          
        $sql = mysql_query("SELECT * FROM `cart_final` where status='Pending Delivery'");
while($data=mysql_fetch_array($sql)){
$sOutput="";
$sOutput.='<a href="trans.php?transid='.$data['id_final'].'"/><li>ID Transaksi: '.$data['id_final'].'<span>'.$data['status'].'</span></li></a>';
echo $sOutput;
}?>
						</ul>
					</div>
				</div>
               
                <center><div class="col-sm-12"><h4>Panel Lainnya</h4><button class="btn btn-default check_out">Cek Konfirmasi Pembayaran</button><button onclick="print_d()" class="btn btn-default check_out">Lihat Transaksi Baru</button><button class="btn btn-default check_out">Ke Dompetin Master Panel</button><button class="btn btn-default check_out">Ke Database Management</button><button class="btn btn-default check_out">Github Repository</button></div></center>
			</div>
		</div><br><br><br><br>
	</section><!--/#do_action-->
<?php
foot:
echo $footer;
echo $script;
?>
    <script>
        function print_d(){
            window.print();
        }
    </script>
</body>
</html>
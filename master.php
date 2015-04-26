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
if($level!=1000){echo "403 Not Authorized Please Exit this Page"; exit;}?>
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
				<center><h3>Global Master Panel(Pre-Alpha)</h3>
				<p>Jualin.id Status and Management.</p></center>
			</div>
			<div class="row">
				
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
                            <li>Transaksi Baru</li>
							<li>Konfirmasi Transaksi </li>
							<li>Transaksi Pending Verifikasi </li>
							<li>Transaski Seller Pending</li>
                            <li>Transaksi Selesai </li>
						</ul>
							<center><a class="btn btn-default check_out" href="">Lihat Master Panel Transaksi</a></center>
					</div>
				</div>
                <div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Konfirmasi baru</li>
							<li>Konfirmasi Deposit Dompetin</li>
							<li>Konfirmasi Pembayaran Lain</li>
                            <li>Konfirmasi Resi</li>
                            <li>Verifikasi Delivery</li>
                            <center><a class="btn btn-default check_out" href="">Lihat Panel Konfirmasi</a></center>
						</ul>
					</div>
                    
				</div>
                <div class="col-sm-6">
					<div class="total_area">
						<ul>
                            <li>Aduan Baru</li>
							<li>Pesan Support Baru</li>
							<li>Laporan Produk </li>
							<li>Laporan Transaksi Mencurigakan</li>
                            <li>Dispute </li>
						</ul>
							<center><a class="btn btn-default check_out" href="">Lihat Master Panel Customer</a></center>
					</div>
				</div>
                <div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Staff Verifikasi Online:</li>
							<li>Expected Profit Today</li>
							<li>Turn Over</li>
                            <li>Uang Masuk Hari Ini</li>
                            <li>Uang Keluar Hari Ini</li>
                        <center> <a class="btn btn-default check_out" href="">Lihat Panel Finance</a></center>
						</ul>
					</div>
                    
				</div>
                <center><div class="col-sm-12"><h4>Panel Lainnya</h4><button class="btn btn-default check_out">Cek Konfirmasi Pembayaran</button><button onclick="print_d()" class="btn btn-default check_out">Lihat Transaksi Baru</button><button class="btn btn-default check_out">Ke Dompetin Master Panel</button></div></center>
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
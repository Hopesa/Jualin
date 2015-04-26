<?php
//Show user Transaction
require('element.php');
if (!loggedIn()) { echo "403 Access Denied"; exit;}//Early Preventive
$id_final = $_GET['transid'];
//Taking ID User
$user = $_SESSION['username'];
$sql = "SELECT id_user FROM users WHERE username = '$user'";
$query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
$dataid = mysql_fetch_assoc($query);
$id_user = $dataid["id_user"];//ID User grabbed
$total = 0;
$user = $_SESSION['username'];
$sql = "SELECT id_user FROM users WHERE username = '$user'";
$query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
$data = mysql_fetch_assoc($query);
$id_user = $data["id_user"];
if (empty($id_user)) {
    $id_user=2;
}
//Grab those Transaction Info
$sql = mysql_query("SELECT * FROM `cart_final` WHERE `id_final`= $id_final") or trigger_error("Query Failed: " . mysql_error());
$trans_data = mysql_fetch_array ($sql);
$sql= mysql_query("select * from `transaksi-brg` where id_transaksi='$id_final'") or trigger_error("Query Failed: " . mysql_error());
if($id_user != $trans_data['id_user']){ echo "403 Not Yours"; exit;}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Transaction | Jualin.id</title>
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
				  <li class="active">Transaction ID #<?php echo $trans_data['id_final'] ?> | Transaksi Dibuat : <?php echo $trans_data['time'];?></li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
                <?php

while($data=mysql_fetch_array($sql)){

$sqlr = mysql_query("select * from barang where id_barang='$data[id_barang]'");
while($data_barang = mysql_fetch_array($sqlr)){
$sOutput.='<tr>
							<td class="cart_product">
								<a href=""><img src="images/shop/'.$data_barang['gambar'].'" alt="" width="30%"></a>
							</td>
							<td class="cart_description">
								<h4><a href="show.php?id_barang='.$data_barang['id_barang'].'">'.$data_barang['nama_barang'].'</a></h4>
								<p>ID Barang: '.$data_barang['id_barang'].'</p>
							</td>
							<td class="cart_price">
								<p>IDR: '.$data_barang['harga'].'</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									
									<input readonly class="cart_quantity_input" type="text" name="quantity" value="'.$data['jml_pesan'].'" autocomplete="off" size="2">
									
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">IDR '.$data['jml_transaksi'].'</p>
							</td>
						</tr>';
echo $sOutput;    
    $sOutput="";
}
    $total = $data['jml_transaksi']+$total;
}
?>
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>Invoice</h3>
				<p>This is your Financial Details and Order Status.</p>
			</div>
			<div class="row">
				
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
                            <li>Metode Pembayaran <span><?php echo $trans_data['method']; ?></span></li>
							<li>Cart Sub Total <span>IDR <?php echo $trans_data['sub_total']; ?></span></li>
							<li>Code ID <span><?php echo $trans_data['pay_code']; ?></span></li>
							<li>Total <span>IDR <?php echo $trans_data['total']; ?></span></li>
                            <li>Status <span><?php echo $trans_data['status']; ?></span></li>
						</ul>
							<a class="btn btn-default check_out" href="">Rincian Transaksi</a>
					</div>
				</div>
                <div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Alamat Kirim <span><?php echo $trans_data['alamat']; ?></span></li>
							<li>Kode Pos <span><?php echo $trans_data['postal']; ?></span></li>
							<li>Kota<span><?php echo $trans_data['kota']; ?></span></li>
                            <li>Penerima<span><?php echo $trans_data['top']; ?> <?php echo $trans_data['mid']; ?> <?php echo $trans_data['bot']; ?></span></li>
                            <li>Resi<span>$resi</span></li>
                            <a class="btn btn-default check_out" href="">Track Package</a>
						</ul>
					</div>
				</div>
                <center><div class="col-sm-12"><h4>Silahkan Segera Menkonfirmasi Pembayaran dengan rentang waktu 2x24 Jam</h4><h5>Transfer sebesar $total ke Rekening (nomor rek) an (atasnama)  dengan bank(bank)</h5><button class="btn btn-default check_out">Konfirmasi Pembayaran</button><button onclick="print_d()" class="btn btn-default check_out">Print Invoice Ini</button><button class="btn btn-default check_out">Ganti Metode Pembyaran</button></div></center>
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
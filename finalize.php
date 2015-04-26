<?php
//FINALIZE EVERYTHING
//Taking Data From Current Checkout State\
require('element.php');
$_SESSION['alamat'] = 0;
$user = $_SESSION['username'];
$top = $_POST['top'];
$mid = $_POST['mid'];
$bot = $_POST['bot'];
$payment = $_POST['payment'];
$kode = $_POST['kode'];
$note = $_POST['message'];
//Taking ID User
$sql = "SELECT id_user FROM users WHERE username = '$user'";
$query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
$data = mysql_fetch_assoc($query);
$id_user = $data["id_user"];//ID User grabbed
$sql ="SELECT * from alamat WHERE id_user = $id_user";
$query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
$data_alamat = mysql_fetch_assoc($query);//Location Grabbed
$total = 0;
if(empty($id_user)){
    $id_user=2;
    $user="Guest";
}
$aOutput="";
if($_SESSION['alamat']==0){
$aOutput.='<div class="bill-to">
							<p>Delivery To</p>
							<div class="form-one">
								<form>
									<input readonly type="text" value="'.$top.'">
									<input readonly type="text" value="'.$mid.'">
									<input readonly type="text" value="'.$bot.'">
									<input readonly type="text" value="+62'.$data_alamat['no_telp'].'">
								</form>
							</div>
							<div class="form-two">
								<form>
									<input readonly type="text" value="'.$data_alamat['postal'].'">
									<select disabled name="nation">
										<option value="'. $data_alamat['negara'].'">'. $data_alamat['negara'].'</option>
										<?php echo $country; ?>
									</select>
									<input readonly type="text" value="'.$data_alamat['jalan'].' '.$data_alamat['kota'].'">
                                    <input readonly type="text" value="'.$data_alamat['provinsi'].'">
								</form>
							</div>
						</div>';}
else {
    $aOutput.='<div class="bill-to">
							<p>Delivery To</p>
							<div class="form-one">
								<form>
									<input type="text" placeholder="First Name *">
									<input type="text" placeholder="Middle Name">
									<input type="text" placeholder="Last Name *">
									<input type="text" placeholder="Address 1 *">
								</form>
							</div>
							<div class="form-two">
								<form>
									<input type="text" placeholder="Zip / Postal Code *">
									<select name="nation">
										<option>-- Country --</option>
										<?php echo $country; ?>
									</select>
									<input type="text" placeholder="Phone *">
                                    <input type="text" placeholder="Address 2">
								</form>
							</div>
						</div>';}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Checkout | Jualin.id</title>
    <?php
echo $style;
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
				  <li><a href="checkout.php">Check out</a></li>
                    <li class="active">Finalize</li>
				</ol>
			</div><!--/breadcrums-->

			<div class="step-one">
				<h2 class="heading">Transaksi Atas Akun: <?php echo $user;?> </h2>
			</div>
            
            <div class="step-one">
				<h2 class="heading">Alamat</h2>
			</div>
			<div class="shopper-informations">
				<div class="row">
					<div class="col-sm-8 clearfix">
						<?php echo $aOutput; ?>
					</div>
					<div class="col-sm-4">
						<div class="order-message">
							<p>Order Note</p>
							<textarea name="message"  placeholder="<?php echo $note; ?>" rows="16"></textarea>
						</div>	
					</div>		
                    
				</div>
			</div>
			<div class="step-one">
				<h2 class="heading">Invoice</h2>
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
						$sql= mysql_query("select * from cart_pending where id_user='$id_user'");
while($data=mysql_fetch_array($sql)){

$sqlr = mysql_query("select * from barang where id_barang='$data[id_barang]'");
while($data_barang = mysql_fetch_array($sqlr)){
$sOutput.='<tr>
							<td class="cart_product">
								<a href=""><img src="images/shop/'.$data_barang['gambar'].'" alt="" width="30%"></a>
							</td>
							<td class="cart_description">
								<h4><a href="show.php?id_barang='.$data_barang['id_barang'].'">'.$data_barang['nama_barang'].'</a></h4>
								<p>ID: '.$data_barang['id_barang'].'</p>
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
$totals = $kode + $total;
?>

						<tr>
							<td colspan="4">&nbsp;</td>
							<td colspan="2">
								<table class="table table-condensed total-result">
									<tr>
										<td>Cart Sub Total</td>
										<td>IDR <?php echo $total ?></td>
									</tr>
									<tr>
										<td>ID Check</td>
										<td>IDR <?php echo $kode?></td>
									</tr>
									<tr class="shipping-cost">
										<td>Shipping Cost</td>
										<td>$shipping</td>										
									</tr>
									<tr>
										<td>Total</td>
										<td><span>IDR <?php echo $totals ?></span></td>                   
									</tr>
                                    <tr>
                                    <td>Opsi</td>
										<td><span><?php echo $payment ?></span></td>
                                    </tr>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="payment-options checkout">
                <form action="finalize_act.php" method="post">
                    <input type="text" value="<?php echo $top ?>" hidden="yes" name="top">
                    <input type="text" value="<?php echo $mid ?>" hidden="yes" name="mid">
                    <input type="text" value="<?php echo $bot ?>" hidden="yes" name="bot">
                    <input type="text" value="<?php echo $note ?>" hidden="yes" name="note">
                    <input type="text" value="<?php echo $payment ?>" hidden="yes" name="payment">
                    <input type="text" value="<?php echo $kode ?>" hidden="yes" name="kode">
                    <input type="text" value="<?php echo $total ?>" hidden="yes" name="sub-total">
                    <input type="text" value="<?php echo $totals ?>" hidden="yes" name="total">
                    <button type="submit" class="btn btn-fefault cart">
Finalisasi</button>
                    </form>
				</div>
		</div>
	</section> <!--/#cart_items-->

	
<?php
echo $footer;
echo $script;
?>
</body>
</html>
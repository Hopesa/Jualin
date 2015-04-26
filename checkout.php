<?php
require('element.php');
$_SESSION['alamat'] = 0;
$user = $_SESSION['username'];
//Taking ID User
$sql = "SELECT id_user FROM users WHERE username = '$user'";
$query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
$data = mysql_fetch_assoc($query);
$id_user = $data["id_user"];//ID User grabbed
$sql ="SELECT * from alamat WHERE id_user = $id_user";
$query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
$data_alamat = mysql_fetch_assoc($query);//Location Grabbed
$kode = rand(100, 999);
$total = 0;
if(empty($id_user)){
    $id_user=2;
    $user="Guest";
}
if (loggedIn()){
$sOutput.='<div class="checkout-options">
				<h3>Checkout Atas Nama '.$user.'?</h3>
				<p>Checkout options</p>
				<ul class="nav">
					<li>
						<a href="login?action=logout"><i class="fa fa-times"></i>Change User?</a>
					</li>
				</ul>
			</div>';}
else {
$sOutput.='<div class="checkout-options">
				<h3>Guest</h3>
				<p>Checkout options</p>
				<ul class="nav">
					<li>
						<a href="login.php">Register</a>
					</li>
				</ul>
			</div>';}
$aOutput="";
if($_SESSION['alamat']==0){
$aOutput.='<div class="bill-to">
							<p>Delivery To</p>
							<div class="form-part">
									<input type="text" placeholder="First Name *" name="top">
									<input type="text" placeholder="Middle Name" name="mid">
									<input type="text" placeholder="Last Name *" name="bot">
									<input disabled type="text" value="+62'.$data_alamat['no_telp'].'">
							</div>
							<div class="form-part">
									<input disabled type="text" value="'.$data_alamat['postal'].'">
									<select disabled name="nation">
										<option value="'. $data_alamat['negara'].'">'. $data_alamat['negara'].'</option>
										<?php echo $country; ?>
									</select>
									<input disabled type="text" value="'.$data_alamat['jalan'].' '.$data_alamat['kota'].'">
                                    <input disabled type="text" value="'.$data_alamat['provinsi'].'">
							</div>
						</div>';}
else {
    $aOutput.='<div class="bill-to">
							<p>Delivery To</p>
							<div class="form-one">
									<input type="text" placeholder="First Name *">
									<input type="text" placeholder="Middle Name">
									<input type="text" placeholder="Last Name *">
									<input type="text" placeholder="Address 1 *">
							</div>
							<div class="form-two">
									<input type="text" placeholder="Zip / Postal Code *">
									<select name="nation">
										<option>-- Country --</option>
										<?php echo $country; ?>
									</select>
									<input type="text" placeholder="Phone *">
                                    <input type="text" placeholder="Address 2">
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
				  <li class="active">Check out</li>
				</ol>
			</div><!--/breadcrums-->

			<div class="step-one">
				<h2 class="heading">Step 1</h2>
			</div>
            <?php
                echo $sOutput;
                $sOutput="";
            ?>
			<!--/checkout-options-->
            <div class="form-one">
            <form action="finalize.php" method="post">
            <div class="step-one">
				<h2 class="heading">Step 2</h2>
			</div>
			<div class="shopper-informations">
				<div class="row">
					<div class="col-sm-8 clearfix">
						<?php echo $aOutput; ?>
                        <br>
                        <button value="1" name  type="submit" class="btn btn-fefault cart">
Ganti Alamat</button>
					</div>
					<div class="col-sm-4">
						<div class="order-message">
							<p>Shipping Order</p>
							<textarea name="message"  placeholder="Notes about your order, Special Notes for Delivery" rows="16"></textarea>
						</div>	
					</div>		
                    
				</div>
			</div>
			<div class="review-payment">
				<h2>Review & Payment</h2>
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
									<a class="cart_quantity_up" href=""> + </a>
									<input class="cart_quantity_input" type="text" name="quantity" value="'.$data['jml_pesan'].'" autocomplete="off" size="2">
									<a class="cart_quantity_down" href=""> - </a>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">IDR '.$data['jml_transaksi'].'</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="cart_action.php?action=delete&id='.$data_barang['id_barang'].'"><i class="fa fa-times"></i></a>
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
								</table>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="payment-options checkout">
                Bayar Dengan: &nbsp;
                <input hidden type="number" name="kode" value="<?php echo $kode ?>">
					<span>
						<label><input name="payment" type="radio" value="dompetin">Dompetin</label>
					</span>
					<span>
						<label><input name="payment" type="radio" value="bank">Transfer Bank</label>
					</span>
					<span>
						<label><input name="payment" type="radio" value="paypal"> Paypal</label>
					</span>
                    <span>
						<label><input name="payment" type="radio" value="wallet"> Google Wallet</label>
					</span>
                    <button  type="submit" class="btn btn-fefault cart">
Lanjut Ke Finalisasi</button>
                    </form>
                </div>
				</div>
		</div>
	</section> <!--/#cart_items-->

	
<?php
echo $footer;
echo $script;
?>
</body>
</html>
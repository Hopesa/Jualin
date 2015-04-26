<?php
require('element.php');
$total = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Cart | Jualin.id</title>
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
				  <li class="active">Shopping Cart</li>
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
$user = $_SESSION['username'];
$sql = "SELECT id_user FROM users WHERE username = '$user'";
$query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
$data = mysql_fetch_assoc($query);
$id_user = $data["id_user"];
if (empty($id_user)) {
    $id_user=2;
}
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
?>
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>What would you like to do next?</h3>
				<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="chose_area">
						<ul class="user_option">
							<li>
								<input type="checkbox">
								<label>Use Coupon Code</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Use Gift Voucher</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Estimate Shipping & Taxes</label>
							</li>
						</ul>
						<ul class="user_info">
							<li class="single_field">
								<label>Country:</label>
								<select>
									<option>Indonesia</option>
									<option>Malaysia</option>
									<option>UK</option>
									<option>Australia</option>
									<option>US</option>
									<option>Russia</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
								
							</li>
							<li class="single_field">
								<label>Region / State:</label>
								<select>
									<option>Select</option>
									<option>Dhaka</option>
									<option>London</option>
									<option>Dillih</option>
									<option>Lahore</option>
									<option>Alaska</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
							
							</li>
							<li class="single_field zip-field">
								<label>Zip Code:</label>
								<input type="text">
							</li>
						</ul>
						<a class="btn btn-default update" href="">Get Quotes</a>
						<a class="btn btn-default check_out" href="">Continue</a>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Cart Sub Total <span>IDR <?php echo $total; ?></span></li>
							<li>Shipping Cost <span>$shipping</span></li>
							<li>Total <span>IDR <?php echo $total; ?></span></li>
						</ul>
							<a class="btn btn-default update" href="">Update</a>
							<a class="btn btn-default check_out" href="checkout.php">Check Out</a>
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->
<?php
echo $footer;
echo $script;
?>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
<?php
//This PHP Contain HTML ELement so I doesnt need to write it down multiple times
require_once 'element.php';error_reporting(E_ALL ^ E_NOTICE);

?>
    <title>Products | Jualin.id</title>
<?php
echo $style;
?>
</head><!--/head-->

<body>
<?php
echo $header;

echo $ads;
?>

	<section>
		<div class="container">
			<div class="row">
<?php
echo $sidebar;
?>
				
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Features Items</h2>
						<?php

//Untuk mengatur jumlah item yang ditampilkan secara horizontal
$batas=6;
$halaman=$_GET['halaman'];
if(empty($halaman)){
$posisi=0;
$halaman=1;
}else{
$posisi=($halaman-1)*$batas;
}

$kolom=3;
$sql= mysql_query("select * from barang limit $posisi,$batas");
$i=0;
while($data=mysql_fetch_array($sql)){
if($i>=$kolom){
echo"</tr><tr>";
$i=0;
}
$i++;
$sOutput="";
$sOutput.='<a href="show.php?id_barang='.$data['id_barang'].'"><span class="spanproduct"><div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
                                    <a href="show.php?id_barang='.$data['id_barang'].'">
									<div class="productinfo text-center">
										<img src="images/shop/'.$data['gambar'].'" alt="" />
										<h2> IDR '.$data['harga'].'</h2>
										<p>'.$data['nama_barang'].'</p>
										<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
									</div>
                                    </a>
                                    <a href="show.php?id_barang='.$data['id_barang'].'">
									<div class="product-overlay">
										<div class="overlay-content">
											<h2>IDR '.$data['harga'].'</h2>
											<p>'.$data['nama_barang'].'</p>
											<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
										</div>
									</div>
                                    </a>
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
										<li><a href=""><i class="fa fa-plus-square"></i>Add to compare</a></li>
									</ul>
								</div>
							</div>
						</div></span></a>';
echo $sOutput;
}
echo"</tr></table>";

$query=mysql_num_rows(mysql_query("select * from barang"));
$jum=ceil($query/$batas);
//Membuat Page pada halaman katalog
echo "<ul class='pagination'>";
for($i=1;$i<=$jum;$i++)
if($i != $halaman){
echo"<li><a href='?halaman=$i'> $i</a></li> ";
}
else{
echo"<li class='active'><a href=''>$i</a></li>";
}
echo "<li><a href=''>&raquo;</a></li>";
echo "</ul>";                        
?>
					</div><!--features_items-->
				</div>
			</div>
		</div>
	</section>
	
	
	<?php
echo $footer;
echo $script;
?>
</body>
</html>
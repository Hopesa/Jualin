<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
            <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
    </head>
    <body>
<div class="col-sm-9 padding-right">        
<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Features Items</h2>
<?php

//Memanggil Koneksi

require('/includes/config.php');

//Untuk mengatur jumlah item yang ditampilkan secara horizontal
$batas=12;
$halaman=$_GET['halaman'];
if(empty($halaman)){
$posisi=0;
$halaman=1;
}else{
$posisi=($halaman-1)*$batas;
}

$kolom=3;
$sql= mysql_query("select * from barang limit $posisi,$batas");
echo"<h3>&#187 : Semua Produk Kami</h3><p></p>";
echo"<table border=0 width=500px><tr>";
$i=0;
while($data=mysql_fetch_array($sql)){
if($i>=$kolom){
echo"</tr><tr>";
$i=0;
}
$i++;
$sOutput.='<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
									<div class="productinfo text-center">
										<img src="images/shop/'.$data['gambar'].'" alt="" />
										<h2> IDR '.$data['harga'].'</h2>
										<p>'.$data['nama_barang'].'</p>
										<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
									</div>
									<div class="product-overlay">
										<div class="overlay-content">
											<h2>'.$data['harga'].'</h2>
											<p>'.$data['nama_barang'].'</p>
											<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
										</div>
									</div>
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
										<li><a href=""><i class="fa fa-plus-square"></i>Add to compare</a></li>
									</ul>
								</div>
							</div>
						</div>';
echo $sOutput;
}
echo"</tr></table>";

$query=mysql_num_rows(mysql_query("select * from barang"));
$jum=ceil($query/$batas);

echo"<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Halaman :";

//Membuat Page pada halaman katalog

for($i=1;$i<=$jum;$i++)
if($i != $halaman){
echo"<a href='?page=katalog&halaman=$i'> $i</a>| ";
}
else{
echo"<b> $i |</b>";
}?>
        </div>
        </div>
    </body>
</html>

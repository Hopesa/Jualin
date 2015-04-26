<html lang="en">
<head>
<?php
//This PHP Contain HTML ELement so I doesnt need to write it down multiple times
require_once 'element.php';

?>
    <title>Products | Jualin.id</title>
<?php
echo $style;
?>
       <script src='https://www.google.com/recaptcha/api.js'></script>
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
				
				
					
						<h2 class="title text-center">Item Details</h2>
						<?php


//This for Pulling specified data
$id_barang=$_GET['id_barang'];
$sql= mysql_query("SELECT * FROM `barang` WHERE `id_barang`=$id_barang");
$i=0;
$data=mysql_fetch_array($sql);
//Pulling Related Items by Categories
$sqlr= mysql_query("SELECT * FROM `barang` WHERE `kategori`=$data[kategori]");
//This For Pulling Seller Username (Barang >> Users)
$sql= mysql_query("SELECT username FROM `users` WHERE `id_user`=$data[id_user]");
$userdata = mysql_fetch_array($sql);;
$username = $userdata['username'];
//Pulling Data From Related
$batas=6;
$posisi=0;

$status = "Tersedia";
$button = "";
$btnmsg = "Add To Cart";
if(empty($username)){
    $username = "User Dihapus";
    $status ="Tidak Tersedia (Tiada User)";
    $button ="Disabled";
    $btnmsg="Tidak Tersedia";
    $data['stock']=0;
}
elseif($data['stock']==0){
    $status ="Tidak Tersedia (Habis)";
    $button ="Disabled";
    $btnmsg="Tidak Tersedia";
}
$sOutput="";
$sOutput.='<div class="col-sm-9 padding-right">
					<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
								<img src="images/product-details/'.$data['gambar'].'" alt="" />
								<h3>ZOOM</h3>
							</div>
							
						</div>
						<div class="col-sm-7">
                        
							<div class="product-information"><!--/product-information-->
								<img src="images/product-details/new.jpg" class="newarrival" alt="" />
								<h2>'.$data['nama_barang'].'</h2>
								<p>ID: '.$data['id_barang'].'</p>
								
								<span>
									<span>IDR '.$data['harga'].'</span>
									<h3><label>Stok: '.$data['stock'].'</label></h3>								</span>
                                    <span>
                                    <form action="cart_pending.php?id_barang='.$data['id_barang'].'" method="post">
									<input name="jumlah" type="text" placeholder="0" '.$button.' />
									<button '.$button.' type="submit" class="btn btn-fefault cart">
										<i class="fa fa-shopping-cart"></i>
										'.$btnmsg.'
									</button>
                                    </form>
</span>
								<p><b>Availability: </b>'.$status.'</p>
								<p><b>Seller: </b>'.$username.'</p>
								<p><b>Kategori: </b>'.$data['kategori'].'</p>
                                <p><b>Lokasi: </b>'.$data['lokasi'].'</p>
								<a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
							</div><!--/product-information-->
						</div>
					</div><!--/product-details-->
					
					<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li><a href="#details" data-toggle="tab">Details</a></li>
								<li><a href="#tag" data-toggle="tab">Tag</a></li>
								<li class="active"><a href="#reviews" data-toggle="tab">Reviews (1)</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade" id="details" >
								<h3>'.$data['deskripsi'].'</h3>
							</div>
							<div class="tab-pane fade" id="tag" >
								
							</div>
							
							<div class="tab-pane fade active in" id="reviews" >
                            
                                    <div class="col-sm-12">
                            
								';
                            $output2 = '';
                            $output2.='
                            <p><b>Write Your Review</b></p>
									
									<form method="POST" action="review_act.php">
										<span>
											<input type="text" placeholder="Nama Anda" name="username"/>
											<input type="email" placeholder="Email Address" name="email"/>
                                            <input type="number" name="idb" value="'.$id_barang.'" hidden/>
										</span>
										<textarea name="review" ></textarea>
										<b>Rating: </b> <img src="images/product-details/rating.png" alt="" />
                                         <div class="g-recaptcha" data-sitekey="6Lew9AQTAAAAAE40l6V4t2gE-IVlTkNY3NsOI0HV"></div>
										<button type="submit" class="btn btn-default pull-right">
											Submit
										</button>
									</form>
								</div>
							</div>
							
						</div>
					</div><!--/category-tab-->
					
					
									
								';
echo $sOutput;

$sql=mysql_query('select * from review where id_barang = '.$id_barang.'');
while($rev=mysql_fetch_array($sql)){
$revsq= mysql_query("SELECT username FROM `users` WHERE `id_user`=$rev[id_user]");
$revsql=mysql_fetch_array($revsq);
    $review='';
    $review.='
									<ul>
										<li><a href=""><i class="fa fa-user"></i>'.$revsql['username'].'</a></li>
										<li><a href=""><i class="fa fa-clock-o">'.$rev['timestamp'].'</i></a></li>
									</ul>
									<p>'.$rev['review'].'</p>
									';
        
    echo $review;
}
    echo $output2;
?>
                <div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">recommended items</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">	
                                    <?php
                
$sql= mysql_query("SELECT * FROM `barang` WHERE `kategori`='$data[kategori]' limit 0,3");
while($related=mysql_fetch_array($sql)){
    $rOutput="";
    $rOutput.='<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<a href="show.php?id_barang='.$related['id_barang'].'">
													<img src="images/shop/'.$related['gambar'].'" alt="">
													<h2>IDR '.$related['harga'].'</h2>
													<p>'.$related['nama_barang'].'</p>
                                                    </a>
													<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
												</div>
											</div>
										</div>
									</div>';
    echo $rOutput;
}
//Membuat Page pada halaman katalog
?>
                </div>
                <div class="item">
<?php
$sql= mysql_query("SELECT * FROM `barang` WHERE `kategori`='$data[kategori]' limit 3,3");
while($related=mysql_fetch_array($sql)){
    $rOutput="";
    $rOutput.='<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
                                                <a href="show.php?id_barang='.$related['id_barang'].'">
													<img src="images/shop/'.$related['gambar'].'" alt="">
													<h2>IDR '.$related['harga'].'</h2>
													<p>'.$related['nama_barang'].'</p>
                                                    </a>
													<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
												</div>
                                                
											</div>
										</div>
									</div>';
    echo $rOutput;
}
?>
                </div>
							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			
						</div>
					</div><!--/recommended_items-->
					
				</div>
					</div><!--features_items-->
				</div>

	</section>
	
	
	<?php
echo $footer;
echo $script;
?>
</body>
</html>
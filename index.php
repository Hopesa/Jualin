<?php
/*****************************
	File: index.php
******************************/
require_once 'element.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | Jualin.id</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <?php
    echo $style;
?>
    </head><!--/head-->

<body>
	<?php
echo $header;
echo $slider;
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

$sql= mysql_query("SELECT * FROM `barang` ORDER BY RAND() LIMIT 0,6");
while($data=mysql_fetch_array($sql)){
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
?>
						
					</div><!--features_items-->
					
					<div class="category-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#elektronik" data-toggle="tab">Elektronik</a></li>
								<li><a href="#rumah" data-toggle="tab">Peralatan Rumah</a></li>
								<li><a href="#hobi" data-toggle="tab">Hobi</a></li>
								<li><a href="#anak" data-toggle="tab">Anak</a></li>
								<li><a href="#fashion" data-toggle="tab">Fashion</a></li>
                                <li><a href="#hewan" data-toggle="tab">Hewan</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade active in" id="elektronik" >
								<?php
$sql= mysql_query("SELECT * FROM `barang` WHERE `kategori`='elektronik'ORDER BY RAND() LIMIT 0,3");
while($related=mysql_fetch_array($sql)){
    $rOutput="";
    $rOutput.='<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
                                                    <a href="show.php?id_barang='.$related['id_barang'].'">
													<img src="images/shop/'.$related['gambar'].'" height="50%" alt="">
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
							
                            <div class="tab-pane fade" id="fashion" >
                                <?php
$sql= mysql_query("SELECT * FROM `barang` WHERE `kategori`='fashion'ORDER BY RAND() LIMIT 0,3");
while($related=mysql_fetch_array($sql)){
    $rOutput="";
    $rOutput.='<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<a href="show.php?id_barang='.$related['id_barang'].'">
													<img src="images/shop/'.$related['gambar'].'" height="50%" alt="">
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
                            
							<div class="tab-pane fade" id="hobi" >
								<?php
$sql= mysql_query("SELECT * FROM `barang` WHERE `kategori`='hobi'ORDER BY RAND() LIMIT 0,3");
while($related=mysql_fetch_array($sql)){
    $rOutput="";
    $rOutput.='<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<a href="show.php?id_barang='.$related['id_barang'].'">
													<img src="images/shop/'.$related['gambar'].'" height="50%" alt="">
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
							
							<div class="tab-pane fade" id="hewan" >
								<?php
$sql= mysql_query("SELECT * FROM `barang` WHERE `kategori`='hewan'ORDER BY RAND() LIMIT 0,3");
while($related=mysql_fetch_array($sql)){
    $rOutput="";
    $rOutput.='<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<a href="show.php?id_barang='.$related['id_barang'].'">
													<img src="images/shop/'.$related['gambar'].'" height="50%" alt="">
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
							
							<div class="tab-pane fade" id="anak" >
								<?php
$sql= mysql_query("SELECT * FROM `barang` WHERE `kategori`='anak'ORDER BY RAND() LIMIT 0,3");
while($related=mysql_fetch_array($sql)){
    $rOutput="";
    $rOutput.='<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<a href="show.php?id_barang='.$related['id_barang'].'">
													<img src="images/shop/'.$related['gambar'].'" height="50%" alt="">
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
							
							<div class="tab-pane fade" id="rumah" >
								<?php
$sql= mysql_query("SELECT * FROM `barang` WHERE `kategori`='rumah'ORDER BY RAND() LIMIT 0,3");
while($related=mysql_fetch_array($sql)){
    $rOutput="";
    $rOutput.='<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<a href="show.php?id_barang='.$related['id_barang'].'">
													<img src="images/shop/'.$related['gambar'].'" height="50%" alt="">
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
					</div><!--/category-tab-->
					
					
					
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
<?php
require('element.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Sell | Jualin.id</title>
    <?php
echo $style;
    ?>
</head><!--/head-->

<body>
<?php
    echo $header;
if (loggedIn()) {
    $user = $_SESSION['username'];
    $sql = "SELECT id_user FROM users WHERE username = '$user'";
    $query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
    $data = mysql_fetch_assoc($query);
    $id_user = $data["id_user"];
    $sql = "SELECT * FROM barang WHERE id_user = '$id_user'";
    $result = mysql_query($sql);
    $output ="";
    $output .='<div id="contact-page" class="container">
    	<div class="bg">   		  	
    		<div class="row">  	
	    		<div class="col-sm-12">
	    			<div class="contact-form">
	    				<h2 class="title text-center">Sell <span>Item</span></h2>
	    				<div class="status alert alert-success" style="display: none"></div>
				    	<form name="sell" id="main-contact-form" class="contact-form row" name="contact-form" method="post" action="sell_act.php">
				            <div class="form-group col-md-12">
				                <input type="text" name="nama" class="form-control" required="required" placeholder="Nama Barang">
				            </div>
				            <div class="form-group col-md-12"><p>Kategori</p>
				                 <select name="kategori">
                                    <option value="elektronik">Elektronik</option>
                                    <option value="rumah">Peralatan Rumah</option>
                                    <option value="hobi">Hobi</option>
                                    <option value="anak">Anak</option>
                                    <option value="fasion">Fashion</option>
                                    <option value="hewan">Hewan</option>
                                    <option value="medis">Medis</option>
                                    <option value="edukasi">Edukasi</option>
                                    <option value="mineral">Mineral</option>
                                    <option value="lainnya">Lainnya</option>
                                 </select>
				            </div>
				            <div class="form-group col-md-12">
				                <input type="text" name="harga" class="form-control" required="required" placeholder="Harga">
				            </div>
                            <div class="form-group col-md-12">
				                <input type="text" name="stock" class="form-control" required="required" placeholder="Stock">
				            </div>
                            <div class="form-group col-md-12">
				                <input type="text" name="lokasi" class="form-control" required="required" placeholder="Lokasi">
				            </div>
				            <div class="form-group col-md-12">
				                <textarea name="deskripsi" id="message" required="required" class="form-control" rows="8" placeholder="Deskripsi Barang"></textarea>
				            </div>
                            <div class="form-group col-md-12">
				                <input type="file" name="gambar" class="form-control" required="required" placeholder="Gambar">
				            </div>
                             <input type="text" name="iduser" value='.$id_user.' hidden/>
				            <div class="form-group col-md-12">
				                <input type="submit" name="submit" class="btn btn-primary pull-right" value="Jual">
				            </div>
				        </form>
	    			</div>
	    		</div>
	    		 			
	    	</div>  
    	</div>	
        <h2 class="title text-center">Barang Anda</span></h2>
    </div><!--/#e-->'
        ;
    
}
else{
    $output="";
    $output.='
    <div class="container">
    <div class="bg">   
    <div class="row">  	
    <div class="col-sm-12">
    <br><br><br><br><br><br><br><center><h1>ERROR 403:Mohon Login Dulu</h1></center><br><br><br><br><br><br><br><br><br><br><br><br><br>
    </div>
    </div>
    </div>
    </div>
    ';
}
echo $output;
$batas=6;
$halaman=$_GET['halaman'];
if(empty($halaman)){
$posisi=0;
$halaman=1;
}else{
$posisi=($halaman-1)*$batas;
}

$kolom=3;
$sql= "select * from `barang` WHERE `id_user` = $id_user limit $posisi,$batas";
$query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
$i=0;
while($data=mysql_fetch_array($query)){
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

$query=mysql_num_rows(mysql_query("select * from barang WHERE id_user = '$id_user'"));
$jum=ceil($query/$batas);
//Membuat Page pada halaman katalog
echo "<ul class='pagination'>";
for($i=1;$i<=$jum;$i++)
if($i != $halaman){
echo"<li><a href='?page=shop&halaman=$i'> $i</a></li> ";
}
else{
echo"<li class='active'><a href=''>$i</a></li>";
}
echo "<li><a href=''>&raquo;</a></li>";
echo "</ul>";  
echo $footer;
echo $script;
?>
</body>
</html>
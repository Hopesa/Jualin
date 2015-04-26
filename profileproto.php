<?php
require('element.php');
$id = $_GET['id'];
$sql = "select * from users p inner join alamat b on p.id_user=b.id_user and p.id_user=$id";
$query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Profile | Jualin.id</title>
<?php
echo $style;
?>
    </head>
    <body><?php
echo $header;
while($row = mysql_fetch_array($query)){
    echo "Nama : ".$row['username']; 
    echo "<br>Email : ".$row['email'];
    echo "<br>Tanggal Daftar : ".$row['tanggal_daftar'];
    echo "<br>Alamat : ".$row['jalan'].$row['kota'].$row['provinsi'].$row['negara']; 
    echo "<br>No. Telp : ".$row['no_telp'];
    echo "<hr>";
}
?>
        <div class="container">
        <div class="col-sm-9 padding-right">
					<div class="features_items">
                        <?php
$batas=6;
$halaman=$_GET['halaman'];
if(empty($halaman)){
$posisi=0;
$halaman=1;
}else{
$posisi=($halaman-1)*$batas;
}

$kolom=3;
$sql= "select * from `barang` WHERE `id_user` = $id limit $posisi,$batas";
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

$query=mysql_num_rows(mysql_query("select * from barang WHERE id_user = '$id'"));
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
?>
            </div></div></div>
        <?php
echo $footer;
echo $script;
                        ?>
        </body>
</html>
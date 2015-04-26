<!DOCTYPE html>
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
</head><!--/head-->

<body>
<?php
echo $header;

echo $ads;
?>

	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-12 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Barang Anda</h2>
						<?php

//Memanggil Koneksi

mysql_connect('localhost', 'root', '') or trigger_error("Unable to connect to the database: " . mysql_error());
mysql_select_db('tgsphp') or trigger_error("Unable to switch to the database: " . mysql_error());

//Untuk mengatur jumlah item yang ditampilkan secara horizontal
$batas=6;
$halaman=$_GET['halaman'];
if(empty($halaman)){
$posisi=0;
$halaman=1;
}else{
$posisi=($halaman-1)*$batas;
}
    $user = $_SESSION['username'];
    $sql = "SELECT id_user FROM users WHERE username = '$user'";
    $query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
    $data = mysql_fetch_assoc($query);
    $id_user = $data["id_user"];
$kolom=3;
$sql= mysql_query("select * from barang where id_user=$id_user limit $posisi,$batas");
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
									</div>
                                    </a>
                                    <a href="show.php?id_barang='.$data['id_barang'].'">
									<div class="product-overlay">
										<div class="overlay-content">
											<h2>IDR '.$data['harga'].'</h2>
											<p>'.$data['nama_barang'].'</p>
										</div>
									</div>
                                    </a>
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
echo"<li><a href='?page=shop&halaman=$i'> $i</a></li> ";
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
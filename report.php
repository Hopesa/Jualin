<link rel="stylesheet" href="css.css" type="text/css" />

<body>
<div id="header">
<font color="#FFFFFF" face="Comic Sans MS, cursive," >
<h3>Pengaduan Page</h3>
<h4 align='center'><br /><br>Selamat datang di "PENGADUAN PAGE" , Anda dapat melaporkan segala macam masalah yang terjadi saat proses pengiriman maupun sesudah pengiriman.<br />Seperti barang belum sampai sesuai tanggal yang sudah ditentukan , ketika barang samapai dalam keadaan cacat,dll.<br>Caranya isikan data yang tertera pada form dibawah ini pastikan sesuai dengan data yang anda miliki dan jangan sampai ada yang kosong.
<br>Pada bagian pengaduan anda bisa mengetikkan masalah atau keluhan-keluhan  yang terjadi saat proses pengriman maupun proses lainnya.<br />Setelah itu tinggal klik SUBMIT , apabila sukses maka Anda tinggal menunggu message berikutnya namun apabila gagal silahkan cek lagi saat pengisian form.<br/></h4> 
<br/>
<br/>
</font>
</p>
</div>
</body>

<form name="form-name" method="post" action="post_input.php">  
<table border="1" align="center">
<tbody bgcolor="#666666"</tbody>
<tr><td bgcolor="#00CCFF" align="center" colspan="2">PENGADUAN</td></tr>	
<tr bgcolor="#0099FF">  
<td bgcolor="#00CCCC">ID User </td>  
<td>  
<input name="id_user" id="id_user" type="text" value="<?php echo isset($_POST['id_user']) ? $_POST['id_user'] : '';?>" /> 
<div style="color:red"><?php echo isset($error['id_user']) ? $error['id_user'] : '';?></div>  
</td>
</tr>
<tr bgcolor="#0099FF">  
<td bgcolor="#00CCCC">Nama </td>  
<td>  
<input name="nama" id="nama" type="text" value="<?php echo isset($_POST['nama']) ? $_POST['nama'] : '';?>" />  
<div style="color:red"><?php echo isset($error['nama']) ? $error['nama'] : '';?></div>  
</td>
</tr>
<tr bgcolor="#0099FF">  
<td bgcolor="#00CCCC">Alamat  </td>  
<td>  
<input name="alamat" id="alamat" type="text" value="<?php echo isset($_POST['alamat']) ? $_POST['alamat'] : '';?>" />  
<div style="color:red"><?php echo isset($error['alamat']) ? $error['alamat'] : '';?></div>  
</td>
</tr>
<tr bgcolor="#0099FF">  
<td bgcolor="#00CCCC">Id Barang </td>  
<td>  
<input name="id_barang" id="id_barang" type="text" value="<?php echo isset($_POST['id_barang']) ? $_POST['id_barang'] : '';?>" />  
<div style="color:red"><?php echo isset($error['id_barang']) ? $error['id_barang'] : '';?></div>  
</td>
</tr>
<tr bgcolor="#0099FF">  
<td bgcolor="#00CCCC">Id Jasa  </td>  
<td>  
<input name="id_jasa" id="id_jasa" type="text" value="<?php echo isset($_POST['id_jasa']) ? $_POST['id_jasa'] : '';?>" />  
<div style="color:red"><?php echo isset($error['id_jasa']) ? $error['id_jasa'] : '';?></div>  
</td>
</tr>
<tr bgcolor="#0099FF">  
<td bgcolor="#00CCCC">Id Deposit </td>  
<td>  
<input name="id_deposit" id="id_deposit" type="text" value="<?php echo isset($_POST['id_deposit']) ? $_POST['id_deposit'] : '';?>" />  
<div style="color:red"><?php echo isset($error['id_deposit']) ? $error['id_deposit'] : '';?></div>  
</td>
</tr>
<tr bgcolor="#0099FF">  
<td bgcolor="#00CCCC">Id Order  </td>  
<td>  
<input name="id_order" id="id_order" type="text" value="<?php echo isset($_POST['id_order']) ? $_POST['id_order'] : '';?>" />  
<div style="color:red"><?php echo isset($error['id_order']) ? $error['id_order'] : '';?></div>  
</td>
</tr>
<tr bgcolor="#0099FF">  
<td bgcolor="#00CCCC">Id Transaksi  </td>  
<td>  
<input name="id_transaksi" id="id_transaksi" type="text" value="<?php echo isset($_POST['id_transaksi']) ? $_POST['id_transaksi'] : '';?>" />  
<div style="color:red"><?php echo isset($error['id_transaksi']) ? $error['id_transaksi'] : '';?></div>  
</td>
</tr>
<tr bgcolor="#0099FF">  
<td bgcolor="#00CCCC">Tanggal transaksi  </td>  
<td>  
<input name="tanggal_transaksi" id="tanggal_transaksi" type="text" value="<?php echo isset($_POST['tanggal_transaksi']) ? $_POST['tanggal_transaksi'] : '';?>" />  
<div style="color:red"><?php echo isset($error['tanggal_transaksi']) ? $error['tanggal_transaksi'] : '';?></div>  
</td>
</tr>
<tr bgcolor="#0099FF">  
<td bgcolor="#00CCCC">Jumlah transaksi  </td>  
<td>  
<input name="jumlah_transaksi" id="jumlah_transaksi" type="text" value="<?php echo isset($_POST['jumlah_transaksi']) ? $_POST['jumlah_transaksi'] : '';?>" />  
<div style="color:red"><?php echo isset($error['jumlah_transaksi']) ? $error['jumlah_transaksi'] : '';?></div>  
</td>
</tr>

<tr bgcolor="#0099FF">  
<td bgcolor="#00CCCC">Pengaduan  </td>  
<td>  
<input name="pengaduan" id="pengaduan" type="text" value="<?php echo isset($_POST['pengaduan']) ? $_POST['jpengaduan'] : '';?>" />  
<div style="color:red"><?php echo isset($error['pengaduan']) ? $error['pengaduan'] : '';?></div>  
</td>
</tr>

<td bgcolor="#00CCFF"colspan="2">  
<input name="submit" id="submit" type="Submit" value="Submit" />
</form>
</table>



  

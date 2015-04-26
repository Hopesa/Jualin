<?php
	include "connect.php";
	
	$id_user=$_POST['id_user'];
	$nama=$_POST['nama'];
	$alamat=$_POST['alamat'];
	$id_barang=$_POST['id_barang'];
	$id_jasa=$_POST['id_jasa'];
	$id_deposit=$_POST['id_deposit'];
	$id_order=$_POST['id_order'];
	$id_transaksi=$_POST['id_transaksi'];
	$tanggal_transaksi=$_POST['tanggal_transaksi'];
	$jumlah_transaksi=$_POST['jumlah_transaksi'];
	$pengaduan=$_POST['pengaduan'];
	
        if(empty($id_user) || empty($nama) || empty($alamat) || empty($id_barang) || empty($id_jasa) || empty($id_deposit) || empty($id_order) || empty($id_transaksi) || empty($tanggal_transaksi) || empty($jumlah_transaksi) || empty($pengaduan)){  
            echo "Data tidak komplit";
			echo "<a href=form.php>back</a>";
        }else{
	$sql="insert into user (id_user, nama, alamat, id_barang, id_jasa, id_deposit, id_order, id_transaksi, tanggal_transaksi, jumlah_transaksi, pengaduan) Value ('$id_user','$nama','$alamat','$id_barang','$id_jasa','$id_deposit','$id_order','$id_transaksi',' $tanggal_transaksi','$jumlah_transaksi','$pengaduan')";
 $input=mysql_query($sql);
 if($input){
	  echo "Pengaduan berhasil dikirim<a href=tampil.php> Login</a>";
 }else{
	 echo "Anda belum menyelesaikan mengisi form, silahkan<a href=form.php>Daftar Kembali</a>";
	 echo mysql_error();
 }
		}
?>>
<?php
// koneksi database
include 'koneksi.php';

// menangkap data yang di kirim dari form
$id = $_POST['id_menu'];
$nama_makanan = $_POST['nama_makanan'];
$harga = $_POST['harga'];
$filter = $_POST['filter'];
$soldout = $_POST['soldout'];

$rand = rand();
$ekstensi =  array('png','jpg','jpeg','gif');
$filename = $_FILES['foto']['name'];
$ukuran = $_FILES['foto']['size'];
$ext = pathinfo($filename, PATHINFO_EXTENSION);

		$foto = $rand.'_'.$filename;
		move_uploaded_file($_FILES['foto']['tmp_name'], 'gambar/'.$rand.'_'.$filename);
		if (empty($filename)) {
			mysqli_query($koneksi,"update menu set nama_makanan='$nama_makanan', harga='$harga', filter='$filter', soldout='$soldout' where id_menu='$id'");
			header("location:tables.php?alert=berhasil");
		}else{
			mysqli_query($koneksi,"update menu set foto='$foto', nama_makanan='$nama_makanan', harga='$harga', filter='$filter', soldout='$soldout' where id_menu='$id'");
			header("location:tables.php?alert=berhasil");
		}

		mysqli_query($koneksi,"update liked set soldout='$soldout' where nama_makanan='$nama_makanan'");

		

// mengalihkan halaman kembali ke index.php

?>
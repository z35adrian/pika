<?php

include 'koneksi.php';

// menangkap data yang di kirim dari form
if (isset($_POST['liked'])) {

	$foto = $_POST['foto'];
	$nama_makanan = $_POST['nama_makanan'];
	$harga = $_POST['harga'];
	$soldout = $_POST['soldout'];

	$select_cart = mysqli_query($koneksi, "SELECT * FROM `liked` WHERE nama_makanan = '$nama_makanan'");

	if (mysqli_num_rows($select_cart) > 0) {
		$message[] = 'product already added to cart';
	} else {
		$insert_product = mysqli_query($koneksi, "INSERT INTO `liked`(foto,nama_makanan, harga, soldout) VALUES('$foto', '$nama_makanan', '$harga', '$soldout')");
		$message[] = 'product added to cart succesfully';
	}
}

header('location:liked.php');
// menginput data ke database


// mengalihkan halaman kembali ke index.php

<?php
// mengaktifkan session pada php
session_start();

// menghubungkan php dengan koneksi database
include 'koneksi.php';

//mengambil data yang dikirim dari form sebelumnya
$username = $_POST['username'];
$password = $_POST['password'];

//mengambil data user di tabel user
$user = mysqli_query($koneksi, "select * from login where username='$username' and password='$password'");
//menghitung jumlah data
$cek = mysqli_num_rows($user);

//jika username dan password lebih besar dari 0 maka user ditemukan
if ($cek > 0) {
	$data = mysqli_fetch_assoc($user);
	//jika user adalah admin
	if ($data['level'] == 'admin') {
		//buat session username dan levelnya
		$_SESSION['username'] = $username;
		$_SESSION['level'] = 'admin';

		//arahkan user admin ke halaman admin
		header('location:admin/index.html');

		//jika user adalah ketua
	} elseif ($data['level'] == 'user') {
		//buat session username dan levelnya
		$_SESSION['username'] = $username;
		$_SESSION['level'] = 'user';

		//arahkan user ketua ke halaman ketua
		header('location:index.php');

		//jika user adalah anggota
	}
} else {
	//jika user tidak ditemukan
	header("location:login.php?pesan=gagal");
}

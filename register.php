<?php
include 'koneksi.php';

    $username = strtolower(stripslashes($_POST['username']));
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    $level = 'user';
    
    // cek username sudah ada atau belum
    include 'koneksi.php';
    

    // cek konfirmasi pasword
    if ($password !== $password2) {
        echo "<script>
                    alert('Password tidak sesuai');
                </script>";
        return false;
    }

    include 'koneksi.php';

    mysqli_query($koneksi, "insert into login values('', '$username', '$password', '$level')");
    echo "<script>
                    alert('Berhasil menambahkan user baru');
                </script>";
    header("location:login.php");
    return mysqli_affected_rows($koneksi);


?>

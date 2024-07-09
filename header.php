<?php
include 'koneksi.php';
require_once('header.php');
require_once('cart_aksi.php');
session_start();

if (isset($_POST['add_to_cart'])) {

    if (isset($_SESSION['cart'])) {

        $item_array_id = array_column($_SESSION['cart'], "id_menu");

        if (in_array($_POST['id_menu'], $item_array_id)) {
            echo "<script>alert('product sudah ditambahkan')</script>";
        } else {

            $count = count($_SESSION['cart']);
            $item_array = array(
                'id_menu' => $_POST['id_menu']
            );

            $_SESSION['cart'][$count] = $item_array;
        }
    } else {
        $item_array = array(
            'id_menu' => $_POST['id_menu']
        );

        $_SESSION['cart'][0] = $item_array;
    }
}

if (isset($_POST['remove'])) {
    if ($_GET['action'] == 'remove') {
        foreach ($_SESSION['cart'] as $key => $value) {
            if ($value['id_menu'] == $_GET['id_menu']) {
                unset($_SESSION['cart'][$key]);
                echo "<script>alert(Product berhasil di hapus)</script>";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Header</title>
</head>

<body>

</body>

</html>

<header>
    <a href="#" class="logo"><i class="fas fa-utensils"></i>PIKA.</a>

    <nav class="navbar">
        <a href="index.php#home" class="active text-decoration-none">home</a>
        <a href="index.php#dishes" class="text-decoration-none">Menu</a>
        <a href="index.php#about" class="text-decoration-none">about</a>
        <a href="index.php#review" class="text-decoration-none">review</a>
    </nav>

    <div class="icons">
        <i class="fas fa-bars" id="menu-bars"></i>
        <i id="search-icon"></i>
        
        <?php
            if (isset($_SESSION['username'])) {
                echo '<a href="liked.php" class="fas fa-heart text-decoration-none"></a>';
            }else {
                echo '<a href="login.php" class="fas fa-heart text-decoration-none"></a>';
            }
        ?>
        
        <a onclick="toggleCart()" class="fas fa-shopping-cart">



            <?php

            include 'koneksi.php';

            $data = mysqli_query($koneksi, 'select * from cart');
            $jumlah = mysqli_num_rows($data);
            echo "<span id='jumlah' class='totalQuantity'>$jumlah</span>";
            ?>

            <div class="iconCart" onclick="toggleCart()">

            </div>
        </a>

        <div class="cart" id="cart">
            <h2>
                CART
            </h2>
            <div class="listCart">
                <?php
                include 'koneksi.php';
                $data = mysqli_query($koneksi, "select * from cart");
                $cek2 = mysqli_num_rows($data);
                $counter = 01;

                if ($cek2 > 0) {
                    while ($d = mysqli_fetch_assoc($data)) {
                        $id = $d['id'];
                        $nama = $d['name'];
                        $harga = $d['price'];
                        $gambar = $d['image'];
                        $quantity = $d['quantity'];

                ?>

                        <div class="item" id="item<?php echo $counter; ?>">
                            <img src="admin/gambar/<?php echo $gambar; ?>">
                            <div class="content">
                                <div class="name"><?php echo $nama; ?></div>
                                <div class="price">Rp. <?php echo number_format($harga); ?></div>
                            </div>
                            <div class="quantity">

                                <!-- Gunakan pengidentifikasi unik untuk setiap elemen terkait kuantitas -->
                                <span class="minus" style="cursor: pointer;">-</span>
                                <span class="num" style="margin-left: 0.5rem; margin-right:0.5rem;" id="num<?php echo $counter; ?>"><?php echo $quantity ?></span>
                                <span class="plus" style="cursor: pointer; margin-right:100%;">+</span>

                                <form action="" method="post">
                                    <button style="background-color:black;color:white; height:1.7rem; width:1.8rem" class="fa-solid fa-trash-can" onclick="deleteItem(<?php echo $counter; ?>, '<?php echo $nama; ?>')"></button>
                                </form>
                            </div>
                            <script>
                                var plus_<?php echo $counter; ?> = document.querySelector("#item<?php echo $counter; ?> .plus"),
                                    minus_<?php echo $counter; ?> = document.querySelector("#item<?php echo $counter; ?> .minus"),
                                    num_<?php echo $counter; ?> = document.querySelector("#item<?php echo $counter; ?> .num");

                                let a_<?php echo $counter; ?> = 1;

                                plus_<?php echo $counter; ?>.addEventListener("click", () => {
                                    a_<?php echo $counter; ?>++;
                                    a_<?php echo $counter; ?> = (a_<?php echo $counter; ?> < 10) ? a_<?php echo $counter; ?> : a_<?php echo $counter; ?>;
                                    num_<?php echo $counter; ?>.innerText = a_<?php echo $counter; ?>;
                                    updateQuantity(<?php echo $counter; ?>, '<?php echo $nama; ?>', a_<?php echo $counter; ?>); // Pemanggilan updateQuantity
                                });

                                minus_<?php echo $counter; ?>.addEventListener("click", () => {
                                    if (a_<?php echo $counter; ?> > 1) {
                                        a_<?php echo $counter; ?>--;
                                        a_<?php echo $counter; ?> = (a_<?php echo $counter; ?> < 10) ? a_<?php echo $counter; ?> : a_<?php echo $counter; ?>;
                                        num_<?php echo $counter; ?>.innerText = a_<?php echo $counter; ?>;
                                        updateQuantity(<?php echo $counter; ?>, '<?php echo $nama; ?>', a_<?php echo $counter; ?>); // Pemanggilan updateQuantity
                                    }
                                });

                                function deleteItem(counter, nama) {
                                    var item = document.querySelector("#item" + counter);

                                    // Kirim permintaan AJAX ke server untuk menghapus data dari database
                                    var xhr = new XMLHttpRequest();
                                    xhr.onreadystatechange = function() {
                                        if (xhr.readyState === XMLHttpRequest.DONE) {
                                            if (xhr.status === 200) {
                                                // Hapus elemen item dari DOM jika penghapusan dari database berhasil
                                                item.parentNode.removeChild(item);
                                                console.log("Item " + counter + " dihapus dari database dan DOM");
                                            } else {
                                                console.error("Gagal menghapus item dari database");
                                            }
                                        }
                                    };

                                    xhr.open("POST", "hapus_item.php", true);
                                    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                                    xhr.send("nama=" + encodeURIComponent(nama));
                                }

                                function updateQuantity(counter, nama, quantity) {
                                    // Kirim permintaan AJAX ke server untuk mengupdate data di database
                                    var xhr = new XMLHttpRequest();
                                    xhr.onreadystatechange = function() {
                                        if (xhr.readyState === XMLHttpRequest.DONE) {
                                            if (xhr.status === 200) {
                                                // Update nilai quantity di DOM jika pengubahan quantity di database berhasil
                                                var num = document.querySelector("#item" + counter + " .num");
                                                num.innerText = quantity;
                                                console.log("Quantity untuk item " + counter + " diupdate menjadi " + quantity);
                                            } else {
                                                console.error("Gagal mengupdate quantity di database");
                                            }
                                        }
                                    };

                                    xhr.open("POST", "update_quantity.php", true);
                                    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                                    xhr.send("nama=" + encodeURIComponent(nama) + "&quantity=" + encodeURIComponent(quantity));
                                }
                            </script>

                        </div>
                <?php
                        $counter++;  // Tingkatkan penghitung untuk item selanjutnya
                    }
                }
                ?>
            </div>

            <div class="buttons">
                <div class="close" onclick="closeCart()">
                    CLOSE
                </div>
                <div class="checkout">
                    <a href="checkout.php" class="chk">CHECKOUT</a>
                </div>
            </div>
        </div>

        <script>
            function toggleCart() {
                var cartSidebar = document.getElementById('cart');
                cartSidebar.style.right = (cartSidebar.style.right === '0px') ? '-300px' : '0px';
            }

            let iconCart = document.querySelector('.iconCart');
            let cart = document.querySelector('.cart');
            let container = document.querySelector('.container');
            let close = document.querySelector('.close');

            iconCart.addEventListener('click', function() {
                if (cart.style.right == '-300px') {
                    cart.style.right = '0';
                    container.style.transform = 'translateX(-400px)';
                } else {
                    cart.style.right = '-100%';
                    container.style.transform = 'translateX(0)';
                }
            });
            close.addEventListener('click', function() {
                cart.style.right = '-100%';
                container.style.transform = 'translateX(0)';
            });
        </script>

        <div class="dropdown">
            <i class="dropbtn fa-solid fa-user"></i>
            <div id="myDropdown" class="dropdown-content">

                <?php
                if (isset($_SESSION['username'])) {
                    // Jika sudah login, tampilkan tombol logout
                    echo '<form action="logout.php" method="post">
                    <input type="submit" value="Logout">
                </form>';
                } else {
                    // Jika belum login, tampilkan tombol login
                    echo '<form action="login.php" method="post">
                    <input type="submit" value="Login">
                </form>';
                }
                ?>
                <!-- </a> -->
            </div>
            </a>
        </div>
</header>
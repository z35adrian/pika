<?php

include 'koneksi.php';
require_once('header.php');

$img = mysqli_query($koneksi, "select * from menu");
$a = mysqli_fetch_array($img);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="styles/style.css">
    <title>Liked</title>
</head>

<body style="margin-top: 4.5rem;">

    <section class="dishes" id="dishes">
        <h3 class="sub-heading">our dishes</h3>
        <h1 class="heading">Liked dishes</h1>

        <div class="box-container">

            <?php

            include 'koneksi.php';

            $select_cart = mysqli_query($koneksi, "SELECT * FROM `liked` where soldout='yes'");
            $grand_total = 0;
            if (mysqli_num_rows($select_cart) > 0) {
                while ($d = mysqli_fetch_assoc($select_cart)) {
            ?>

                    <div class="box" style="filter: grayscale(100%);">
                        <h2 id="soldout">SOLD OUT</h2>
                        <img src="admin/gambar/<?php echo $d['foto']; ?>" alt="">

                        <h3> <?php echo $d['nama_makanan']; ?></h3>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <span>Rp. <?php echo $d['harga']; ?></span>
                        <!-- <input type="submit" class="btn" name="add_to_cart" value="add to cart"> -->
                        <input type="hidden" name="id_menu" value='<?= $d['id_menu'] ?>'>
                        <button type="submit" class="btn" name="add_to_cart">add to cart</button>

                    </div>

            <?php
                }
            }
            ?>

            <?php
            include 'koneksi.php';

            $select_cart = mysqli_query($koneksi, "SELECT * FROM `liked` where soldout='no'");
            $grand_total = 0;
            if (mysqli_num_rows($select_cart) > 0) {
                while ($d = mysqli_fetch_assoc($select_cart)) {
            ?>
                    <div class="box">
                        <form method="post" action="cart.php">
                            <a href="hapus_like.php?id_menu=<?php echo $d['id_menu']; ?>" class="fas fa-heart"></a>
                            <img src="admin/gambar/<?php echo $d['foto']; ?>" alt="">
                            <h3> <?php echo $d['nama_makanan']; ?></h3>
                            <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <span>Rp. <?php echo $d['harga']; ?></span>
                            <!-- <input type="submit" class="btn" name="add_to_cart" value="add to cart"> -->
                            <input type="hidden" name="id_menu" value='<?= $d['id_menu'] ?>'>
                            <button type="submit" class="btn" name="add_to_cart">add to cart</button>
                        </form>
                    </div>





            <?php
                }
            }
            ?>




        </div>
    </section>
</body>

</html>
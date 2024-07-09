<?php

include 'koneksi.php';

if (isset($_POST['add_to_cart'])) {

    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = 1;

    $select_cart = mysqli_query($koneksi, "SELECT * FROM `cart` WHERE name = '$product_name'");

    if (mysqli_num_rows($select_cart) > 0) {
        $message[] = 'product already added to cart';
    } else {
        $insert_product = mysqli_query($koneksi, "INSERT INTO `cart`(name, price, image, quantity) VALUES('$product_name', '$product_price', '$product_image', '$product_quantity')");
        $message[] = 'product added to cart succesfully';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- css -->
    <link rel="stylesheet" href="styles/style.css">
    <title>PIKA</title>

    <!-- swaper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

    <!-- swaper -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

</head>

<body>

    <!-- header section starts -->
    <?php
    require_once('header.php');
    ?>
    <!-- header section ends -->
    <div class="container">

        <form action="" id="search-form">
            <input type="search" placeholder="search here.." id="search-box">
            <label for="search-box" class="fas fa-search"></label>
            <i class="fas fa-times" id="close"></i>
        </form>

        <!-- home section start -->

        <section class="home" id="home">

            <div class="swiper mySwiper home-slider">

                <div class="swiper-wrapper wrapper">

                    <div class="swiper-slide slide">
                        <div class="content">
                            <span>menu special</span>
                            <h3>Nasi Goreng</h3>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti dolorum quasi ab cumqu</p>
                            <a href="#" class="btn">order disini</a>
                        </div>
                        <div class="image">
                            <img src="images/nasigoreng.png" alt="">
                        </div>
                    </div>

                    <div class="swiper-slide slide">
                        <div class="content">
                            <span>menu special</span>
                            <h3>Nasi Goreng</h3>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti dolorum quasi ab cumqu</p>
                            <a href="#" class="btn">order disini</a>
                        </div>
                        <div class="image">
                            <img src="images/nasigoreng.png" alt="">
                        </div>
                    </div>

                    <div class="swiper-slide slide">
                        <div class="content">
                            <span>menu special</span>
                            <h3>Nasi Goreng</h3>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti dolorum quasi ab cumqu</p>
                            <a href="#" class="btn">order disini</a>
                        </div>
                        <div class="image">
                            <img src="images/nasigoreng.png" alt="">
                        </div>
                    </div>

                </div>

                <div class="swiper-pagination"></div>

            </div>

        </section>

        <!-- home section ends -->

        <!-- dishes section start -->
        <section class="dishes" id="dishes">
            <h3 class="sub-heading">our dishes</h3>
            <h1 class="heading">popular dishes</h1>

            <div class="box-container">

                <?php

                include 'koneksi.php';

                $details = mysqli_query($koneksi, "select * from menu where soldout='yes'");
                $cek = mysqli_num_rows($details);

                if ($cek > 0) {
                    while ($d = mysqli_fetch_assoc($details)) {
                        $id_menu = $d['id_menu'];
                        $nama_makanan = $d['nama_makanan'];
                        $harga = $d['harga'];
                        $foto = $d['foto'];
                ?>

                        <div class="box" style="filter: grayscale(100%);">
                            <?php
                            if ($foto == "") {
                                echo "<div>Gambar tidak tersedia</div>";
                            } else {
                            ?>
                                <h2 id="soldout">SOLD OUT</h2>
                                <img src="admin/gambar/<?php echo $foto ?>" alt="">
                            <?php
                            }
                            ?>
                            <h3> <?php echo $nama_makanan; ?></h3>
                            <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <span>Rp. <?php echo $harga; ?></span>
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

                $details = mysqli_query($koneksi, "select * from menu where soldout='no'");
                $cek = mysqli_num_rows($details);

                if ($cek > 0) {
                    while ($d = mysqli_fetch_assoc($details)) {
                        $id_menu = $d['id_menu'];
                        $nama_makanan = $d['nama_makanan'];
                        $harga = $d['harga'];
                        $foto = $d['foto'];
                        $soldout = $d['soldout'];
                ?>
                        <div class="box">
                            <form action="liked_aksi.php" method="post">
                                <input type="hidden" value="<?= $d['id_menu'] ?>" name='id_menu'>
                                <input type="hidden" value="<?php echo $d['foto']; ?>" name='foto'>
                                <input type="hidden" value="<?php echo $d['nama_makanan'] ?>" name='nama_makanan'>
                                <input type="hidden" value="<?php echo $d['harga'] ?>" name='harga'>
                                <input type="hidden" value="<?php echo $d['soldout'] ?>" name='soldout'>
                                <?php
                                if (isset($_SESSION['username'])) {
                                    echo '<button type="submit" name="liked" class="fas fa-heart"></button>';
                                } else {
                                    echo '<a href="login.php" class="fas fa-heart"></a>';
                                }
                                ?>
                            </form>
                            <form method="post" action="">
                                <?php
                                if ($foto == "") {
                                    echo "<div>Gambar tidak tersedia</div>";
                                } else {
                                ?>
                                    <img src="admin/gambar/<?php echo $foto ?>" alt="">
                                <?php
                                }
                                ?>
                                <h3> <?php echo $nama_makanan; ?></h3>
                                <div class="stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                                <span>Rp. <?php echo $harga; ?></span>

                                <input type="hidden" value="<?php echo $d['foto']; ?>" name='product_image'>
                                <input type="hidden" value="<?php echo $d['nama_makanan'] ?>" name='product_name'>
                                <input type="hidden" value="<?php echo $d['harga'] ?>" name='product_price'>
                                <?php
                                if (isset($_SESSION['username'])) {

                                    echo '<button type="submit" class="btn" name="add_to_cart">add to cart</button>';
                                } else {

                                    echo '<a href="login.php" class="btn" name="add_to_cart">add to cart</a>';
                                }


                                ?>
                            </form>
                        </div>





                <?php
                    }
                }

                ?>




            </div>
        </section>

        <!-- dishes section ends -->

        <!-- about section starts -->

        <section class="about" id="about">

            <h3 class="sub-heading"> about us </h3>
            <h1 class="heading"> why choose us? </h1>

            <div class="row">

                <div class="image">
                    <img src="images/food.png" alt="">
                </div>

                <div class="content">
                    <h3>best food in PI school</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat ut exercitationem quia quasi, cumque
                        adipisci a facere aperiam. Molestias ipsam esse veniam est inventore ea nesciunt porro magni rerum
                        sint.</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi, quo earum dolore nulla est eius ipsa
                        optio cumque similique ipsum!</p>
                    <div class="icons-container">
                        <div class="icons">
                            <i class="fas fa-shipping-fast"></i>
                            <span>free delivery</span>
                        </div>
                        <div class="icons">
                            <i class="fas fa-dollar-sign"></i>
                            <span>easy payment</span>
                        </div>
                        <div class="icons">
                            <i class="fas fa-headset"></i>
                            <span>24/7 service</span>
                        </div>
                    </div>
                    <a href="#" class="btn">learn more</a>
                </div>

            </div>

        </section>

        <!-- about section ends -->

        <!-- menu section starts -->

        <!-- <section class="menu" id="menu">

            <h3 class="sub-heading"> our menu </h3>
            <h1 class="heading"> today's speciality </h1>

            <div class="box-container">

                <div class="box">
                    <div class="image">
                        <img src="images/pizza1.jpg" alt="">
                        <a href="#" class="fas fa-heart"></a>
                    </div>
                    <div class="content">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <h3>delicius food</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe, non?</p>
                        <a href="#" class="btn">add to cart</a>
                        <span class="price">Rp.20,000</span>
                    </div>

                </div>

                <div class="box">
                    <div class="image">
                        <img src="images/pizza1.jpg" alt="">
                        <a href="#" class="fas fa-heart"></a>
                    </div>
                    <div class="content">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <h3>delicius food</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe, non?</p>
                        <a href="#" class="btn">add to cart</a>
                        <span class="price">Rp.20,000</span>
                    </div>

                </div>

                <div class="box">
                    <div class="image">
                        <img src="images/pizza1.jpg" alt="">
                        <a href="#" class="fas fa-heart"></a>
                    </div>
                    <div class="content">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <h3>delicius food</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe, non?</p>
                        <a href="#" class="btn">add to cart</a>
                        <span class="price">Rp.20,000</span>
                    </div>

                </div>

                <div class="box">
                    <div class="image">
                        <img src="images/pizza1.jpg" alt="">
                        <a href="#" class="fas fa-heart"></a>
                    </div>
                    <div class="content">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <h3>delicius food</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe, non?</p>
                        <a href="#" class="btn">add to cart</a>
                        <span class="price">Rp.20,000</span>
                    </div>

                </div>

                <div class="box">
                    <div class="image">
                        <img src="images/pizza1.jpg" alt="">
                        <a href="#" class="fas fa-heart"></a>
                    </div>
                    <div class="content">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <h3>delicius food</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe, non?</p>
                        <a href="#" class="btn">add to cart</a>
                        <span class="price">Rp.20,000</span>
                    </div>

                </div>

                <div class="box">
                    <div class="image">
                        <img src="images/pizza1.jpg" alt="">
                        <a href="#" class="fas fa-heart"></a>
                    </div>
                    <div class="content">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <h3>delicius food</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe, non?</p>
                        <a href="#" class="btn">add to cart</a>
                        <span class="price">Rp.20,000</span>
                    </div>

                </div>

                <div class="box">
                    <div class="image">
                        <img src="images/pizza1.jpg" alt="">
                        <a href="#" class="fas fa-heart"></a>
                    </div>
                    <div class="content">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <h3>delicius food</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe, non?</p>
                        <a href="#" class="btn">add to cart</a>
                        <span class="price">Rp.20,000</span>
                    </div>

                </div>

                <div class="box">
                    <div class="image">
                        <img src="images/pizza1.jpg" alt="">
                        <a href="#" class="fas fa-heart"></a>
                    </div>
                    <div class="content">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <h3>delicius food</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe, non?</p>
                        <a href="#" class="btn">add to cart</a>
                        <span class="price">Rp.20,000</span>
                    </div>

                </div>

                <div class="box">
                    <div class="image">
                        <img src="images/pizza1.jpg" alt="">
                        <a href="#" class="fas fa-heart"></a>
                    </div>
                    <div class="content">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <h3>delicius food</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe, non?</p>
                        <a href="#" class="btn">add to cart</a>
                        <span class="price">Rp.20,000</span>
                    </div>

                </div>

            </div>

        </section> -->

        <!-- menu section ends -->

        <!-- review section starts -->

        

        <!-- cart section start -->

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
                                    <button style="z-index:10000" class="fa-solid fa-trash" onclick="deleteItem(<?php echo $counter; ?>, '<?php echo $nama; ?>')"></button>
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
                    <a href="checkout.php">CHECKOUT</a>
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
            let close = document.querySelector('.close'); // Declare the 'close' variable

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

            function closeCart() {
                let cart = document.querySelector('.cart');
                console.log('Close button clicked');
                let container = document.querySelector('.container');

                cart.style.right = '-100%';
                container.style.transform = 'translateX(0)';
            }

            document.addEventListener('DOMContentLoaded', function() {
                // Pastikan kodenya di sini atau letakkan di akhir file sebelum </body>
                let close = document.querySelector('.close');
                close.addEventListener('click', closeCart);
            });
        </script>


        <!-- footer section start -->

        <section class="footer">

            <div class="box-container">

                <div class="box">
                    <h3>locations</h3>
                    <a href="#">india</a>
                    <a href="#">indonesia</a>
                    <a href="#">amerika</a>
                    <a href="#">rusia</a>
                    <a href="#">japan</a>
                </div>

                <div class="box">
                    <h3>quick links</h3>
                    <a href="#">home</a>
                    <a href="#">dishes</a>
                    <a href="#">about</a>
                    <a href="#">review</a>
                    <a href="#">order</a>
                </div>

                <div class="box">
                    <h3>contact info</h3>
                    <a href="#">+123-456-7890</a>
                    <a href="#">+111-222-3333</a>
                    <a href="#">ztefanus.35@gmail.com</a>
                    <a href="#">bandung, indonesia</a>
                </div>

                <div class="box">
                    <h3>follow us</h3>
                    <a href="#">facebook</a>
                    <a href="#">twitter</a>
                    <a href="#">instagram</a>
                    <a href="#">linkedin</a>
                </div>

            </div>

            <div class="credit"> copyright @ 2023 by <span>Arka Ramadhan</span> </div>

        </section>
    </div>
    <!-- footer section ends -->

    <!-- loader part -->
    <!-- <div class="loader-container">
        <img src="images/Bean Eater-1s-200px.gif" alt="">
    </div> -->

    <!-- java script -->
    <script src="js/script.js"></script>



</body>

</html>
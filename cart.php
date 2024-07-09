<?php

include 'koneksi.php';

if (isset($_POST['update_update_btn'])) {
    $update_value = $_POST['update_quantity'];
    $update_id = $_POST['update_quantity_id'];
    $update_quantity_query = mysqli_query($koneksi, "UPDATE `cart` SET quantity = '$update_value' WHERE id = '$update_id'");
    if ($update_quantity_query) {
        header('location:cart.php');
    };
};

if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    mysqli_query($koneksi, "DELETE FROM `cart` WHERE id = '$remove_id'");
    header('location:cart.php');
};

if (isset($_GET['delete_all'])) {
    mysqli_query($koneksi, "DELETE FROM `cart`");
    header('location:cart.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        :root {
            --blue: #2980b9;
            --red: #27ae60;
            --orange: orange;
            --black: #333;
            --white: #fff;
            --bg-color: #eee;
            --dark-bg: rgba(0, 0, 0, .7);
            --box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .1);
            --border: .1rem solid #999;
        }

        .shopping-cart table {
            text-align: center;
            width: 100%;
        }

        .shopping-cart table thead th {
            padding: 1.5rem;
            font-size: 2rem;
            color: var(--white);
            background-color: var(--black);
        }

        .shopping-cart table tr td {
            border-bottom: var(--border);
            padding: 1.5rem;
            font-size: 2rem;
            color: var(--black);
        }

        .shopping-cart table input[type="number"] {
            border: var(--border);
            padding: 1rem 2rem;
            font-size: 2rem;
            color: var(--black);
            width: 10rem;
        }

        .shopping-cart table input[type="submit"] {
            padding: .5rem 1.5rem;
            cursor: pointer;
            font-size: 2rem;
            background-color: var(--orange);
            color: var(--white);
        }

        .shopping-cart table input[type="submit"]:hover {
            background-color: var(--black);
        }

        .shopping-cart table .table-bottom {
            background-color: var(--bg-color);
        }

        .shopping-cart .checkout-btn {
            text-align: center;
            margin-top: 1rem;
        }

        .shopping-cart .checkout-btn a {
            display: inline-block;
            width: auto;
        }

        .shopping-cart .checkout-btn a.disabled {
            pointer-events: none;
            opacity: .5;
            user-select: none;
            background-color: var(--red);
        }

        .btn,
        .option-btn,
        .delete-btn {
            display: block;
            width: 100%;
            text-align: center;
            background-color: var(--blue);
            color: var(--white);
            font-size: 1.7rem;
            padding: 1.2rem 3rem;
            border-radius: .5rem;
            cursor: pointer;
            margin-top: 1rem;
        }

        .btn:hover,
        .option-btn:hover,
        .delete-btn:hover {
            background-color: var(--black);
        }

        .option-btn i,
        .delete-btn i {
            padding-right: .5rem;
        }

        .option-btn {
            background-color: var(--orange);
        }

        .delete-btn {
            margin-top: 0;
            background-color: red;
        }
    </style>
    <title>Document</title>
</head>

<body style="margin-top: 9rem;">

    <?php include 'header.php'; ?>

    <div class="container">

        <section class="shopping-cart">

            <h1 class="heading">shopping cart</h1>

            <table>

                <thead>
                    <th>image</th>
                    <th>name</th>
                    <th>price</th>
                    <th>quantity</th>
                    <th>total price</th>
                    <th>action</th>
                </thead>

                <tbody>

                    <?php

                    $select_cart = mysqli_query($koneksi, "SELECT * FROM `cart`");
                    number_format($grand_total = 0);
                    if (mysqli_num_rows($select_cart) > 0) {
                        while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                    ?>

                            <tr>
                                <td><img height="100" alt="" src="admin/gambar/<?php echo $fetch_cart['image']; ?>"></td>
                                <td><?php echo $fetch_cart['name']; ?></td>
                                <td>Rp. <?php echo number_format($fetch_cart['price']); ?></td>
                                <td>
                                    <form action="" method="post">
                                        <input type="hidden" name="update_quantity_id" value="<?php echo $fetch_cart['id']; ?>">
                                        <input type="number" name="update_quantity" min="1" value="<?php echo $fetch_cart['quantity']; ?>">
                                        <input type="submit" value="update" name="update_update_btn">
                                    </form>
                                </td>
                                <td>Rp. <?php echo $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?></td>
                                <td><a href="cart.php?remove=<?php echo $fetch_cart['id']; ?>" onclick="return confirm('remove item from cart?')" class="delete-btn"> <i class="fas fa-trash"></i> remove</a></td>
                            </tr>
                    <?php
                            number_format((int)$grand_total += (int)$sub_total);
                        };
                    };
                    ?>
                    <tr class="table-bottom">
                        <td><a href="index.php" class="option-btn" style="margin-top: 0;">continue shopping</a></td>
                        <td colspan="3">grand total</td>
                        <td>Rp. <?php echo number_format($grand_total); ?></td>
                        <td><a href="cart.php?delete_all" onclick="return confirm('are you sure you want to delete all?');" class="delete-btn"> <i class="fas fa-trash"></i> delete all </a></td>
                    </tr>

                </tbody>

            </table>

            <div class="checkout-btn">
                <a href="checkout.php" class="btn <?= ($grand_total > 1) ? '' : 'disabled'; ?>">procced to checkout</a>
            </div>

        </section>

    </div>

    <!-- custom js file link 
    <script src="js/script.js"></script> -->

</body>
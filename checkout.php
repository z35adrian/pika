<?php
include 'header.php';
include 'koneksi.php';

if (isset($_POST['order_btn'])) {

	$nama = $_POST['nama'];
	$kelas = $_POST['kelas'];
	$notelp = $_POST['notelp'];
	$tanggal = $_POST['tanggal'];
	$komen = $_POST['komen'];
	$message = $_POST['message'];

	$cart_query = mysqli_query($koneksi, "SELECT * FROM `cart`");
	$price_total = 0;
	if (mysqli_num_rows($cart_query) > 0) {
		while ($product_item = mysqli_fetch_assoc($cart_query)) {
			$product_name = $product_item['name'];
			$quantity = $product_item['quantity'];
			$product_price = ($product_item['price'] * $product_item['quantity']);
			$price_total += $product_price;

			$total_products[] = $product_name . '(' . $quantity . ')';
		};
	};

	$total_product = implode(', ', $total_products);
	$detail_query = mysqli_query($koneksi, "INSERT INTO `transaksi`(nama_makanan,harga,nama,kelas,notelp,tanggal,komen,message) VALUES('$total_product','$price_total','$nama','$kelas','$notelp','$tanggal','$komen','$message')") or die('query failed');

	if ($cart_query && $detail_query) {
		echo "
		<div class='order-message-container'>
		<div class='message-container'>
		    <h3>thank you for shopping!</h3>
		    <div class='order-detail'>
		    <span>" . $total_product . "</span>
			<span class='total'> total : Rp." . $price_total . "  </span>
		    </div>
		    <div class='customer-details'>
			    <p> your name : <span>" . $nama . "</span> </p>
			    <p> your number : <span>" . $notelp . "</span> </p>
			    <p> your email : <span>" . $tanggal . "</span> </p>
			    <p> your address : <span>" . $message . "</span> </p>
		    </div>
			    <a href='index.php' class='btn'>continue shopping</a>
		    </div>
		</div>
		";
	}
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
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

		.display-order {
			max-width: 50rem;
			background-color: var(--white);
			border-radius: .5rem;
			text-align: center;
			padding: 1.5rem;
			margin: 0 auto;
			margin-bottom: 2rem;
			box-shadow: var(--box-shadow);
			border: var(--border);
		}

		.display-order span {
			display: inline-block;
			border-radius: .5rem;
			background-color: var(--bg-color);
			padding: .5rem 1.5rem;
			font-size: 2rem;
			color: var(--black);
			margin: .5rem;
		}

		.display-order span.grand-total {
			width: 100%;
			background-color: var(--red);
			color: var(--white);
			padding: 1rem;
			margin-top: 1rem;
		}

		.order-message-container {
			position: fixed;
			top: 0;
			left: 0;
			height: 100vh;
			overflow-y: scroll;
			overflow-x: hidden;
			padding: 2rem;
			display: flex;
			align-items: center;
			justify-content: center;
			z-index: 1100;
			background-color: var(--dark-bg);
			width: 100%;
		}

		.order-message-container::-webkit-scrollbar {
			width: 1rem;
		}

		.order-message-container::-webkit-scrollbar-track {
			background-color: var(--dark-bg);
		}

		.order-message-container::-webkit-scrollbar-thumb {
			background-color: var(--blue);
		}

		.order-message-container .message-container {
			width: 50rem;
			background-color: var(--white);
			border-radius: .5rem;
			padding: 2rem;
			text-align: center;
		}

		.order-message-container .message-container h3 {
			font-size: 2.5rem;
			color: var(--black);
		}

		.order-message-container .message-container .order-detail {
			background-color: var(--bg-color);
			border-radius: .5rem;
			padding: 1rem;
			margin: 1rem 0;
		}

		.order-message-container .message-container .order-detail span {
			background-color: var(--white);
			border-radius: .5rem;
			color: var(--black);
			font-size: 2rem;
			display: inline-block;
			padding: 1rem 1.5rem;
			margin: 1rem;
		}

		.order-message-container .message-container .order-detail span.total {
			display: block;
			background: var(--red);
			color: var(--white);
		}

		.order-message-container .message-container .customer-details {
			margin: 1.5rem 0;
		}

		.order-message-container .message-container .customer-details p {
			padding: 1rem 0;
			font-size: 2rem;
			color: var(--black);
		}

		.order-message-container .message-container .customer-details p span {
			color: var(--blue);
			padding: 0 .5rem;
			text-transform: none;
		}
	</style>
</head>

<body style="margin-top: 7rem;">
	<section class="order" id="order">

		<h3 class="sub-heading"> order now </h3>
		<h1 class="heading"> free and fast </h1>

		<form action="" method="post">




			<div class="display-order">
				<?php
				$select_cart = mysqli_query($koneksi, "SELECT * FROM `cart`");
				$total = 0;
				$grand_total = 0;
				if (mysqli_num_rows($select_cart) > 0) {
					while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
						$total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
						$grand_total = $total += $total_price;
				?>
						<span><?= $fetch_cart['name']; ?>(<?= $fetch_cart['quantity']; ?>)</span>
				<?php
					}
				} else {
					echo "<div class='display-order'><span>your cart is empty!</span></div>";
				}
				?>
				<span class="grand-total"> grand total : Rp.<?= number_format($grand_total); ?> </span>
			</div>



			<div class="inputBox">
				<div class="input">
					<span>your name</span>
					<input type="text" name="nama" placeholder="enter your name" required>
				</div>
				<div class="input">
					<span>your class</span>
					<input type="text" name="kelas" placeholder="enter your class" required>
				</div>
			</div>

			<div class="inputBox">
				<div class="input">
					<span>your number</span>
					<input type="number" name="notelp" placeholder="enter your number" required>
				</div>
				<div class="input">
					<span>date and time</span>
					<input type="datetime-local" name='tanggal' required>
				</div>
			</div>

			<div class="inputBox">
				<div class="input">
					<span>your comment</span>
					<textarea name="komen" id="" placeholder="enter your comment" cols="30" rows="10" required></textarea>
				</div>
				<div class="input">
					<span>your message</span>
					<textarea name="message" id="" placeholder="enter your message" cols="30" rows="10" required></textarea>
				</div>
			</div>

			<input type="submit" value="order now" class="btn" name='order_btn'>

		</form>

	</section>
</body>

</html>
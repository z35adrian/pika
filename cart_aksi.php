<head>
    <style>
        .productname{
            margin-top: 2rem;
        }
    </style>
</head>
<?php

include 'koneksi.php';

function cartElement($productimg, $productname,$productprice,$id_menu){
    $element = "
    
    <form action='cart.php?action=remove&id_menu=$id_menu' method='post' class='cart-item mt-0'>
    <div class='border rounded'>
        <div class='row bg-white'>
            <div class='col-md-3 pl-0'>
                <img src='admin/gambar/$productimg' class='img-fluid'>
            </div>
            <div class='col-md-6 productname' style='margin-top: 2rem;'>
                <h5 class='pt-2'>$productname</h5>
                <small class='text-secondary'>Seller:Arkha Ramadhan</small>
                <h5 class='pt-2'>Rp.$productprice</h5>
                <button type='submit' class='btn btn-danger mx-2' name='remove'>REMOVE</button>
            </div>
            <div class='col-md-3 py-5'>
                <div>
                    <button type='button' class='btn bg-light border rounded-circle' style='margin-top: 2rem;'><i class='fas fa-minus'></i></button>
                    <input type='text' value='1' class='form-control w-25 d-inline' style='margin-top: 2rem;'>
                    <button type='button' class='btn bg-light border rounded-circle' style='margin-top: 2rem;'><i class='fas fa-plus'></i></button>
                </div>
            </div>
        </div>
    </div>
</form>

    ";
    echo $element;
}

?>
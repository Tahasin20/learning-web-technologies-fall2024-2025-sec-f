<?php
include('../model/userModel.php');
session_start();

$customerId = $_SESSION['customer_id'];
$wishlistItems = getWishlist($customerId);

foreach ($wishlistItems as $item) {
    echo "
    <li>
        <img src='{$item['image_url']}' alt='Product Image' width='100' height='100' />
        <p>Product Name: {$item['product_name']}</p>
        <p>Price: {$item['price']}</p>
        <form method='post' action='addToCart.php'>
            <input type='hidden' name='product_id' value='{$item['id']}' />
            <button type='submit'>Add to Cart</button>
        </form>
        <form method='post' action='removeWishlist.php'>
            <input type='hidden' name='wishlist_id' value='{$item['id']}' />
            <button type='submit'>Remove</button>
        </form>
    </li>";
}
?>

<?php
include('../model/userModel.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $wishlistId = $_POST['wishlist_id'];

    if (removeFromWishlist($wishlistId)) {
        echo "Product removed from wishlist.";
    } else {
        echo "Failed to remove product.";
    }
}
?>

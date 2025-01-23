<?php
include('../model/userModel.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customerId = $_SESSION['customer_id']; // Assuming session stores customer ID
    $productId = $_POST['product_id'];

    if (addToWishlist($customerId, $productId)) {
        echo "Product added to wishlist!";
    } else {
        echo "Failed to add product.";
    }
}
?>

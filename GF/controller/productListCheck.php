<?php
    session_start();
    require_once('../model/userModel.php'); 

    if (isset($_POST['submit'])) {

        $product_name = trim($_POST['product_name']);
        $description = trim($_POST['description']);
        $price = trim($_POST['price']);
        $category = $_POST['category'];
        $quantity = trim($_POST['quantity']);
        $createdAt = $_POST['createdAt'];
        $product_image = $_FILES['product_image'];
        $active_at = $_POST['active'];

        
        if (empty($product_name) || empty($description) || empty($price) || empty($category) || empty($quantity) || empty($createdAt)) {
            echo "All fields are required!";
        } else if (!is_numeric($price) || $price <= 0) {
            echo "Price must be a positive number!";
        } else if (!is_numeric($quantity) || $quantity < 0) {
            echo "Quantity must be a non-negative number!";
        } else {
            
            $image_name = $product_image['name'];
            $image_tmp_name = $product_image['tmp_name'];
            $image_size = $product_image['size'];
            $image_error = $product_image['error'];

            if ($image_error === 0) {
                $image_ext = pathinfo($image_name, PATHINFO_EXTENSION);
                $allowed_exts = ['jpg', 'jpeg', 'png', 'gif'];

                if (in_array(strtolower($image_ext), $allowed_exts)) {
                    if ($image_size < 5000000) { 
                        $new_image_name = uniqid("IMG_", true) . '.' . $image_ext;
                        $image_upload_path = '../Images/Products/' . $new_image_name;
                        move_uploaded_file($image_tmp_name, $image_upload_path);

                        
                        $status = addProduct($product_name, $description, $price, $category, $quantity, $createdAt, $new_image_name, $active_at);

                        if ($status == 1) {
                            echo "Product added successfully!";
                            header('location: ../view/products.php');
                        } else {
                            echo "Failed to add product. Please try again.";
                        }
                    } else {
                        echo "Image file size exceeds the 5MB limit!";
                    }
                } else {
                    echo "Invalid image format! Allowed formats: jpg, jpeg, png, gif.";
                }
            } else {
                echo "Error uploading the image!";
            }
        }
    } else {
        header('location: ../view/productList.html');
    }

    
?>

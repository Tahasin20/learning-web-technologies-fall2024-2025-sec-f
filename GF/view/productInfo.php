<?php
    require('../model/userModel.php');

    $conn = getConnection();

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get product ID from the URL
$product_id = $_REQUEST['mydata'];
$id = json_decode($product_id);

// Fetch product data from the database
$sql = "SELECT * FROM products WHERE product_id = $id";
$result = $conn->query($sql);

// Check if product exists
if ($result->num_rows > 0) {
    $product = $result->fetch_assoc();
} else {
    die($product_id);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['name']); ?></title>
    <link rel="stylesheet" href="styles.css">
    <style>

    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f9f9f9;
        color: #333;
    }

    h1, h2, h3, h4, h5, h6 {
        margin: 0;
    }

    a {
        text-decoration: none;
        color: inherit;
    }

    .product-page {
        display: flex;
        flex-wrap: wrap;
        margin: 20px auto;
        max-width: 1200px;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Product Image Section */
    .product-image {
        flex: 1;
        max-width: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .product-image img {
        max-width: 100%;
        border-radius: 8px;
        transition: transform 0.3s ease;
    }

    .product-image img:hover {
        transform: scale(1.05);
    }

    /* Product Details Section */
    .product-details {
        flex: 1;
        max-width: 50%;
        padding: 20px;
    }

    .product-title {
        font-size: 2rem;
        color: #333;
        margin-bottom: 10px;
    }

    .product-category,
    .product-price,
    .product-description,
    .product-stock,
    .product-status {
        margin-bottom: 10px;
        font-size: 1.1rem;
    }

    .product-status span.active {
        color: green;
        font-weight: bold;
    }

    .product-status span.inactive {
        color: red;
        font-weight: bold;
    }

    /* Add to Cart Button */
    .add-to-cart {
        display: inline-block;
        background-color: #ff5722;
        color: #fff;
        font-size: 1rem;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .add-to-cart:hover {
        background-color: #e64a19;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .product-page {
            flex-direction: column;
        }

        .product-image,
        .product-details {
            max-width: 100%;
        }

        .product-title {
            font-size: 1.5rem;
        }
    }

    </style>
    <script>
        // JavaScript for interactivity
        function addToCart() {
            alert("<?php echo htmlspecialchars($product['name']); ?> has been added to your cart!");
        }
    </script>
</head>
<body>
    <div class="product-page">
        <!-- Product Image Section -->
        <div class="product-image">
            <img src="<?php echo htmlspecialchars($product['image_url']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
        </div>

        <!-- Product Details Section -->
        <div class="product-details">
            <h1 class="product-title"><?php echo htmlspecialchars($product['name']); ?></h1>
            <p class="product-category"><strong>Category:</strong> <?php echo htmlspecialchars($product['category']); ?></p>
            <p class="product-price"><strong>Price:</strong> <?php echo htmlspecialchars($product['price']); ?> ৳</p>
            <p class="product-description"><strong>Description:</strong> <?php echo htmlspecialchars($product['description']); ?></p>
            <p class="product-stock">
                <strong>Stock Quantity:</strong> <?php echo htmlspecialchars($product['stock_quantity']); ?>
            </p>
            <p class="product-status">
                <strong>Status:</strong> 
                <span class="<?php echo $product['is_active'] ? 'active' : 'inactive'; ?>">
                    <?php echo $product['is_active'] ? 'Available' : 'Inactive'; ?>
                </span>
            </p>

            <!-- Add to Cart Button -->
            <button class="add-to-cart" onclick="addToCart()">Add to Cart</button>
        </div>
    </div>
</body>
</html>

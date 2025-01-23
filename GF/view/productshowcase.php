<?php
require_once('../model/userModel.php');

// Fetch all active products
$products = getProducts();

if (!$products) {
    die("No products found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Showcase</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #388e3c;
            padding: 10px 20px;
            color: white;
            box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.1);
        }

        .header .logo {
            font-size: 24px;
            font-weight: bold;
            color: white;
            text-decoration: none;
        }

        .nav {
            flex-grow: 1;
            display: flex;
            justify-content: center;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .nav a {
            margin: 0 10px;
            text-decoration: none;
            color: white;
            font-weight: bold;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .nav a:hover {
            background-color: #2e7d32;
        }

        .search-section {
            text-align: center;
            padding: 20px;
        }

        .search-bar {
            width: 50%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .search-button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-left: 10px;
        }

        .search-button:hover {
            background-color: #45a049;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 20px;
        }

        .product-box {
            width: 300px;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .product-box:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .product-box img {
            max-width: 100%;
            border-radius: 10px;
            margin-bottom: 10px;
        }

        .product-box h3 {
            margin: 10px 0;
            font-size: 1.2rem;
            color: #333;
        }

        .product-box p {
            margin: 5px 0;
            color: #777;
        }

        .product-box .price {
            font-size: 1.1rem;
            color: #000;
            font-weight: bold;
        }

        .product-box .actions {
            margin-top: 10px;
            display: flex;
            justify-content: space-between;
        }

        .product-box button {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.2s;
        }

        .product-box .add-to-cart {
            background-color: #4CAF50;
            color: white;
        }

        .product-box .add-to-cart:hover {
            background-color: #45a049;
        }

        .product-box .purchase {
            background-color: #f44336;
            color: white;
        }

        .product-box .purchase:hover {
            background-color: #e53935;
        }
    </style>
</head>
<body>
    <div class="header">
        <a href="userDashBoard.php" class="logo">Green Friend</a>
        <ul class="nav">
            <li><a href="userDashBoard.php">Dashboard</a></li>
            <li><a href="profileManagement.php">Profile</a></li>
            <li><a href="notification.html">Notification</a></li>
            <li><a href="products.php">Products</a></li>
            <li><a href="orderManagement.html">Orders</a></li>
            <li><a href="wishList.php">Wish List</a></li>
            <li><a href="sustainabilityCalculator.html">SustainaCalc</a></li>
        </ul>
    </div>

    <div class="search-section">
        <form method="get" action="searchProducts.php">
            <input type="text" name="query" class="search-bar" placeholder="Search products..." required>
            <button type="submit" class="search-button">Search</button>
        </form>
    </div>

    <h1 style="text-align: center; padding: 20px;">Product Showcase</h1>
    <div class="container">
        <?php foreach ($products as $product): ?>
        <div class="product-box">
            <img src="../Images/Products/<?php echo htmlspecialchars($product['image_path']); ?>" alt="<?php echo htmlspecialchars($product['product_name']); ?>">
            <h3><?php echo htmlspecialchars($product['product_name']); ?></h3>
            <p><?php echo htmlspecialchars($product['product_info']); ?></p>
            <p class="price">$<?php echo number_format($product['price'], 2); ?></p>
            <div class="actions">
                <button class="add-to-cart" onclick="addToCart(<?php echo $product['product_id']; ?>, '<?php echo htmlspecialchars($product['product_name']); ?>', <?php echo $product['price']; ?>)">Add to Cart</button>
                <button class="purchase" onclick="purchaseProduct(<?php echo $product['product_id']; ?>)">Purchase</button>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <script>
        function addToCart(productId, productName, price) {
            fetch('../controller/addToCart.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ productId, productName, price }),
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        alert(data.message);
                    } else {
                        alert(`Error: ${data.message}`);
                    }
                })
                .catch((error) => {
                    console.error('Fetch Error:', error);
                    alert('Failed to add product to wishlist. Please try again.');
                });
        }

        function purchaseProduct(productId) {
            alert(`Proceeding to purchase product ${productId}.`);
            // Add logic for purchase functionality
        }
    </script>
</body>
</html>

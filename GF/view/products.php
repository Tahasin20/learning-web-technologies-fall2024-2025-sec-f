<?php
    require_once('../model/userModel.php'); // Include your database connection file.
    $products = getProducts();
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Products</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7fafc;
        }

        .container {
            max-width: 1000px;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        h1 {
            text-align: center;
            color: #228b22;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            text-align: left;
            padding: 10px;
            border: 1px solid #ddd;
        }

        th {
            background-color: #228b22;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .back-button {
            display: block;
            margin-bottom: 20px;
            text-decoration: none;
            color: #555;
            font-size: 16px;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .back-button:hover {
            color: #228b22;
        }

        .back-button svg {
            width: 20px;
            height: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Back Button -->
        <a href="dashBoard.php" class="back-button">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                <path d="M15.41 7.41L10.83 12l4.58 4.59L14 18l-6-6 6-6z"/>
            </svg>
            Back
        </a>

        <h1>Product Listings</h1>

        <table>
            <thead>
                <tr>
                    <th>product ID</th>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Quantity</th>
                    <th>Stock</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($product['product_id']); ?></td>
                            <td><?php echo htmlspecialchars($product['product_name']); ?></td>
                            <td><?php echo htmlspecialchars($product['product_info']); ?></td>
                            <td><?php echo htmlspecialchars($product['price']); ?></td>
                            <td><?php echo htmlspecialchars($product['category']); ?></td>
                            <td><?php echo htmlspecialchars($product['stock_quantity']); ?></td>
                            <td><?php echo htmlspecialchars($product['quantity_added']); ?></td>
                            <td><?php echo htmlspecialchars($product['created_at']); ?></td>
                            <td class="action-links">
                                <a href="editProduct.php?id=<?php echo $product['product_id']; ?>">EDIT</a> |
                                <a href="deleteProduct.php?id=<?php echo $product['product_id']; ?>" onclick="return confirm('Are you sure you want to delete this product?');">DELETE</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9" style="text-align:center;">No products found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
require_once('../model/userModel.php');

function fetchProducts($con, $offset, $limit) {
    $query = "SELECT * FROM products LIMIT ?, ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("ii", $offset, $limit);
    $stmt->execute();
    $result = $stmt->get_result();
    $products = [];

    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }

    $stmt->close();
    return $products;
}

if (isset($_GET['offset'])) {
    $offset = (int)$_GET['offset'];
    $limit = 10; // Number of products per load

    $con = getConnection();
    $products = fetchProducts($con, $offset, $limit);

    foreach ($products as $product) {
        echo "<div class='product-item'>";
        echo "<img src='image/product/{$product['image']}' alt='{$product['name']}'>";
        echo "<h6>{{$product['product_id']}</h6>";
        echo "<div class='product-info'>";
        echo "<h3>{$product['name']}</h3>";
        echo "<p>Price: \${$product['price']}</p>";
        echo "</div>";
        echo "</div>";
    }
}
?>

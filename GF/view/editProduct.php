<?php
require_once('../model/userModel.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $con = getConnection();
    $sql = "SELECT * FROM prd WHERE product_id = $id";
    $result = mysqli_query($con, $sql);
    $user = mysqli_fetch_assoc($result);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $product_name = $_POST['product_name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category = $_POST['category'];
        $stock_quantity = $_POST['stock_quantity'];
        $quantity_added = $_POST['quantity_added'];
        $created_at = $_POST['created_at'];

        $sql = "UPDATE prd SET 
                product_name = '$product_name', 
                description = '$description', 
                price = '$price', 
                category = '$category', 
                stock_quantity = '$stock_quantity', 
                quantity_added = '$quantity_added', 
                created_at = '$created_at' 
                WHERE product_id = $id";
        
        if (mysqli_query($con, $sql)) {
            header('Location: products.php');
        } else {
            echo "Failed to update user.";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit User</title>
</head>
<body>
    <h2>Edit User</h2>
    <form method="POST">
        <label>product_name:</label>
        <input type="text" name="product_name" value="<?php echo $user['product_name']; ?>" required><br>
        <label>description:</label>
        <input type="text" name="description" value="<?php echo $user['description']; ?>" required><br>
        <label>price:</label>
        <input type="text" name="price" value="<?php echo $user['price']; ?>" required><br>
        <label>category:</label>
        <input type="text" name="category" value="<?php echo $user['category']; ?>" required><br>
        <label>stock_quantity:</label>
        <input type="text" name="stock_quantity" value="<?php echo $user['stock_quantity']; ?>" required><br>
        <label>quantity_added:</label>
        <input type="text" name="quantity_added" value="<?php echo $user['quantity_added']; ?>" required><br>
        <label>created_at:</label>
        <input type="text" name="created_at" value="<?php echo $user['created_at']; ?>" required><br>
        <input type="submit" value="Update">
    </form>
</body>
</html>
<?php
} else {
    header('Location: products.php');
}
?>
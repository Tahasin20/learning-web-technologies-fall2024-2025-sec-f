<?php
require_once('../model/userModel.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $con = getConnection();
    $sql = "SELECT * FROM ggu WHERE id = $id";
    $result = mysqli_query($con, $sql);
    $user = mysqli_fetch_assoc($result);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $dob = $_POST['dob'];
        $contactno = $_POST['contactno'];
        $address = $_POST['address'];
        $catagory = $_POST['catagory'];

        $sql = "UPDATE ggu SET 
                username = '$username', 
                email = '$email', 
                gender = '$gender', 
                dob = '$dob', 
                contactno = '$contactno', 
                address = '$address', 
                catagory = '$catagory' 
                WHERE id = $id";
        
        if (mysqli_query($con, $sql)) {
            header('Location: userlist.php');
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
        <label>Username:</label>
        <input type="text" name="username" value="<?php echo $user['username']; ?>" required><br>
        <label>Email:</label>
        <input type="email" name="email" value="<?php echo $user['email']; ?>" required><br>
        <label>Gender:</label>
        <input type="text" name="gender" value="<?php echo $user['gender']; ?>" required><br>
        <label>Date of Birth:</label>
        <input type="date" name="dob" value="<?php echo $user['dob']; ?>" required><br>
        <label>Contact No:</label>
        <input type="text" name="contactnno" value="<?php echo $user['contactnno']; ?>" required><br>
        <label>Address:</label>
        <input type="text" name="address" value="<?php echo $user['address']; ?>" required><br>
        <label>Category:</label>
        <input type="text" name="catagory" value="<?php echo $user['catagory']; ?>" required><br>
        <input type="submit" value="Update">
    </form>
</body>
</html>
<?php
} else {
    header('Location: userlist.php');
}
?>

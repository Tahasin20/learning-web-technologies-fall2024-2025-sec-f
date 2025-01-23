<?php
require_once('../model/userModel.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $con = getConnection();
    $sql = "DELETE FROM ggu WHERE id = $id";

    if (mysqli_query($con, $sql)) {
        header('Location: userlist.php');
    } else {
        echo "Failed to delete user.";
    }
} else {
    header('Location: userlist.php');
}
?>

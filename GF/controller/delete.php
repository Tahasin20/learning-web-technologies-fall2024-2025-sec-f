<?php
require('../model/usermodel.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $result = deleteUser($username);
    if ($result) {
        echo "User deleted successfully!";
    } else {
        echo "Error deleting user.";
    }
}
?>

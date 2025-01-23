<?php
require('../model/usermodel.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $contactno = $_POST['contactno'];
    $password = $_POST['password'];

    $result = updateUser($username, $contactno, $password);
    if ($result) {
        echo "User updated successfully!";
    } else {
        echo "Error updating user.";
    }
}
?>

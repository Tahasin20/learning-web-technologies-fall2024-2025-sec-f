<?php
require('../model/usermodel.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $name = $_POST['name'];
    $contact_no = $_POST['contact_no'];
    $password = $_POST['password'];

    $result = updateUser($name, $contact_no, $password, $username);
    if ($result) {
        echo "User updated successfully!";
    } else {
        echo "Error updating user.";
    }
}
?>

<?php
require_once('../model/userModel.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $blogId = $_POST['id'];

    if (updateBlogStatus($blogId, 'rejected')) {
        echo "Blog rejected successfully.";
    } else {
        echo "Failed to reject the blog. Please try again.";
    }
}
?>

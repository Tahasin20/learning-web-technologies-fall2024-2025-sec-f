<?php
require_once('../model/userModel.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $blogId = $_POST['blogId'];
    $status = $_POST['status'];

    if (updateBlogStatus($blogId, $status)) {
        echo "Blog status updated successfully.";
    } else {
        echo "Failed to update blog status.";
    }
}
?>

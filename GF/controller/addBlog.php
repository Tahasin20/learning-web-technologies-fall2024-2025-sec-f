
<?php
require_once('../model/userModel.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author = isset($_SESSION['username']) ? $_SESSION['username'] : 'Anonymous';

    if (addBlog($title, $content, $author)) {
        echo "Blog submitted successfully. Waiting for admin approval.";
    } else {
        echo "Failed to submit the blog. Please try again.";
    }
}
?>

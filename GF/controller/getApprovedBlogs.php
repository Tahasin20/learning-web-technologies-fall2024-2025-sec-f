<?php
require_once('../model/userModel.php');

$blogs = getBlogsByStatus('approved');

foreach ($blogs as $blog) {
    echo "<div class='blog-container'>
        <div class='blog-title'>{$blog['title']}</div>
        <div class='blog-author'>By: {$blog['author']}</div>
        <div class='blog-content'>{$blog['content']}</div>
    </div>";
}
?>

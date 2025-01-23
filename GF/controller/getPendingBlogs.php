<?php
require_once('../model/userModel.php');

$blogs = getBlogsByStatus('pending');

foreach ($blogs as $blog) {
    echo "<tr>
        <td>{$blog['id']}</td>
        <td>{$blog['title']}</td>
        <td>{$blog['content']}</td>
        <td>{$blog['author']}</td>
        <td>{$blog['status']}</td>
        <td class='actions'>
            <button class='approve' onclick=\"updateBlogStatus({$blog['id']}, 'approved')\">Approve</button>
            <button class='reject' onclick=\"updateBlogStatus({$blog['id']}, 'rejected')\">Reject</button>
        </td>
    </tr>";
}
?>


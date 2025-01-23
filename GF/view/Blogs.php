<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .blog-container {
            width: 90%;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .blog-title {
            font-size: 20px;
            font-weight: bold;
        }
        .blog-author {
            font-size: 14px;
            color: #555;
        }
        .blog-content {
            margin-top: 10px;
            font-size: 16px;
            line-height: 1.6;
        }
        form {
            width: 90%;
            margin: 20px auto;
        }
        textarea {
            width: 100%;
            height: 100px;
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            padding: 10px 20px;
            border: none;
            background-color: #28a745;
            color: white;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
        }
        button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>


    <h3>Approved Blogs</h3>
    <div id="approvedBlogs">
    </div>

    <script>
        
        function fetchApprovedBlogs() {
            const xhttp = new XMLHttpRequest();
            xhttp.open('GET', '../controller/getApprovedBlogs.php', true);
            xhttp.onload = function () {
                if (this.status === 200) {
                    document.getElementById('approvedBlogs').innerHTML = this.responseText;
                }
            };
            xhttp.send();
        }
        document.addEventListener('DOMContentLoaded', fetchApprovedBlogs);function fetchPendingBlogs() {
            const xhttp = new XMLHttpRequest();
            xhttp.open('GET', '../controller/getPendingBlogs.php', true);
            xhttp.onload = function () {
                if (this.status === 200) {
                    document.getElementById('pendingBlogs').innerHTML = this.responseText;
                }
            };
            xhttp.send();
        }

        function updateBlogStatus(blogId, status) {
            const xhttp = new XMLHttpRequest();
            xhttp.open('POST', '../controller/updateBlogStatus.php', true);
            xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhttp.onload = function () {
                if (this.status === 200) {
                    alert(this.responseText);
                    fetchPendingBlogs(); 
                }
            };
            xhttp.send(`blogId=${blogId}&status=${status}`);

        }
        document.addEventListener('DOMContentLoaded', fetchPendingBlogs);
    </script>
</body>
</html>

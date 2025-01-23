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
        h1 {
            text-align: center;
        }
        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f4f4f4;
        }
        .actions button {
            padding: 5px 10px;
            margin-right: 5px;
            border: none;
            color: white;
            cursor: pointer;
        }
        .approve {
            background-color: green;
        }
        .reject {
            background-color: red;
        }
    </style>
</head>
<body>
    <h1>Admin Dashboard</h1>
    <h3>Pending Blogs</h3>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Content</th>
                <th>Author</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="pendingBlogs">
        
        </tbody>
    </table>

    <script>
        function fetchPendingBlogs() {
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

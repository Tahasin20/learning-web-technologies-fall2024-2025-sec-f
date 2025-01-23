
<?php
    session_start();
    if (isset($_COOKIE['flag'])) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #e8f5e9; /* Greenish background */
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #388e3c;
            padding: 10px 20px;
            color: white;
            box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.1);
        }

        .header .logo {
            font-size: 24px;
            font-weight: bold;
            color: white;
            text-decoration: none;
        }

        .nav {
            flex-grow: 1;
            display: flex;
            justify-content: center;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .nav a {
            margin: 0 10px;
            text-decoration: none;
            color: white;
            font-weight: bold;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .nav a:hover {
            background-color: #2e7d32;
        }

        .profile-section {
            display: flex;
            align-items: center;
        }

        .profile-section .icon {
            font-size: 20px;
            margin-right: 10px;
        }

        .profile-section a {
            text-decoration: none;
            color: white;
            font-weight: bold;
            margin-left: 15px;
        }

        .profile-section a:hover {
            text-decoration: underline;
        }

        .container {
            padding: 20px;
        }

        .search-section {
            margin-top: 20px;
            padding: 15px;
            background-color: #ffffff;
            border: 2px solid #388e3c;
            border-radius: 8px;
            box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.1);
        }

        .search-section h2 {
            margin-top: 0;
        }

        .search-section input {
            width: calc(50% - 20px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .search-section #results {
            margin-top: 10px;
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
    <div class="header">
        <a href="userDashBoard.php" class="logo">Green Friend</a>
        <ul class="nav">
            <li><a href="userDashBoard.php">Dashboard</a></li>
            <li><a href="profileManagement.php">Profile</a></li>
            <li><a href="notification.html">Notification</a></li>
            <li><a href="productshowcase.php">Products</a></li>
            <li><a href="orderManagement.html">Orders</a></li>
            <li><a href="wishList.php">Wish List</a></li>
            <li><a href="sustainabilityCalculator.html">SustainaCalc</a></li>
        </ul>
        <div class="profile-section">
            <span class="icon">👤</span>
            <span><?php echo htmlspecialchars($_SESSION['username']); ?></span>
            <a href="../controller/logout.php">Logout</a>
        </div>
    </div>

    <div class="container">
        <h2>Welcome to the Dashboard, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
        <p>Navigate through the options using the menu above.</p>

        <div class="search-section">
            <h2>Search Products</h2>
            <input type="text" id="search" placeholder="Type product to search..." />
            <div id="results"></div>
        </div>
    </div>

    <h3>Write a Blog</h3>
    <form id="writeBlogForm">
        <textarea id="blogTitle" placeholder="Blog Title" required></textarea>
        <textarea id="blogContent" placeholder="Write your blog content here..." required></textarea>
        <button type="button" onclick="submitBlog()">Submit Blog</button>
    </form>

    <h3>Approved Blogs</h3>
    <div id="approvedBlogs">
    </div>

    <script>
        document.getElementById('search').addEventListener('input', function () {
            const searchTerm = this.value.trim();
            if (!searchTerm) {
                document.getElementById('results').innerHTML = '';
                return;
            }

            const xhttp = new XMLHttpRequest();
            xhttp.open('POST', 'search.php', true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    document.getElementById('results').innerHTML = this.responseText;
                }
            };
            xhttp.send("search=" + encodeURIComponent(searchTerm));
        });

        function submitBlog() {
            const title = document.getElementById('blogTitle').value.trim();
            const content = document.getElementById('blogContent').value.trim();

            if (!title || !content) {
                alert("Title and content cannot be empty.");
                return;
            }

            const xhttp = new XMLHttpRequest();
            xhttp.open('POST', '../controller/addBlog.php', true);
            xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhttp.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    alert(this.responseText);
                    document.getElementById('writeBlogForm').reset();
                    fetchApprovedBlogs();
                }
            };
            xhttp.send(`title=${encodeURIComponent(title)}&content=${encodeURIComponent(content)}`);
        }
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
        document.addEventListener('DOMContentLoaded', fetchApprovedBlogs);
    </script>
</body>
</html>

<?php
    } else {
        header('location: signIn.html'); 
    }
?>

<?php
    require_once('../model/userModel.php');
    session_start();
    if(isset($_SESSION['username'])){
        $username  = $_SESSION['username'];
    
    $row = getUserInfo($username);
    $image = '../Images/Users/'.$row['image'];
    
?>

<html>
<head>
    <title>Admin Dashboard</title>
    <style>

body {
      margin: 0;
      padding: 0;
      justify-content: center;
      align-items: center;
      font-family: Arial, sans-serif;
      background: linear-gradient(to bottom, #f0fff0, #e0ffe0);
      width: 100%;
    }
    #head {
        color:white;
        margin-top:25px;
        margin-right:600px;
        font-size:35px;
    }

    .header {
        background:black;
    }

    .right_header {
        display: flex;
        top: 20px;
        left: 800px;
        position: absolute;
    }

    .right_header img {
      height:50px;
      border: 0px;
      border-radius: 22px;
      margin: 20px 20px -10px 20px;
    }

    

    #aboutus {
        color:white;
        margin-top:25px;
        font-size:25px;
    }
    .container {
        display: flex;
    }

    .menu {
        width: 200px;
        background-color: #ffffff; /* White menu background */
        padding: 15px;
        border-right: 2px solid #388e3c;
        min-height: 100vh;
        box-shadow: 2px 0px 6px rgba(0, 0, 0, 0.1);
    }

    .menu a {
        display: block;
        padding: 10px;
        text-decoration: none;
        color: #388e3c;
        font-weight: bold;
        text-align: left;
        border: 1px solid #388e3c;
        border-radius: 5px;
        transition: all 0.3s ease;
    }

    .menu a:hover {
        background-color: #388e3c;
        color: white;
    }
    
    </style>
    </head>
<body>

    
    <div class="header">
        <img class="image2" src="../Images/logo200.png" >
        
    <div class="right_header">
        <h1 id="head" onclick="test()">Hello! </h1>
        <a href="aboutUs.html" id="aboutus" >About us</a>
        <a href="profileManagement.php"><img src=<?php echo $image ?> style="" ></a>
    </div>
    </div>
    
    <div class="container">
    <div class="menu">
    <div class="main_dash">
        <a href="adminDashBoard.php" style="margin-top:50px;">Dashboard</a><br><br>
        <a href="notification.php">Notification</a><br><br>
        <a href="products.php">Products</a><br><br>
        <a href="userlist.php">Users</a><br><br>
        <a href="blogs.php">Blogs</a><br><br>
        <a href="addProduct.html">Add Products</a><br><br>
        <a href="addUser.html">Add User</a><br><br>
        <a href="addBlog.html">Add Blog</a><br><br>
        <a href="orderManagement.html">Orders</a><br><br>
        <a href="../controller/logout.php">Logout</a>
    </div><br>
    </div>
    </div>

    <script>
        // var username = sessionStorage.getItem('username'); 
        // if (username) { 
        //     document.getElementById('head').textContent = "Hello "+username; 

        // } else { window.location.href = 'signIn.html'; }


        //document.getElementById("name").innerHTML = username;
    </script>
</body>
</html>
<?php
    }
    else{
        echo "coudnt find page";
    }
    
?>
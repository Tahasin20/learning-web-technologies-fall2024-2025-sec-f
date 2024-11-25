<?php
    session_start();
    if(isset($_SESSION['flag'])){
?>


<html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <h1>Welcome Home! <?php echo $_SESSION['name'];?></h1>
    <h3>Your Username <?php echo $_SESSION['username'];?></h3>
    <h3>Your Password <?php echo $_SESSION['password'];?></h3>
    <h3>Your Email <?php echo $_SESSION['email'];?></h3>
    <h3>Your Gender <?php echo $_SESSION['gender'];?></h3>
    <a href="Logout.php">logout</a>
</body>
</html>

<?php
    }else{
        header('location: Login.html'); 
    }
?>
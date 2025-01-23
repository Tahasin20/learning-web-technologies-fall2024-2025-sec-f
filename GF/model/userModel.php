<?php

    function getConnection(){
        $con = mysqli_connect('127.0.0.1', 'root', '', 'gfdb');
        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        }else{
            return $con;
        }
    }

    function login($username, $password){
        $con = getConnection();
        $sql = "SELECT * from users where username='{$username}' and password='{$password}'";
        $result = mysqli_query($con, $sql);
        $count =  mysqli_num_rows($result);

        if($count ==1 ){
            $row = $result->fetch_assoc();
            if($row["catagory"]=="admin"){
                return 1;
            }
            else if ($row["catagory"]=="user"){
                return 2;
            }
        }else{
            return 3;
        }
    }

    function addUser($username, $password, $email, $gender, $dob, $contactno, $address ,$catagory, $image){
        $con = getConnection();
        $sql1 = "SELECT * from users where username='{$username}'";
        $result = mysqli_query($con, $sql1);
        $count =  mysqli_num_rows($result);
        if($count == 1){
            return 2;
        }else{

            $sql = "INSERT into users VALUES('', '{$username}', '{$password}', '{$email}', '{$gender}', '{$dob}', '{$contactno}', '{$address}', '{$catagory}', '')";        
            $con = getConnection();
            if(mysqli_query($con, $sql)){
                return 1;
            }else{
                return 0;
            }
        }
        
    }

    function getUserInfo($username){
        $con = getConnection();
        $sql = "SELECT * from users where username='{$username}'";
        $result = mysqli_query($con, $sql);
        //$count =  mysqli_num_rows($result);
        $row = $result->fetch_assoc();
        return $row;
    }
    function updateUserInfo($username, $password, $email, $gender, $dob, $contactno, $address ,$catagory, $image){
        $con = getConnection();
        $sql = "UPDATE users SET password = '{$password}', email = '{$email}',  gender = '{$gender}', dob = '{$dob}', contactno = '{$contactno}', catagory = '{$catagory}', image = '{$image}' WHERE username = '{$username}'";
        $result = mysqli_query($con, $sql);
        return $result;
    }

    // function getAllUsers() {
    //     $con = getConnection();
    //     $sql = "SELECT * FROM ggu";
    //     $result = mysqli_query($con, $sql);
    //     $users = [];

    //     while ($row = mysqli_fetch_assoc($result)) {
    //         $users[] = $row;
    //     }

    //     return $users;
    // }

    

    function getUserByUsername($username) {
        $con = getConnection();
        $sql = "SELECT * FROM users WHERE username = '{$username}'";
        $result = mysqli_query($con, $sql);
        return mysqli_fetch_assoc($result);
    }
    
    function checkIfUsernameExists($username) {
        $con = getConnection();
        $sql = "SELECT COUNT(*) AS count FROM users WHERE username = '{$username}'";
        $result = mysqli_query($con, $sql);
        $data = mysqli_fetch_assoc($result);
        return $data['count'] > 0;
    }
    
    function getAllUsers() {
        $con = getConnection();
        $sql = "SELECT * FROM users";
        $result = mysqli_query($con, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    
    function searchUsers($searchTerm) {
        $con = getConnection();
        $sql = "SELECT * FROM users WHERE username LIKE '%{$searchTerm}%'";
        $result = mysqli_query($con, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    
    function updateUser($username, $contactno, $password) {
        $con = getConnection();
        $sql = "UPDATE users SET contactno='{$contactno}', password='{$password}' WHERE username='{$username}'";
        return mysqli_query($con, $sql);
    }
    
    function deleteUser($username) {
        $con = getConnection();
        $sql = "DELETE FROM users WHERE username='{$username}'";
        return mysqli_query($con, $sql);
    }

    function checkUserEmail($username, $email){
        $con = getConnection();
        $sql = "SELECT * from users where username='{$username}' and email='{$email}'";
        $result = mysqli_query($con, $sql);
        $count =  mysqli_num_rows($result);
        if($count == 1){
            return true;
        }else{
            return false;
        }
    }

    function changePassword($username, $email, $password){
        $con = getConnection();
        $sql = "UPDATE users SET password = '{$password}' WHERE email = '{$email}' and username = '{$username}'";
        mysqli_query($con, $sql);
    }

    function getCatagory($username){
        $con = getConnection();
        $sql = "SELECT * from users where username='{$username}'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);
        $catagory = $row['catagory'];
        return $catagory;
    }

    function addProduct($product_name, $description, $price, $category, $quantity, $createdAt, $image_name, $is_active) {
        $con = getConnection();
        $sql = "INSERT INTO products (product_name, product_info, price, category, quantity_added, stock_quantity, created_at, image_path, is_active) 
                VALUES ('$product_name', '$description', '$price', '$category', '$quantity', '$quantity', '$createdAt', '$image_name', '$is_active')";

        if (mysqli_query($con, $sql)) {
            return 1; 
        } else {
            return 0; 
        }
    }

    function getProducts() {
        $con = getConnection(); // Assuming this function is defined in `database.php`.
        $sql = "SELECT * FROM products"; // Replace `products` with your table name.
        $result = mysqli_query($con, $sql);
        $products = [];
    
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $products[] = $row;
            }
        }
    
        return $products;
    }


    function addBlog($title, $content, $author) {
        $con = getConnection();
        $status = 'pending'; 
        $sql = "INSERT INTO blogs (title, content, author, status) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, 'ssss', $title, $content, $author, $status);
        return mysqli_stmt_execute($stmt);
    }
    
    function getBlogsByStatus($status) {
        $con = getConnection();
        $sql = "SELECT * FROM blogs WHERE status = ?";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, 's', $status);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    
    function getBlogsByAuthor($author) {
        $con = getConnection();
        $sql = "SELECT * FROM blogs WHERE author = ?";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, 's', $author);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    
    function updateBlogStatus($id, $status) {
        $con = getConnection();
        $sql = "UPDATE blogs SET status = ? WHERE id = ?";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "si", $status, $id);
        $result = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $result;
    }

?>
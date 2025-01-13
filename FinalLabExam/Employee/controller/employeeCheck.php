<?php
    session_start();
    require('../Model/usermodel.php');
    $conn = getconnection();


    if(isset($_POST['register'])) {
        $name = $_POST['name'];
        $contact = $_POST['contact'];
        $username = $_POST['username'];
        $password = $_POST['password'];
    
        if(empty($name) || empty($contact) || empty($username) || empty($password)) {
            echo "All fields are required.";
        } else {
            addUser($name, $contact, $password, $username);
            header('location: ../View/login.html');
        }
    }

    if(isset($_POST['Login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
    
        if(empty($username) || empty($password)) {
            echo "All fields are required.";
        } else {
            $status = login($username, $password);
            if ($status){
                $_SESSION['username'] = $username;
                header('location: ../View/dashboard.html');
            }else {
                echo "Error: " . $conn->error;
            }
        }
    
    }
    

    
?>
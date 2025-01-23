<?php
    session_start();
    require_once('../model/userModel.php');

    $username  =  trim($_REQUEST['username']);
    $password  =  trim($_REQUEST['password']);

    if($username == null || empty($password) ){
        echo "Null data found!";
    }else {
        
        $status = login($username, $password);
        if ($status == 1){
            $_SESSION["username"] = $username;
            header('location: ../view/adminDashBoard.php');
        }else if($status == 2){
            setcookie('flag', 'true', time()+3600, '/');
            $_SESSION["username"] = $username;
            header('location: ../view/userDashBoard.php');
        }else{
            //var_dump($_SESSION['user']);
            echo "Invalid user";
        }
    }
    
?>

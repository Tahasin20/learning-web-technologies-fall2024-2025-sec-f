<?php
    session_start();
    require_once('../model/userModel.php');

    if(isset($_POST['submit'])){
        $username  =  trim($_REQUEST['username']);
        $email  =  trim($_REQUEST['email']);
        $newpassword = trim($_REQUEST['newpassword']);
        $confirmPassword = trim($_REQUEST['confirmpassword']);

        if($username == null || empty($email)){
            echo "Null data found!";
        }else if($newpassword!=$confirmPassword){
            echo "Password Does not Match!";
        }else{
            $status = checkUserEmail($username, $email);
            if ($status){
                $status2 = changePassword($username, $email, $newpassword);
                $_SESSION['username'] = $username;
                header('location: ../view/signIn.html');
            }else{
                //var_dump($_SESSION['user']);
                echo "Invalid user";
            }
        }
    }else{
        //echo "Invalid request!";
        header('location: ../view/signIn.html');
    }
?>
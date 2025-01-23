<?php
    session_start();
    require_once('../model/userModel.php');
    if(isset($_POST['signUp'])){
        $username  =  trim($_REQUEST['username']);
        $password  =  trim($_REQUEST['password']);
        $email  =  trim($_REQUEST['email']);
        $gender = $_REQUEST['gender'];
        $dob = $_REQUEST['dob'];
        $contactno = trim($_REQUEST['contactno']);
        $address = trim($_REQUEST['address']);

        if($username == null || empty($password) || empty($email) ){
            echo "Null data found!";
        }else {
            $status = addUser($username, $password, $email, $gender, $dob, $contactno, $address, "user", "");
            
            if($status == 1){
                header('location: ../view/signIn.html');
            }else if($status == 2){
                echo ("Username Already Exist Try Other Username!");
                //sleep(3);
                header('location: ../view/signUp.html');
            }else{
                header('location: ../view/signUp.html');
            }
        }
    }
    else if(isset($_POST['adduser'])){
        $username  =  trim($_REQUEST['username']);
        $password  =  trim($_REQUEST['password']);
        $email  =  trim($_REQUEST['email']);
        $gender = $_REQUEST['gender'];
        $dob = $_REQUEST['dob'];
        $contactno = trim($_REQUEST['contactno']);
        $address = trim($_REQUEST['address']);

        if($username == null || empty($password) || empty($email) ){
            echo "Null data found!";
        }else {
            $status = addUser($username, $password, $email, $gender, $dob, $contactno, $address, "admin", "");
            
            if($status == 1){
                header('location: ../view/signIn.html');
            }else if($status == 2){
                echo ("Username Already Exist Try Other Username!");
                //sleep(3);
                header('location: ../view/signUp.html');
            }else{
                header('location: ../view/signUp.html');
            }
        }
    }
    
    
    
    else{
        header('location: ../view/signUp.html');

    }

?>
<?php
    session_start();
    require_once('../model/userModel.php');

    if(isset($_COOKIE['flag'])){
        $username  =  $_SESSION['username'];
        $password  =  trim($_REQUEST['password']);
        $email  =  trim($_REQUEST['email']);
        $gender = $_REQUEST['gender'];
        $dob = $_REQUEST['dob'];
        $contactno = trim($_REQUEST['contactno']);
        $address = trim($_REQUEST['address']);
        $catagory = getCatagory($username);
        $filename = $_FILES['profilePic']['name'];
        $tempname = $_FILES['profilePic']['tmp_name'];
        $folder = '../Images/Users/'.$filename;
        updateUserInfo($username, $password, $email, $gender, $dob, $contactno, $address, $catagory, $filename);
        if(move_uploaded_file($tempname, $folder)){
            echo "<h2> File uploded successfully</h2>";
        }
        header('location: ../view/profileManagement.php');

    }else{
        header('location: ../view/signIn.html'); 
    }
?>
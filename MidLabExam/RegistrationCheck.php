<?php
    session_start();

    if(isset($_POST['submit'])){
        $name = trim($_REQUEST['name']);
        $username  =  trim($_REQUEST['username']);
        $password  =  trim($_REQUEST['password']);
        $email  =  trim($_REQUEST['email']);
        $gender  =  trim($_REQUEST['gender']);
        echo $gender;

        if($name == null || $username == null || $password == null || $email == null || $gender == null ){
            echo "Null data found!";
            header('location: Registration.html');
        }else {
            $_SESSION['flag'] = true;
            if(isset($_SESSION['user'])){
                array_push('name' => $name, 'username' => $username, 'password' => $password, 'email' => $email, 'gender' => $gender)
            }
            else{
               $_SESSION['user'] = array(
                    array('name' => $name, 'username' => $username, 'password' => $password, 'email' => $email, 'gender' => $gender),
                ); 
            }
            
            //$_SESSION['name'] = $name;
            // $_SESSION['username'] = $username;
            // $_SESSION['password'] = $password;
            // $_SESSION['email'] = $email;
            // $_SESSION['gender'] = $gender;
            header('location: Login.html');
        }
    }else{
        header('location: Registration.html');
    }

?>
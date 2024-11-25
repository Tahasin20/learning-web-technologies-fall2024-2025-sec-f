<?php
    session_start();

    if(isset($_POST['submit'])){

        $username  =  trim($_REQUEST['username']);
        $password  =  trim($_REQUEST['password']);

        if($username == null || empty($password) ){
            echo "Null data found!";
        }else {
            foreach ($_SESSION['user'] as $row) { 
                if (isset($row['username']) && $row['username'] == $username && isset($row['password']) && $row['password'] == $password ) { 
                    $_SESSION['flag'] = true;
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['password'] = $row['password'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['gender'] = $row['gender'];
                    header('location: Home.php');
                }
            }
            //$_SESSION['flag'] = false;
            header('location: Login.html');
            
        }
    }else{
        header('location: Login.html');
    }

?>
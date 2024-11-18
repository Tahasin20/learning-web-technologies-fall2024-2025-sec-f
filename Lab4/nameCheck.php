<?php
    session_start();

    if(isset($_POST['submit'])){

        $username  =  $_REQUEST['username'];
        //$password  =  $_REQUEST['password'];

        $flag = false;

        function validateString($string) { 
            $allowedChars = 'abcdefghijklmnopqrstuvwxyz ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-'; 
            for ($i = 0; $i < strlen($string); $i++) { 
                if (strpos($allowedChars, $string[$i]) === false) { 
                    return false; } 
            } return true;
        }
        for($i=0; $i < strlen($username); $i++){
            if($username[$i] == " "){
                $flag = true;
            }     
        }
        if($username == null){
            echo "Null data found!";
        }
        else if (!$flag){
            echo "Enter at least 2 words";
        }
        else if (ctype_digit($username[0])){
            echo "Name should be start with a letter";
        }
        else if (!validateString($username)) { 
            echo "Invalid string!"; 
        }
        else{
            header('location: Email.html');
        }
    }else{
        //echo "Invalid request!";
        header('location: Name.html');
    }
?>
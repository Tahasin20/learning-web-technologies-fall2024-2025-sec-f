<?php
    session_start();

    if(isset($_POST['submit'])){

        $email  =  $_REQUEST['email'];
        //$password  =  $_REQUEST['password'];

        $spaceFlag = false;
        $last4char = substr($email, strlen($email)-4);

        function validateString($string) { 
            $allowedChars = 'abcdefghijklmnopqrstuvwxyz0123456789@.'; 
            for ($i = 0; $i < strlen($string); $i++) { 
                if (strpos($allowedChars, $string[$i]) === false) { 
                    return false; } 
            } return true;
        }
        for($i=0; $i < strlen($email); $i++){
            if($email[$i] == " "){
                $spaceFlag = true;
            }     
        }
        if($email == null){
            echo "Null data found!";
        }
        else if ($spaceFlag){
            echo "Email should not have space in the middle";
        }
        else if ($last4char != ".com"){
            echo "Enter a valid email";
        }
        else if (!validateString($email)) { 
            echo "Invalid string!"; 
        }
        else{
            header('location: DOB.html');
        }
    }else{
        //echo "Invalid request!";
        header('location: Email.html');
    }


    //print_r($_GET);
    //echo "Test";
?>
<?php 
     $username = $_REQUEST['mydata'];
     $user = json_decode($json);
     echo "Your username is: {$user}";
     $user = ['username'=>'alamin', 'email'=> 'alamin@aiub.edu', 'pass'=>123];
     echo json_encode($user);
?>
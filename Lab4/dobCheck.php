<?php
    session_start();

    if(isset($_POST['submit'])){

        $dd  =  $_REQUEST['dd'];
        $mm  =  $_REQUEST['mm'];
        $yyyy  =  $_REQUEST['yyyy'];
        $spaceFlag = false;

        if($dd == null || $mm == null ||$yyyy == null){
            echo "Null data found!";
        }
        
        else if ($dd < 1 && $dd > 31 || $mm < 1 && $mm > 12 || $yyyy < 1953 && &yyyy >1998) { 
            echo "Invalid Date/Month/Year!"; 
        }
        else{
            header('location: Gender.html');
        }
    }else{
        //echo "Invalid request!";
        header('location: DOB.html');
    }

?>
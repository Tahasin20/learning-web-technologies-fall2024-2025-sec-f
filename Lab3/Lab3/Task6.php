<?php

    $someElements = array("siam","maliha","mehedi","jahid","moon","abik","joy","rayhan") ;
    $lengthOfArray = sizeof($someElements);
    $targetElement = "moon";
    for ($i = 0; $i < $lengthOfArray; $i++){
        if ($someElements[$i] == $targetElement){
            echo $targetElement ." has been in the array.";
        }

    }

?>
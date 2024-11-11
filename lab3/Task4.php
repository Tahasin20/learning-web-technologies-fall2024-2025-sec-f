<?php
    $a = 3;
    $b = 2;
    $c = 5;
    $largestNumber;

    echo "a = ".$a."<br>";
    echo "b = ".$b."<br>";
    echo "c = ".$c."<br>";  

    if ($a >= $b){
        if ($a >= $c){
            $largestNumber = $a;
            echo "a is the largest number: ".$largestNumber;
        }
        else {
            $largestNumber = $c;
            echo "c is the largest number: ".$largestNumber;
        }
    }
    else{
        if ($b >= $c){
            $largestNumber = $b;
            echo "b is the largest number: ".$largestNumber;
        }
        else {
            $largestNumber = $c;
            echo "c is the largest number: ".$largestNumber;
        }
    }

?>
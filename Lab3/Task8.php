<?php

    $array1 = array(
        array('1','2','3','A'),
        array('1','2','B','C'),
        array('1','D','E','F')
    );

    for ($i = 0; $i < 3; $i++){
        for ($j = 0; $j < 3-$i; $j++){
            echo $array1[$i][$j],' ';
        }

        for ($j = 0; $j <= $i; $j++){
            echo '* ';
        }

        for ($j = 3-$i; $j <= 3; $j++){
            echo $array1[$i][$j],' ';
        }
        echo "<br>";
    }

?>
<?php
    for ($i = 1; $i <= 3; $i++) {
        for ($j = 0; $j <= i; $j++) {
            echo "* ";
        }
    }

    for ($i = 3; $i >= 0; $i--) {
        for ($j = 1; $j < i; $j++) {
            echo $j;
        }
    }

    

?>
<?php
    $amount = 120;
    $percentage = 15;
    $VAT = ($percentage / 100) * $amount;
    $Total = $amount + $VAT;
    echo "Amount: ". $amount. "<br>";
    echo "Percentage". $percentage."<br>";
    echo "VAT: ".$VAT. "<br>";
    echo "TOTAL: ".$Total. "<br>";

?>
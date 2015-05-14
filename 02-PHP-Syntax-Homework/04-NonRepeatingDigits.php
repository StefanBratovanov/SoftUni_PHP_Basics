<?php

$number = 145;

if($number <= 101) {
    echo "no";
}
else if($number > 999) {
    $number = 999;
}
for ($i = 102; $i <= $number; $i++) {
    if(substr($i,0,1)!== substr($i,1,1) && substr($i,0,1)!== substr($i,2,1)&& substr($i,1,1)!== substr($i,2,1)) {
        echo($i.", ");
    }
}

?>




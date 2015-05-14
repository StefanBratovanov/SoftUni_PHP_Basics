<?php

$variable = 5;

if(is_double($variable) || is_integer($variable)) {
    echo var_dump($variable);
}
else {
    echo gettype($variable);
}

//if(gettype($variable) == integer || gettype($variable) == double) {
//    echo var_dump($variable);
//}
//else {
//    echo gettype($variable);
//}

?>
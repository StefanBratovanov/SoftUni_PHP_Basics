<?php

$arrows = $_GET["arrows"];
$arrows1 = $_GET["arrows1"];
$arrows2 = $_GET["arrows2"];
$arrows3 = $_GET["arrows3"];

$all = [$arrows, $arrows1, $arrows2, $arrows3];

$regex = '/(>{1,3})-----(>{1,2})/';

$countSmall = 0;
$countMedium = 0;
$countBig = 0;

foreach ($all as $ar) {
    preg_match_all($regex, $ar, $matches, PREG_SET_ORDER);

    foreach ($matches as $arr) {
        $tail = strlen($arr[1]);
        $tip = strlen($arr[2]);

        if ($tail === 3 && $tip === 2) {
            $countBig++;
        }
        if ($tail === 2 && $tip === 1) {
            $countMedium++;
        }
        if ($tail === 1 && $tip === 1) {
            $countSmall++;
        }
    }
}


$countDec = intval($countSmall . $countMedium . $countBig);

var_dump($countDec);


$countBin = decbin($countDec);
var_dump($countBin);

$binRev = strrev($countBin);
var_dump($binRev);

$binary = $countBin . $binRev;
var_dump($binary);

//echo $binRev;
$decimal = bindec($binary);

echo $decimal;








//$arrows = $_GET["arrows"];
//$arrows1 = $_GET["arrows1"];
//$arrows2 = $_GET["arrows2"];
//$arrows3 = $_GET["arrows3"];
//
//$all = $arrows ." ". $arrows1 ." ". $arrows2 ." ". $arrows3;
//$regex = '/(>{1,3})-----(>{1,2})/';
//
//$countSmall = 0;
//$countMedium = 0;
//$countBig = 0;
//
//
//
//preg_match_all($regex, $all, $matches, PREG_SET_ORDER);
//var_dump($matches);
//
//foreach ($matches as $arr) {
//    $tail = strlen($arr[1]);
//    $tip = strlen($arr[2]);
//
//    if ($tail == 3 && $tip == 2) {
//        $countBig++;
//    }
//    if ($tail == 2 && $tip == 1) {
//        $countMedium++;
//    }
//    if ($tail == 1 && $tip == 1) {
//        $countSmall++;
//    }
//}
//
//$countDec = intval($countSmall.$countMedium.$countBig);
//$countBin = decbin ($countDec);
//$binRev = strrev($countBin);
//$binary = $countBin.$binRev;
//
////echo $binRev;
//$decimal = bindec($binary);
//
//echo $decimal;




<?php

$size = $_GET["size"];
$textString = $_GET["text"];

$count = $size * $size;

$chars = str_split($textString);

$matrix = [];
$colStart = 0;
$colEnd = $size - 1;
$rowStart = 0;
$rowEnd = $size - 1;

$helpCounter = 0;

while ($helpCounter < $count) {
    for ($i = $colStart; $i <= $colEnd; $i++) {
        $matrix[$rowStart][$i] = $chars[$helpCounter];
        $helpCounter++;
    }
    for ($j = $rowStart + 1; $j <= $rowEnd; $j++) {
        $matrix[$j][$colEnd] = $chars[$helpCounter];
        $helpCounter++;
    }

    for ($i = $colEnd - 1; $i >= $colStart; $i--) {
        $matrix[$rowEnd][$i] = $chars[$helpCounter];
        $helpCounter++;
    }

    for ($j = $rowEnd - 1; $j >= $rowStart + 1; $j--) {
        $matrix[$j][$colStart] = $chars[$helpCounter];
        $helpCounter++;
    }

    $rowStart++;
    $rowEnd--;
    $colStart++;
    $colEnd--;
}

//for ($i = 0; $i < $size; $i++) {
//    for ($j = 0; $j < $size; $j++) {
//        $shit = $matrix[$i][$j];
//        echo $shit . " ";
//    }
//    echo "<br/>";
//}

$even = "";
$odd = "";


for ($i = 0; $i < $size; $i++) {
    for ($j = 0; $j < $size; $j++) {
        $shit = $matrix[$i][$j];

        if ($j % 2 == 0 && $i % 2 == 0) {
            $even .= $shit;
        } else if ($j % 2 == 1 && $i % 2 == 0){
            $odd .= $shit;
        }else if ($j % 2 == 0 && $i % 2 == 1){
            $odd .= $shit;
        }else if ($j % 2 == 1 && $i % 2 == 1){
            $even .= $shit;
        }
    }
}
$result = $even.$odd;
//echo $result."<br/>";

$result1 = strtolower($result);
$result1 = preg_replace("/[^a-zA-Z]/", "", $result1);

$rev = strrev($result1);

if ($rev === $result1) {
   echo "<div style='background-color:#4FE000'>$result</div>";
}
else {
    echo "<div style='background-color:#E0000F'>$result</div>";
}
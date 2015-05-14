<?php

$numbersString = $_GET["numbersString"];

//$nameRegex = "/([A-Z]{1,}[a-z]*)/";
//$numberRegex = "/(\+?\d+[\d\(\)\/\.\-\s\,]*\d+)/";

$totalRegex = "/([A-Z]{1,}[a-zA-Z]*)[^a-zA-Z\+]*?(\+?\d+[\d\(\)\/\.\-\s\,]*\d+)/";

preg_match_all($totalRegex, $numbersString, $matches);

//var_dump($matches);

$numbers = $matches[2];

if (empty($matches[2])) {
    echo "<p>No matches!</p>";
} else {
    $result = "<ol>";
    for ($i = 0; $i < count($matches[2]); $i++) {
        $name = $matches[1][$i];
        $number = preg_replace("/[\(\)\/\,\. -]/", "", $matches[2][$i]);
        $result .= "<li><b>$name:</b> $number</li>";
    }
    $result .= "</ol>";
    echo $result;
}



//var_dump($numbers);
//$number =  preg_replace("/[\(\)\/\,\. -]/","",$match[2]);

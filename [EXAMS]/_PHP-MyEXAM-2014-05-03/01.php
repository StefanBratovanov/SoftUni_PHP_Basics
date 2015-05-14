<?php

$data = $_GET["data"];

//$data = explode(",", $data);
$data1 = preg_split("/,/", $data, -1, PREG_SPLIT_NO_EMPTY);
$regex = '/mine (.*) (.*) (\d+)/';

//var_dump($data1);

$gold = 0;
$silver = 0;
$diamonds = 0;

$isValid = false;

foreach ($data1 as $line) {
    $line = trim($line);
    if (preg_match($regex, $line)) {
        $isValid = true;
    }
    if ($isValid) {
        preg_match($regex, $line, $matches);
        if (sizeof($matches) > 0) {
            $ore = strtolower($matches[2]);
            $amount = intval($matches[3]);

            if ($ore == "gold") {
                $gold += $amount;
            } else if ($ore == "silver") {
                $silver += $amount;
            } else if ($ore == "diamonds") {
                $diamonds += $amount;
            }
        }
    }
}

$output = "";
$output .= "<p>*Gold: $gold</p>";
$output .= "<p>*Silver: $silver</p>";
$output .= "<p>*Diamonds: $diamonds</p>";



echo $output;



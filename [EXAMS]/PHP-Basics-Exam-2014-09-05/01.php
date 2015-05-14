<?php

$text = $_GET["text"];
$red = $_GET["red"];
$green = $_GET["green"];
$blue = $_GET["blue"];
$nth = $_GET["nth"];

$redX = hexConvert($red);
$greenX = hexConvert($green);
$blueX = hexConvert($blue);

$color = "#$redX$greenX$blueX";

$output = "<p>";
for ($i = 0; $i < strlen($text); $i++) {
    $letter = $text[$i];
    if (($i + 1) % ($nth) == 0) {
        $output .= '<span style="color: ' . $color . '">' .htmlspecialchars($letter) . "</span>";
    } else {
        $output .= htmlspecialchars($letter);
    }
}
$output .= "</p>";
echo $output;


function hexConvert($number)
{
    $result = dechex($number);
    if ($number >= 0 && $number <= 15) {
        $result = "0" . $result;
    }
    return $result;
}
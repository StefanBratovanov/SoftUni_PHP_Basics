<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sum Of Digits</title>
    <style>
        body > table > tbody > tr > td:nth-child(2) {
            background: orange;
        }
    </style>
</head>
<body>
<form action="05-SumOfDigits.php" method="GET">
    <label for="input">Input string:</label>
    <input type="text" name="input" id="input"/>
    <input type="submit" name="submit"/>
</form>
</body>
</html>

<?php

if (isset($_GET["input"]) && isset($_GET["submit"])) {

    $items = explode(", ", $_GET["input"]);
    $output = "<table border='black'>";
    foreach ($items as $item) {
        if (is_numeric($item)) {
            $output .= "<tr><td>$item</td><td>" . sumDigits($item) . "</td></tr>";
        } else {
            $output .= "<tr><td>$item</td><td>" . "I cannot sum that" . "</td></tr>";
        }
    }

    echo $output;
}

function sumDigits($number)
{
    $sum = 0;
    $splitNum = str_split($number);
    foreach ($splitNum as $digit) {
        $sum += intval($digit);
    }
    return $sum;
}
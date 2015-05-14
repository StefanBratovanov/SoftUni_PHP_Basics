<?php

$keyString = $_GET["keys"];
$textString = $_GET["text"];

preg_match("/^[a-zA-z_]+(?=\d)/", $keyString, $startKeyArr);
preg_match("/(?<=\d)[a-zA-z_]+$/", $keyString, $endKeyArr);


if (!$startKeyArr || !$endKeyArr) {
    echo "<p>A key is missing</p>";
} else {
    $startKey = $startKeyArr[0];
    $endKey = $endKeyArr[0];

    $numberRegex = "/$startKey" . "(.*?)" . "$endKey/";

    preg_match_all($numberRegex, $textString, $matches);

    $values = $matches[1];
    $sum = 0;
    foreach ($values as $value) {
        if (is_numeric($value)) {
            $sum += $value;
        }
    }

    if ($sum !== 0) {
        echo "<p>The total value is: <em>$sum</em></p>";
    } else {
        echo "<p>The total value is: <em>nothing</em></p>";
    }
}
?>
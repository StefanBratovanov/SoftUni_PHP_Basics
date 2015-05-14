<?php

$input = json_decode($_GET['jsonTable']);

$words = $input[0];
$k = $input[1][0];
$s = $input[1][1];
$m = 26;

$rows = count($words);
$cols = findLongestWord($words);

$matrix = [];

foreach ($words as $line) {
    $matrix[] = str_split($line, 1);
}

for ($i = 0; $i < count($matrix); $i++) {
    while (count($matrix[$i]) < $cols) {
        $matrix[$i][] = "";
    }
}

for ($r = 0; $r < count($matrix); $r++) {
    for ($c = 0; $c < count($matrix[$r]); $c++) {
        $letter = $matrix[$r][$c];
        if ($letter === "") {
            $newLetter = "";
        } else {
            $asciiPos = ord($letter);
            if (($asciiPos >= 65 && $asciiPos <= 90) || ($asciiPos >= 97 && $asciiPos <= 122)) {
                $letter = strtolower($letter);
                $x = ord($letter) - 97;
                $newLetterCode = encode($k, $s, $m, $x);
                $newLetter = chr($newLetterCode + 97);
            }
        else {
            $newLetter = $letter;
        }


        }
        $matrix[$r][$c] = strtoupper($newLetter);
    }
}

printTable($matrix);

function printTable($matrix)
{
    echo "<table border='1' cellpadding='5'>";
    for ($row = 0; $row < count($matrix); $row++) {
        echo "<tr>";
        for ($col = 0; $col < count($matrix[$row]); $col++) {
            if ($matrix[$row][$col] !== "") {
                $cell = htmlspecialchars($matrix[$row][$col]);
                echo "<td style='background:#CCC'>" . $cell . "</td>";
            } else {
                $cell = "";
                echo "<td>" . $cell . "</td>";
            }
        }
        echo "</tr>";
    }
    echo "</table>";
}

//var_dump($matrix);
//echo json_encode($matrix);

function encode($k, $s, $m, $x)
{
    $output = ($k * $x + $s) % $m;
    return $output;
}

function findLongestWord($array)
{
    $maxLength = 0;
    for ($i = 0; $i < count($array); $i++) {
        $length = strlen($array[$i]);
        if ($length > $maxLength) {
            $maxLength = $length;
        }
    }
    return $maxLength;
}


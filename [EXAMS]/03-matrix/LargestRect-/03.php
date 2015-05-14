<?php

$matrix = json_decode($_GET["jsonTable"]);

var_dump($matrix);

$maxRow = count($matrix) - 1;
$maxCol = count($matrix[0]) - 1;

$startRowMax = 0;
$startColMax = 0;
$sizeBiggest = 1;

$row1Match = false;
$row2Match = false;
$col1Match = false;
$col2Match = false;

for ($row = 0; $row < count($matrix); $row++) {
    for ($col = 0; $col < count($matrix[$row]); $col++) {
        $charToCheck = $matrix[$row][$col];

        for ($i = $col; $i <= $maxCol; $i++) {
            if (!$matrix[$row][$i] == $charToCheck) {
                break;
            }
            $row1Match = true;
        }

        for ($j = $row; $j <= $maxRow; $j++) {
            if ($matrix[$j][$col] == $charToCheck) {
                $col1Match = true;
            }
        }



    }
}



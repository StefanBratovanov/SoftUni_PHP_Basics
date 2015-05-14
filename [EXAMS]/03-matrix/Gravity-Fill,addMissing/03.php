<?php

$text = $_GET["text"];
$lineLength = $_GET["lineLength"];
$strLength = strlen($text);

$matrix = [];
$rows = ceil($strLength / $lineLength);

//fill
for ($i = 0; $i < $rows; $i++) {
    $line = substr($text, ($i) * $lineLength, $lineLength);
    $matrix[] = str_split($line, 1);
}

//add missing spaces
for ($i = 0; $i < count($matrix); $i++) {
    while (count($matrix[$i]) < $lineLength) {
        $matrix[$i][] = " ";
    }
}

//var_dump($matrix);
//var_dump(count($matrix));


for ($r = $rows - 2; $r >= 0; $r--) {
    for ($c = 0; $c < $lineLength; $c++) {
        $charToMove = $matrix[$r][$c];

        for ($i = $r; $i < $rows - 1; $i++) {
            if ($matrix[$i + 1][$c] === " ") {
                $matrix[$i + 1][$c] = $charToMove;
                $matrix[$i][$c] = " ";
            } else break;
        }
    }
}
//var_dump($matrix);

$output = "<table>";
for ($i = 0; $i < count($matrix); $i++) {
    $output .= "<tr>";
    for ($j = 0; $j < count($matrix[$i]); $j++) {
        $output .= "<td>" . htmlspecialchars($matrix[$i][$j]) . "</td>";
    }
    $output .= "</tr>";
}

$output .= "<table>";

echo $output;



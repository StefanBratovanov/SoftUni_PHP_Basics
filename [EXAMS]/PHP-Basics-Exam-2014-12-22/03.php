<?php

$input = json_decode($_GET["jsonTable"]);

$cols = $input[0];
$infoArray = $input[1];
$letters = [];

for ($i = 1; $i < count($infoArray); $i++) {
    $line = explode(" ", $infoArray[$i]);
    preg_match("/\\d+/", $line[4], $numbers);
    $letterCode = $numbers[0];
    $letter = chr($letterCode);
    $letters[] = $letter;
}
$word = implode("", $letters);
$words = explode("*", $word);

echo "<table border='1' cellpadding='5'>";

foreach ($words as $key => $singleWord) {
    $numberSplitsOrRows = ceil(strlen($singleWord) / $cols);
    $charIndex = 0;

    for ($i = 0; $i < $numberSplitsOrRows; $i++) {
        echo "<tr>";
        for ($j = 0; $j < $cols; $j++) {
            if ($charIndex < strlen($singleWord) && $singleWord[$charIndex] != " ") {
                echo "<td style='background:#CAF'>" . htmlspecialchars($singleWord[$charIndex]) . "</td>";
            } else {
                echo "<td></td>";
            }
            $charIndex++;
        }
        echo "</tr>";
    }

}

echo "</table>";
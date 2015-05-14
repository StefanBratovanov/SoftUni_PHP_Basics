<?php

$luggage = $_GET["luggage"];
$typeLuggage = $_GET["typeLuggage"];
$roomFilter = $_GET["room"];
$minWeight = $_GET["minWeight"];
$maxWeight = $_GET["maxWeight"];

$pieces = preg_split('/C\|_\|/', $luggage, -1, PREG_SPLIT_NO_EMPTY);
//var_dump($pieces);

$allThings = [];

foreach ($pieces as $piece) {
    $info = explode(";", $piece);

    $luggageType = $info[0];
    $room = $info[1];
    $nameLugg = $info[2];
    $weightS = $info[3];
    preg_match("/[-+]?[0-9]*\\.?[0-9]+/", $weightS, $kgs);
    $weight = intval($kgs[0]);

    if (!array_key_exists($luggageType, $allThings) || (!array_key_exists($room, $allThings[$luggageType]))) {
        $allThings[$luggageType][$room][$weight][] = $nameLugg;
    } else {
        $oldKGs = key($allThings[$luggageType][$room]);
        $newKGs = $oldKGs + $weight;
        $allThings[$luggageType][$room][$newKGs] = $allThings[$luggageType][$room][$oldKGs];
        $allThings[$luggageType][$room][$newKGs][] = $nameLugg;
        unset($allThings[$luggageType][$room][$oldKGs]);
    }
}

ksort($allThings);

echo "<ul>";
foreach ($allThings as $type => $rooms) {
    ksort($rooms);
    $output = '';
    $print = false;
    if (in_array($type, $typeLuggage)) {
        $output .= '<li><p>' . $type . '</p>';
        foreach ($rooms as $room => $weights) {
            if ($room === $roomFilter) {
                $output .= "<ul><li><p>" . $room . "</p>";

                foreach ($weights as $weight => $thing) {
                    if ($weight >= $minWeight && $weight <= $maxWeight) {
                        asort($thing);
                        $output .= "<ul><li><p>" . implode(", ", $thing) . " - " . $weight . "kg</p></li></ul>";
                        $print = true;
                    }
                }
                $output .= '</li></ul>';
            }
        }
        $output .= '</li>';
    }
    if ($print) {
        echo $output;
    }
}

echo "</ul>";

//echo json_encode($allThings);

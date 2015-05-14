<?php

$text = $_GET["text"];
$minFontSize = $_GET["minFontSize"];
$maxFontSize = $_GET["maxFontSize"];
$step = $_GET["step"];

$output = "";

$font = $minFontSize;

$stateIncreasing = true;

for ($i = 0; $i < strlen($text); $i++) {
    $symbol = $text[$i];

    if (isEven($symbol)) {
        $decoration = "text-decoration:line-through;";
    } else {
        $decoration = "";
    }
    $output .= "<span style='font-size:$font;$decoration'>" . htmlspecialchars($symbol) . "</span>";

    if (ctype_alpha($symbol)) {
        if ($stateIncreasing) {
            $font += $step;
        } else {
            $font -= $step;
        }
        if ($font >= $maxFontSize || $font <= $minFontSize) {
            $stateIncreasing = !$stateIncreasing;
        }
    }
}

echo $output;

function isEven($char)
{
    if (ord($char) % 2 == 0) {
        return true;
    }
    return false;
}


//for ($i = 0; $i < strlen($text); $i++) {
//    $symbol = $text[$i];
//
//    if (isEven($symbol)) {
//        if (ctype_alpha($symbol)) {
//            $output .= "<span style='font-size:$font;text-decoration:line-through;'>" . htmlspecialchars($symbol) . "</span>";
//            if ($stateIncreasing) {
//                if ($font >= $maxFontSize) {
//                    $font -= $step;
//                    $stateIncreasing = !$stateIncreasing;
//                    continue;
//                }
//                $font += $step;
//            } else {
//                if ($font <= $minFontSize) {
//                    $font += $step;
//                    $stateIncreasing = !$stateIncreasing;
//                    continue;
//                }
//                $font -= $step;
//            }
//        } else  $output .= "<span style='font-size:$font;text-decoration:line-through;'>" . htmlspecialchars($symbol) . "</span>";
//    } else {
//        if (ctype_alpha($symbol)) {
//            $output .= "<span style='font-size:$font;'>" . htmlspecialchars($symbol) . "</span>";
//            if ($stateIncreasing) {
//                if ($font >= $maxFontSize) {
//                    $font -= $step;
//                    $stateIncreasing = !$stateIncreasing;
//                }
//                $font += $step;
//            } else {
//                if ($font <= $minFontSize) {
//                    $font += $step;
//                    $stateIncreasing = !$stateIncreasing;
//                }
//                $font -= $step;
//            }
//        } else $output .= "<span style='font-size:$font;'>" . htmlspecialchars($symbol) . "</span>";
//    }
//}
<?php

$childName = $_GET["childName"];
$wantedPresent = $_GET["wantedPresent"];
$riddles = $_GET["riddles"];

$arrayRiddles = explode(";", $riddles);
$realName = preg_replace("/\\s+/", "-", $childName);

$lenghtName = strlen($realName);

$keyRiddle = $lenghtName % count($arrayRiddles);

if ($keyRiddle == 0) {
    $theRiddle = $arrayRiddles[count($arrayRiddles)-1];
}
else {
    $theRiddle = $arrayRiddles[$keyRiddle - 1];
}

$output = "\$giftOf" . htmlspecialchars($realName) . " = \$[wasChildGood] ? '" . htmlspecialchars($wantedPresent) . "' : '" . htmlspecialchars($theRiddle) . "';";
echo $output;

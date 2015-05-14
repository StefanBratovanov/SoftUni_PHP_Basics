<?php

$list = $_GET["list"];
$maxSize=$_GET["maxSize"];

$lines = preg_split("/[\r\n]+/", $list, -1, PREG_SPLIT_NO_EMPTY);

$output = "<ul>";
foreach ($lines as $l) {
    $line = trim($l);
    $len =  strlen($line);

    if ($len >= $maxSize) {
        $output.="<li>".htmlspecialchars(substr($line,0,$maxSize))."...</li>";
    }
    else
        $output.="<li>".htmlspecialchars($line)."</li>";
}

$output .="</ul>";
echo $output;

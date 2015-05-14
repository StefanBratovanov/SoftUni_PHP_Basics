<?php

$namesString = $_GET["list"];
$length = $_GET["length"];
$show = isset($_GET["show"]);
$names = preg_split("/[\r\n]+/", $namesString, -1, PREG_SPLIT_NO_EMPTY);

echo "<ul>";
foreach ($names as $name) {
    if (strlen(trim($name)) >= $length) {
        echo "<li>".htmlspecialchars($name)."</li>";
    }
    else {
        if ($show) {
            echo "<li style=\"color: red;\">" . htmlspecialchars($name) . "</li>";
        }
    }
}
echo "</ul>";


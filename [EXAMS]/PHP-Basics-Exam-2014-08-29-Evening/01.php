<?php

$recipient = $_GET["recipient"];
$subject = $_GET["subject"];
$body = $_GET["body"];
$key = $_GET["key"];

$body = htmlspecialchars($body);
$recipient = htmlspecialchars($recipient);
$subject = htmlspecialchars($subject);

$mess = "<p class='recipient'>$recipient</p><p class='subject'>$subject</p><p class='message'>$body</p>";
$output = [];

for ($i = 0, $j = 0; $i < strlen($mess); $i++, $j++) {
    if ($j >= strlen($key)) {
        $j = 0;
    }
    $k = ord($key[$j]);
    $letter = ord($mess[$i]);

    $encr =dechex($k * $letter);
    $output[] = $encr;
}

$print = "|";
foreach ($output as $out) {
    $print.="$out|";
}

echo $print;
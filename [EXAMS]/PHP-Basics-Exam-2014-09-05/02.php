<?php

$text = $_GET["errorLog"];
$regEx = "/Exception in thread \".+\" java.*\.(\w+): .*\n\s+?at .+?\.(.*)\((.*)\.(.*):(.+)\)/";

preg_match_all($regEx, $text, $matches, PREG_SET_ORDER); //PREG_SET_ORDER !!!
//var_dump($matches);

$output = "<ul>";

foreach ($matches as $match) {
    $line = trim($match[5]);
    $name = trim($match[1]);
    $file = trim($match[3]);
    $ext = trim($match[4]);
    $method = trim($match[2]);
    $output .= "<li>line <strong>$line</strong> - <strong>" .
        htmlspecialchars($name) . "</strong> in <em>" .
        htmlspecialchars($file) . "." . htmlspecialchars($ext) . ":" .
        htmlspecialchars($method)."</em></li>";
}


$output .= "</ul>";

echo $output;



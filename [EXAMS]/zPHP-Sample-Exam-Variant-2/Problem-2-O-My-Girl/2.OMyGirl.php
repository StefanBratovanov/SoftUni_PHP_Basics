<?php
$text = $_GET['text'];
$keyString = $_GET['key'];

$key = array();

$key[0] = $keyString[0];

if(!ctype_alpha($keyString[0]) && !ctype_digit($keyString[0])){
    $key[0] = '\\'.$key[0];
}

for ($i = 1; $i < strlen($keyString) - 1; $i++) {

    if (ctype_digit($keyString[$i])) {
        $key[$i] = '\d*';
    } elseif (ctype_upper($keyString[$i])) {
        $key[$i] = '[A-Z]*';
    } elseif (ctype_lower($keyString[$i])) {
        $key[$i] = '[a-z]*';
    } else {
        $key[$i] = '\\' . $keyString[$i];
    }
}

$key[strlen($keyString) - 1] = $keyString[strlen($keyString) - 1];

if(!ctype_alpha($keyString[strlen($keyString) - 1]) && !ctype_digit($keyString[strlen($keyString) - 1])){
    $key[strlen($keyString) - 1]  = '\\'.$key[strlen($keyString) - 1];
}

$key = implode('', $key);

$pattern = '/' . $key . '(.{2,6})' . $key . '/';

preg_match_all($pattern, $text, $matches);

$address = implode('', $matches[1]);

echo $address;
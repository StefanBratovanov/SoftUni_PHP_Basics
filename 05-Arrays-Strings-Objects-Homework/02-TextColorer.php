<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Text Colorer</title>
</head>
<body>
<form action="02-TextColorer.php" method="get">
    <textarea name="input" id="input" cols="50" rows="10"></textarea>

    <p><input type="submit" name="submit" value="Color text"/></p>
</form>
</body>
</html>

<?php

if (isset($_GET["input"]) && isset($_GET["submit"])) {
    $input = $_GET["input"];

    $chars = preg_split('//', $input, -1, PREG_SPLIT_NO_EMPTY);
    $output = "";

    foreach ($chars as $char) {
        if ($char !== " ") {
            if (checkOdd($char)) {
                $output .= "<span style='color: blue'>" . chr(ord($char)) . "</span> ";
            } else {
                $output .= "<span style='color: red'>" . chr(ord($char)) . "</span> ";
            }
        }
    }
    echo $output;
}

function checkOdd($symbol)
{
    $ascii = ord($symbol);
    if ($ascii % 2 == 1) {
        return true;
    }
    return false;
}
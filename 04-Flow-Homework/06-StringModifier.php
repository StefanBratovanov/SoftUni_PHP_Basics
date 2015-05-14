<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>String Modifier</title>
</head>
<body>
<form action="06-StringModifier.php" method="get">
    <input type="text" name="string"/>
    <input type="radio" value="palindrome" name="check" id="palindrome" checked="checked"/>
    <label for="palindrome">Check Palindrome</label>
    <input type="radio" value="reverse" name="check" id="reverse"/>
    <label for="reverse">Reverse string</label>
    <input type="radio" value="split" name="check" id="split"/>
    <label for="split">Split</label>
    <input type="radio" value="hash" name="check" id="hash"/>
    <label for="hash">Hash string</label>
    <input type="radio" value="shuffle" name="check" id="shuffle"/>
    <label for="shuffle">Shuffle string</label>
    <input type="submit" name="submit"/>
</form>
</body>
</html>

<?php

if (isset($_GET["submit"])) {
    $input = $_GET["string"];
    $choice = $_GET["check"];
    $output = "";
    switch ($choice) {
        case "palindrome":
            if (checkPalindrome($input)) {
                $output .= htmlspecialchars($input) . " is a palindrome";
            } else {
                $output .= htmlspecialchars($input) . " is not a palindrome";
            }
            break;
        case "reverse":
            $output .= htmlspecialchars(strrev($input));
            break;
        case "split":
            preg_match_all("/[a-zA-Z]/", $input, $match);
            $output .= implode(" ", $match[0]);
            break;
        case "hash":
            if (CRYPT_BLOWFISH == 1) {
                $hash = crypt("$input", "$2y$");
            }
            $output .= $hash;
            break;
        case "shuffle":
            $output .= htmlspecialchars(str_shuffle($input));
            break;
        default:
            break;
    }
    echo $output;
}

function checkPalindrome($input)
{
    $reversedInput = strrev($input);
    if ($input === $reversedInput) {
        return true;
    }
    return false;
}
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Primes In Range</title>
</head>
<body>
<form action="04-PrimesInRange.php" method="GET">
    <label for="start">Starting Index:</label>
    <input type="text" name="start" id="start"/>
    <label for="end">End:</label>
    <input type="text" name="end" id="end"/>
    <input type="submit" name="submit"/>
</form>
</body>
</html>

<?php

if (isset($_GET["start"]) && isset($_GET["end"]) && isset($_GET["submit"])) {
    $start = $_GET["start"];
    $end = $_GET["end"];

    if (isPrime($start)) {
        echo "<b>$start</b>";
    } else {
        echo "$start";
    }
    $output = "";
    for ($i = $start + 1; $i <= $end; $i++) {
        if (isPrime($i)) {
            $output .= "<b>, $i</b>";
        } else {
            $output .= ", $i";
        }
    }

    echo $output;
}
function isPrime($number)
{
    $divider = 2;
    $maxDivider = sqrt($number);
    $prime = true;
    if ($number == 0 || $number == 1) {
        $prime = false;
        return $prime;
    } else {
        while (($divider <= $maxDivider) && $prime) {
            if ($number % $divider == 0) {
                $prime = false;
            }
            $divider++;
        }
        return $prime;
    }
}



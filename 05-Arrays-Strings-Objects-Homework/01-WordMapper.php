<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Word Mapper</title>
</head>
<body>
<form action="01-WordMapper.php" method="get">
    <textarea name="input" id="input" cols="50" rows="10"></textarea>

    <p><input type="submit" name="submit" value="Count words"/></p>
</form>
</body>
</html>

<?php

if (isset($_GET["input"]) && isset($_GET["submit"])) {
    $input = strtolower($_GET["input"]);

    preg_match_all("/[a-z]+/", $input, $matches);
    $wordsArray = $matches[0];
    $countWordsArray = array_count_values($wordsArray);

    $output = "<table border='black'>";
    foreach ($countWordsArray as $word => $count) {
        $output .= "</tr><td>" .htmlspecialchars($word) . "<td>" . $count . "</td></tr>";
    }
    $output .= "</table>";
    echo $output;
}

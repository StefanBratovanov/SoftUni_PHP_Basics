<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Print Tags</title>
</head>
<body>
<form action="02-Most-Frequent-Tag.php" method="get">
    <p>Enter Tags:</p>
    <input type="text" name="tags"/>
    <input type="submit"/>
</form>
</body>
</html>

<?php
if (isset($_GET['tags'])) {
    $input = $_GET['tags'];
    $arrayOfTags = explode(", ", $input);

    $countWordsArray = array_count_values($arrayOfTags);
    arsort($countWordsArray);

    foreach ($countWordsArray as $key => $value) {
        $tag = htmlentities($key);
        echo "$tag : $value times<br/>";
    }
    $sortedKeys = array_keys($countWordsArray);
    echo "The Most Frequent Tags is: ".$sortedKeys[0];
}
?>
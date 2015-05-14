<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Print Tags</title>
</head>
<body>
<form action="01-Print-Tags.php" method="get">
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
    for ($i = 0; $i < count($arrayOfTags); $i++) {
        $tag = htmlentities($arrayOfTags[$i]);
        echo "<p>".$i . ": " . $tag . "<p/>";
    }
}
?>
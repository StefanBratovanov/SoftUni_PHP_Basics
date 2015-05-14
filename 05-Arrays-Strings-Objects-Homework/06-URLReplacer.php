<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sentence Extractor</title>
</head>
<body>
<form action="06-URLReplacer.php" method="get">
    <textarea name="input" id="input" cols="50" rows="10"></textarea>

    <p><input type="submit" name="submit" value="Genrate Output"/></p>
</form>
</body>
</html>

<?php
if (isset($_GET["input"]) && isset($_GET["submit"])) {

    $text = $_GET["input"];
    $text = preg_replace('/<a href=\"(.*?)\">(.*?)<\/a>/','[URL=\1]\2[/URL]',$text);

    echo htmlspecialchars($text);
}

//$regex = "/<a href=\"(.*?)\">(.*?)<\/a>/";
//$replacement = "[URL=\1]\2[/URL]";
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sentence Extractor</title>
</head>
<body>
<form action="05-SentenceExtractor.php" method="get">
    <textarea name="text" id="text" cols="50" rows="10"></textarea>

    <p>
        <label for="word">word: </label>
        <input type="text" name="word" id="word"/>
    </p>

    <p><input type="submit" name="submit" value="Genrate Output"/></p>
</form>
</body>
</html>

<?php

if (isset($_GET["text"]) && isset($_GET["word"]) && isset($_GET["submit"])) {

    $text = $_GET["text"];
    $word = $_GET["word"];

    $regex = "/\\s?[^.!?]*" . "(\\s" . $word . "\\s)" . "[^.!?]*[.!?]/";

    preg_match_all($regex, $text, $matches);

    $sentences = $matches[0];
    foreach ($sentences as $sentence) {
        echo trim(htmlspecialchars($sentence))."<br/>";
    }

}
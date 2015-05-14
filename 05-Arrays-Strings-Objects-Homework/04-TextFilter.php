<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Text Filter</title>
</head>
<body>
<form action="04-TextFilter.php" method="get">
    <textarea name="text" id="text" cols="50" rows="10"></textarea>

    <p>
        <label for="banlist">banlist: </label>
        <input type="text" name="banlist" id="banlist"/>
    </p>

    <p><input type="submit" name="submit" value="Genrate Output"/></p>
</form>
</body>
</html>

<?php

if (isset($_GET["text"]) && isset($_GET["banlist"]) && isset($_GET["submit"])) {

    $text = $_GET["text"];
    $banlist = explode(", ", $_GET["banlist"]);


    foreach ($banlist as $ban) {
        $replacement = str_repeat("*", strlen($ban));
        $text = str_replace($ban, $replacement, $text);
    }

    echo htmlspecialchars($text);
}

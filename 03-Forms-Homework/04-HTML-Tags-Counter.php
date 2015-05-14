<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tags Counter</title>
</head>
<body>
<form action="04-HTML-Tags-Counter.php" method="post">
    <label for="tags">Enter HTML tags:</label>

    <div>
        <input type="text" name="tags" placeholder="Enter tags here"/>
        <input type="submit"/>

    </div>
</form>
<?php
session_start();
if (isset($_POST["tags"])) {
    $allTags = ["!DOCTYPE", "a", "abbr", "acronym", "address", "applet", "area", "article", "aside", "audio", "b",
        "base", "basefont", "bdi", "bdo", "big", "blockquote", "body", "br", "button", "canvas", "caption", "center",
        "cite", "code", "col", "colgroup", "command", "datalist", "dd", "del", "details", "dfn", "dir", "div", "dl",
        "dt", "em", "embed", "fieldset", "figcaption", "figure", "font", "footer", "form", "frame", "frameset", "h1",
        "h2", "h3", "h4", "h5", "h6", "head", "header", "hgroup", "hr", "html", "i", "iframe", "img", "input", "ins",
        "kbd", "keygen", "label", "legend", "li", "link", "map", "mark", "menu", "meta", "meter", "nav", "noframes",
        "noscript", "object", "ol", "optgroup", "option", "output", "p", "param", "pre", "progress", "q", "rp", "rt",
        "ruby", "s", "samp", "script", "section", "select", "small", "source", "span", "strike", "strong", "style",
        "sub", "summary", "sup", "table", "tbody", "td", "textarea", "tfoot", "th", "thead", "time", "title", "tr",
        "track", "tt", "u", "ul", "var", "video", "wbr"];

    if (!isset($_SESSION["score"])) {
        $_SESSION["score"] = 0;
    }
    if (!isset($_SESSION["tagsEntered"])) {
        $_SESSION["tagsEntered"] = [];
    }
    $inputTag = $_POST["tags"];
    if (in_array($inputTag, $allTags)) {
        if (!in_array($inputTag, $_SESSION["tagsEntered"])) {
            $_SESSION["score"]++;
            $_SESSION["tagsEntered"][] = $inputTag;
            //array_push($_SESSION["tagsEntered"], $inputTag);
            echo "<p><b>Valid HTML tag!</b></p>";
        }
        else {
            echo "<p><b>Already Entered tag!</b></p>";
        }
        echo "Score: ".$_SESSION["score"];
    }
    else {
        echo "<p><b>Invalid HTML tag!</b></p>";
        echo "Score: ".$_SESSION["score"];
        $_SESSION["tagsEntered"] = [];
        $_SESSION["score"] = 0;
    }


}

?>
</body>
</html>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sidebar Builder</title>
</head>
<body>
<form action="03-SidebarBuilder.php" method="get">
    <p>
        <label for="categories">Categories:</label>
        <input type="text" name="categories" id="categories"/>
    </p>

    <p>
        <label for="tags">Tags: </label>
        <input type="text" name="tags" id="tags"/>
    </p>

    <p>
        <label for="$tags">Months: </label>
        <input type="text" name="months" id="months"/>
    </p>
    <input type="submit" name="submit" value="Generate"/>
</form>
</body>
</html>

<?php
if (isset($_GET["categories"]) && isset($_GET["tags"]) && isset($_GET["months"]) && isset($_GET["submit"])) {

    $categories = explode(", ", $_GET["categories"]);
    $tags = explode(", ", $_GET["tags"]);
    $months = explode(", ", $_GET["months"]);

    $allTokens = ["Categories" => $categories, "Tags" => $tags, "Months" => $months];

    foreach ($allTokens as $key => $token) {
        printAside($key, $token);
    }


}

function printAside($key, $token)
{
    $heading = htmlspecialchars($key);
    $output = "<aside style='width: 200px; border: 1px solid lawngreen'><ul>";
    $output .= "<h3 style='text-decoration: underline; color: blue'>" . $heading . "</h3>";
    foreach ($token as $cat) {
        $output .= "<a href='#'><li>" . htmlspecialchars($cat) . "</li></a>";
    }
    $output .= "</ul></aside>";
    echo $output;
}

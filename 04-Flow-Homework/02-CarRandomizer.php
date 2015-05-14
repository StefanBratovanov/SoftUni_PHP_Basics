<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CarRandomizer</title>
</head>
<body>
<form action="02-CarRandomizer.php" method="GET">
    <label for="cars">Enter Cars:</label>
    <input type="text" name="cars" id="cars"/>
    <input type="submit" name="submit" value="Show results"/>
</form>
</body>
</html>
<?php

if (isset($_GET["cars"]) && isset($_GET["submit"])) {
    $cars = explode(", ", $_GET["cars"]);
    $colors = ["green", "blue", "yellow", "brown", "white", "red", "orange", "black", "pink"];
    $output = "";
    $output .= "<table border='1px black'>";
    $output .= "<tr><th>Car</th><th>Color</th><th>Count</th></tr>";

    foreach ($cars as $car) {
        $color = $colors[rand(0, count($colors) - 1)];
        $count = rand(1, 5);
        $output .= "<tr><td>" . htmlspecialchars($car) . "</td><td>$color" . "</td><td>$count</td></tr>";
    }
    $output .= "</table>";
}
echo $output;
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AnnualExpenses.php</title>
</head>
<body>
<form action="03-AnnualExpenses.php" method="GET">
    <label for="years">Enter number of years:</label>
    <input type="text" name="years" id="years"/>
    <input type="submit" name="submit" value="Show costs"/>
</form>
</body>
</html>

<?php

if (isset($_GET["years"]) && isset($_GET["submit"])) {

    $years = $_GET["years"];
    $yearNow = date("Y", strtotime("now"));
    $startMonth = date("F", strtotime("January"));

    $output = "";
    $output .= "<table border='1px black'>";
    $output .= "<tr><th>Year</th>";

    for ($i = 0; $i < 12; $i++) {
        $month = date("F", strtotime("$startMonth +$i month"));
        $output .= "<th>$month</th>";
    }
    $output .= "<th>Total</th></tr>";
    $sum = 0;

    for ($i = 0; $i < $years; $i++) {
        $yearToPrint = date("Y", strtotime("$yearNow -$i year"));
        $output .= "<tr><td>$yearToPrint</td>";
        for ($j = 0; $j < 12; $j++) {
            $cell = rand(0, 999);
            $sum += $cell;
            $output .= "<td>$cell</td>";
        }
        $output .= "<td>$sum</td></tr>";
        $sum = 0;
    }

    $output .= "</table > ";
    echo $output;
}
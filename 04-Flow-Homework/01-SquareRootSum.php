
<?php
echo "<table border='1px black'>";
echo "<tr><th>Number</th><th>Square</th></tr>";

$sum = 0;
for ($i = 0; $i <= 100; $i += 2) {
    $sq = round(sqrt($i), 2);
    $sum += $sq;
    echo "<tr><td>$i</td><td>$sq</td><tr>";
}
echo "<tr><th>Total:</th><td>$sum</td></tr>";
echo "</table>";
?>
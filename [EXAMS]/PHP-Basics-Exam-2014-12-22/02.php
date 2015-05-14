<?php
date_default_timezone_set('UTC');
$numbersString = $_GET['numbersString'];
$dateString = $_GET['dateString'];


preg_match_all("/[^a-zA-Z0-9](\\d+)[^a-zA-Z0-9]/", $numbersString, $match);
$sum = 0;
foreach ($match[1] as $item) {
    $sum += floatval($item);
}

preg_match_all("/\\d{4}-\\d{1,2}-\\d{2}/", $dateString, $matchDates);

//var_dump($matchDates[0]);
$increseWith = (floatval(strrev((string)$sum)));

if (count($matchDates[0]) == 0) {
    echo "<p>No dates</p>";
}
else {
    echo "<ul>";
    foreach ($matchDates[0] as $d) {
        $date = date_create($d);
        date_add($date, date_interval_create_from_date_string("$increseWith". " days"));
        $date = date_format($date, "Y-m-d");
        echo "<li>$date</li>";
    }
    echo "</ul>";
}



//else {
//    echo "<ul>";
//    foreach ($matchDates[0] as $d) {
//        $date = strtotime("+$increseWith day", strtotime($d));
//        $date = date("Y-m-d", $date);
//        echo "<li>$date</li>";
//    }
//    echo "</ul>";
//}
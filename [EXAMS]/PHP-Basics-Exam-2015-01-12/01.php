<?php
date_default_timezone_set("UTC");
$list = $_GET["list"];
$currDate = $_GET["currDate"];

//create Object
$current = DateTime::createFromFormat('d-m-Y', $currDate);

$dates = preg_split("/[\r\n]+/", $list, -1, PREG_SPLIT_NO_EMPTY);
$datesArr = [];

foreach ($dates as $date) {

    $single = date_parse($date);
    //var_dump($single);

    if ($single && $single['month'] && $single['year'] && $single['day']) {
        $month = $single['month'];
        $year = $single['year'];
        $day = $single['day'];

        $newDate = "$day" . "-" . "$month" . "-" . "$year";
        //$newDate = date("j/m/Y", mktime(0, 0, 0, $month, $day, $year));

        //create Object
        $datess = DateTime::createFromFormat('d-m-Y', $newDate);
        $datesArr[] = $datess;

    }
}
sort($datesArr);
//var_dump($datesArr);

echo "<ul>";

for ($i = 0; $i < count($datesArr); $i++) {

    $d = $datesArr[$i]->format('d/m/Y');

    if ($datesArr[$i] < $current) {
        echo "<li><em>$d</em></li>";
    } else {
        echo "<li>$d</li>";
    }
}

echo "</ul>";

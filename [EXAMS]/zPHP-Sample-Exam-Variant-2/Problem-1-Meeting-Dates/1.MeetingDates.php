<?php
if (isset($_GET["dateOne"]) && isset($_GET["dateTwo"])) {
    $dateOne = date_create($_GET["dateOne"], timezone_open("Europe/Sofia"));
    $dateTwo = date_create($_GET["dateTwo"], timezone_open("Europe/Sofia"));

    $dateStart = (($dateOne < $dateTwo) ? $dateOne : $dateTwo);
    $dateEnd = (($dateStart == $dateOne) ? $dateTwo : $dateOne);
    $currDate = $dateStart;
    $Thursdays = [];

    while ($currDate <= $dateEnd) {

        $weekDay = date_format($currDate, "D");
        if ($weekDay == "Thu") {
            $Thursdays[] = date_format($currDate, "d-m-Y");
            date_add($currDate, date_interval_create_from_date_string('7 days'));
            continue;
        }

        date_add($currDate, date_interval_create_from_date_string('1 day'));
    }

    if (empty($Thursdays)) {
        echo "<h2>No Thursdays</h2>";
    } else {
        echo "<ol>";
        foreach ($Thursdays as $Thursday) {
            echo "<li>$Thursday</li>";
        }
        echo "</ol>";
    }
}
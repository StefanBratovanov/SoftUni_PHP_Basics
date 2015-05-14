<?php
date_default_timezone_set("UTC");

$page = intval($_GET["page"]);
$pageSize = intval($_GET["pageSize"]);
$conferences = $_GET["conferences"];

preg_match_all('/\[(.*)\]/', $conferences, $confs);
$cons = $confs[1];

//var_dump($cons);

$isADate = false;
$isAValidDate = false;
$isAValidHash = false;
$isAValidName = false;
$isAValidLocation = false;
$isAValidAllTicket = false;
$isAValidSoldTicket = false;

$dateRegex = '/(^\d{4}-\d{2}-\d{2})|(^\d{4}\/\d{2}\/\d{2})/';
$hashRegex = '/#[a-zA-Z\.-]+/';
$nameRegex = '/\'(.*)\'/';
$locRegex = '/[a-zA-Z,-]+/';

$valid = [];

foreach ($cons as $con) {
    $items = explode(", ", $con);
    //var_dump($conf);

    $date = trim($items[0]);
    $hashTag = trim($items[1]);
    $name = trim($items[2]);
    $location = trim($items[3]);
    $allTicket = trim($items[4]);
    $soldTicket = trim($items[5]);


    if (preg_match($dateRegex, $date)) {
        $isADate = true;
        //echo $date . "<br>";
        $d = preg_split('/[-\/]/', $date);
        $month = $d[1];
        $day = $d[2];
        $year = $d[0];

        if (checkdate($month, $day, $year)) {
            $isAValidDate = true;
            //process date;
            $datE = date_create($date);
            //var_dump( $datE);
        }
    }
//hash tag
    preg_match($hashRegex, $hashTag, $hash);
    if (count($hash) > 0) {
        $isAValidHash = true;
        $eventHash = $hash[0];
        //var_dump($eventHash);
    }

    //fullName
    preg_match($nameRegex, $name, $nameConf);
    //var_dump($nameConf);
    if (count($nameConf) > 0) {
        $isAValidName = true;
        $eventName = $nameConf[1];
    }

    //location
    preg_match($locRegex, $location, $locConf);
    //var_dump($locConf);
    if (count($locConf) > 0) {
        $isAValidLocation = true;
        $eventLoc = $locConf[0];
        //      var_dump($eventLoc);
    }

    //tickets
    if (is_numeric($allTicket)) {
        $isAValidAllTicket = true;
        $allTicket = intval($allTicket);
        // var_dump($allTicket);
    }
    if (is_numeric($soldTicket)) {
        $isAValidSoldTicket = true;
        $soldTicket = intval($soldTicket);
        //var_dump($soldTicket);
    }

    if ($isADate && $isAValidDate && $isAValidHash && $isAValidName && $isAValidLocation && $isAValidAllTicket && $isAValidSoldTicket) {
        $valid[] = [$date, $eventName, $eventHash, $allTicket, $soldTicket];
    }

    $isADate = false;
    $isAValidDate = false;
    $isAValidHash = false;
    $isAValidName = false;
    $isAValidLocation = false;
    $isAValidAllTicket = false;
    $isAValidSoldTicket = false;

}

var_dump($valid);

//foreach ($matchDates[0] as $d) {
//    $date = date_create($d);
//    date_add($date, date_interval_create_from_date_string("$increseWith". " days"));
//    $date = date_format($date, "Y-m-d");
//    echo "<li>$date</li>";
//}
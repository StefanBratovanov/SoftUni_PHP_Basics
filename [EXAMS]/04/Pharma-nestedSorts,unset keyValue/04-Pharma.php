<?php

date_default_timezone_set("UTC");

$today = $_GET["today"];
$invoices = $_GET["invoices"];

$t = explode("/", $today);
$dateToday = $t[1] . "/" . $t[0] . "/" . $t[2];
$dateTodayInt = strtotime($dateToday);
//var_dump(date("d/M/Y", $dateTodayInt));

$filtered = [];

foreach ($invoices as $invoice) {
    $line = preg_split('/\s*\|\s*/', $invoice, -1, PREG_SPLIT_NO_EMPTY);
    //var_dump($line);

    $t = explode("/", trim($line[0]));
    $invoiceDateInt = strtotime($t[1] . "/" . $t[0] . "/" . $t[2]);
    //var_dump(date("d/M/Y", $currDateInt));
    $firm = trim($line[1]);
    $medicine = trim($line[2]);
    preg_match('/\d+\.*\d*/', trim($line[3]), $matches);
    $price = $matches[0]."";


    if ($invoiceDateInt >= strtotime("-5 years", $dateTodayInt)) {
        //fill filtered object

        if (!array_key_exists($invoiceDateInt, $filtered) || !array_key_exists($firm, $filtered[$invoiceDateInt])) {
            $filtered[$invoiceDateInt][$firm][$price] = [];
            $filtered[$invoiceDateInt][$firm][$price][] = $medicine;
        } else {
            $oldPrice = key($filtered[$invoiceDateInt][$firm]);
            $newPrice = ($oldPrice + $price) . "";
            $filtered[$invoiceDateInt][$firm][$newPrice] = $filtered[$invoiceDateInt][$firm][$oldPrice];
            $filtered[$invoiceDateInt][$firm][$newPrice][] = $medicine;
            unset ($filtered[$invoiceDateInt][$firm][$oldPrice]);
        }
    }
}

//print_r($filtered);
ksort($filtered);

$output = "<ul>";

foreach ($filtered as $date => $firm) {
    $output .= '<li><p>' . date("d/m/Y", $date) . "</p>";

    foreach ($firm as $name => $info) {
        $output .= "<ul><li><p>".htmlspecialchars($name)."</p>";

        foreach ($info as $price => $medicine) {
            asort($medicine);
            $output .= "<ul><li><p>" . implode(", ", $medicine) . "-" . "$price" . "lv</p></li></ul>";
        }
        $output .= "</li></ul>";
    }
    $output .= "</li>";
}

$output .= "</ul>";

echo $output;
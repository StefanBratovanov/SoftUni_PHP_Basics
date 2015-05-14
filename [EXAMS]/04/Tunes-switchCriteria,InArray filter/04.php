<?php

$text = $_GET["text"];
$artist = $_GET["artist"];
$property = $_GET["property"];
$order = $_GET["order"];

$songs = preg_split("/[\r\n]+/", $text, -1, PREG_SPLIT_NO_EMPTY);

$filtered = [];

foreach ($songs as $song) {

    $song = preg_split('/\s*\|\s*/', $song);
//    var_dump($song);

    $name = trim($song[0]);
    $genre = trim($song[1]);
    $artists = explode(", ", trim($song[2]));
    sort($artists);
    $artistsStr = implode(", ", $artists);
    $downloads = intval(trim($song[3]));
    $rating = floatval(trim($song[4]));

    if (in_array($artist, $artists)) {
        $filtered[] = [$name, $genre, $downloads, $rating, $artistsStr];
    }
}

//var_dump($filtered);

switch ($property) {
    case("name"):
        usort($filtered, 'sortName');
        break;
    case("genre"):
        usort($filtered, 'sortGenre');
        break;
    case("downloads"):
        usort($filtered, 'sortByDownloads');
        break;
    case("rating"):
        usort($filtered, 'sortByRating');
        break;
}

function sortName($tune1, $tune2)
{
    global $order;

    $result = strcmp($tune1[0], $tune2[0]);
    if ($order === "descending") {
        $result *= -1;
    }
    return $result;
}

function sortGenre($tune1, $tune2)
{
    global $order;
    $result = strcmp($tune1[1], $tune2[1]);
    if ($order === "descending") {
        $result *= -1;
    }
    if ($result == 0) {
        $result = strcmp($tune1[0], $tune2[0]);
    }
    return $result;
}


//true
function sortByDownloads($tune1, $tune2)
{
    global $order;
    $result = $tune1[2] - $tune2[2];
    if ($order === "descending") {
        $result *= -1;
    }
    if ($result == 0) {
        $result = strcmp($tune1[0], $tune2[0]);
    }
    return $result;
}

function sortByRating($tune1, $tune2)
{
    global $order;
    if ($order === "ascending") {
        $result = $tune1[3] > $tune2[3] ? 1 : -1;
    } else {
        $result = $tune1[3] < $tune2[3] ? 1 : -1;
    }
    if ($result == 0) {
        $result = strcmp($tune1[0], $tune2[0]);
    }

    return $result;
}

$output = "<table>\n";
$output .= "<tr><th>Name</th><th>Genre</th><th>Artists</th><th>Downloads</th><th>Rating</th></tr>\n";

foreach ($filtered as $tune) {
    $output .= "<tr>";
    $output .= "<td>" . htmlspecialchars($tune[0]) . "</td>";
    $output .= "<td>" . htmlspecialchars($tune[1]) . "</td>";
    $output .= "<td>" . htmlspecialchars($tune[4]) . "</td>";
    $output .= "<td>" . htmlspecialchars($tune[2]) . "</td>";
    $output .= "<td>" . htmlspecialchars($tune[3]) . "</td>";
    $output .= "</tr>\n";
}

$output .= "</table>";
echo $output;



//function sortByDownloads($tune1, $tune2)
//{
//    global $order;
//
//    if ($order === "ascending") {
//        $result = $tune1[2] - $tune2[2];
//    } else {
//        $result = $tune2[2] - $tune1[1];
//    }
//    if ($result == 0) {
//        $result = strcmp($tune1[0], $tune2[0]);
//    }
//
//    return $result;
//}
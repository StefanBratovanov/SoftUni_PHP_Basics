<?php

$list = $_GET["list"];
$minSeats = $_GET["minSeats"];
$maxSeats = $_GET["maxSeats"];
$filter = $_GET["filter"];
$order = $_GET["order"];

$regex = "/(.*): (.*) \((.*)\)- (.*) \/ (\d+)/";

$movies = preg_split("/[\r\n]+/", $list, -1, PREG_SPLIT_NO_EMPTY);

$outputMovies = [];

foreach ($movies as $movie) {
    $movie = preg_split("/[\(\)\-\/]/", $movie, -1, PREG_SPLIT_NO_EMPTY);
    //var_dump($movie);

    $name = trim($movie[0]);
    $genre = trim($movie[1]);
    $cast = explode(", ", trim($movie[2]));
    $seats = trim($movie[3]);

    $mov = [
        "name" => $name,
        "cast" => $cast,
        "seats" => $seats
    ];

    if (($seats >= $minSeats && $seats <= $maxSeats) && ($filter === $genre)) {
        $outputMovies[] = $mov;
    } else if (($seats >= $minSeats && $seats <= $maxSeats) && ($filter == 'all')) {
        $outputMovies[] = $mov;
    }

}

usort($outputMovies, function ($movieOne, $movieTwo) use ($order) {

    $result = strcmp($movieOne["name"], $movieTwo["name"]);
    if ($order == "descending") {
        $result *= -1;
    }
    if ($result == 0) {
        $result = $movieOne["seats"] - $movieTwo["seats"];
    }
    return $result;
});

//var_dump($outputMovies);
$output = "";


foreach ($outputMovies as $mov) {
    $name = htmlspecialchars($mov["name"]);
    $stars = ($mov["cast"]);
    $seats = $mov["seats"];

    $output .= '<div class="screening">';
    $output .= "<h2>$name</h2>";
    $output .= "<ul>";
    foreach ($stars as $star) {
        $output .= '<li class="star">'.htmlspecialchars($star)."</li>";
    }
    $output .= "</ul>";
    $output .= '<span class="seatsFilled">'.$seats.' seats filled</span>';

    $output .= "</div>";
}

echo $output;
<?php

date_default_timezone_set("UTC");

$input = $_GET["text"];
$minPrice = $_GET["min-price"];
$maxPrice = $_GET["max-price"];
$sort = $_GET["sort"];
$order = $_GET["order"];

//split by new line
$books = preg_split("/[\r\n]+/", $input, -1, PREG_SPLIT_NO_EMPTY);
//var_dump($books);

$matchedBooks = [];

foreach ($books as $book) {
    //split for the elements of each book
    $info = explode("/", $book);
    $author = $info[0];
    $title = $info[1];
    $genre = $info[2];
    $price = number_format($info[3],2,".","");
    $publishDateInt = strtotime($info[4]);
    $publishDateStr = date("Y-m-d", $publishDateInt);
    $resume = $info[5];

    //make object for each book
    $eachBook = [
        "title" => $title,
        "author" => $author,
        "genre" => $genre,
        "price" => $price,
        "publishDate" => $publishDateStr,
        "pubdateInt" => $publishDateInt,
        "resume" => $resume
    ];
    //fill the array by condition
    if ($price >= $minPrice && $price <= $maxPrice) {
        $matchedBooks[] = $eachBook;
    }
}

switch ($sort) {
    case("author"):
        usort($matchedBooks, 'sortByAuthor');
        break;
    case("genre"):
        usort($matchedBooks, 'sortByGenre');
        break;
    case("publish-date"):
        usort($matchedBooks, 'sortByDate');
        break;
}


function sortByAuthor($author1, $author2)
{
    global $order;
    $result = strcmp($author1["author"], $author2["author"]);
    if ($order === "descending") {
        $result *= -1;
    }
    if ($result == 0) {
        //if there are equal authors -> ascending sort by date
        $result = $author1["publishDate"] > $author2["publishDate"] ? 1 : -1;
    }
    return $result;
}

function sortByGenre($genre1, $genre2)
{
    global $order;
    $result = strcmp($genre1["genre"], $genre2["genre"]);
    if ($order === "descending") {
        $result *= -1;
    }
    if ($result == 0) {
        $result = $genre1["publishDate"] > $genre2["publishDate"] ? 1 : -1;
    }

    return $result;
}

function sortByDate($book1, $book2)
{
    global $order;
    if ($order === "ascending") {
        return $book1["publishDate"] > $book2["publishDate"] ? 1 : -1;
    } else {
        return $book1["publishDate"] < $book2["publishDate"] ? 1 : -1;
    }
}

//var_dump($matchedBooks);

$output = "";
foreach ($matchedBooks as $item) {
    $title = htmlspecialchars($item["title"]);
    $author = htmlspecialchars($item["author"]);
    $genre = htmlspecialchars($item["genre"]);
    $price = $item["price"];
    $publishDate = $item["publishDate"];
    $resume = htmlspecialchars($item["resume"]);

    $output .= "<div><p>$title</p><ul><li>$author</li><li>$genre</li><li>$price</li><li>$publishDate</li><li>$resume</li></ul></div>";
}
echo $output;



//function sortByAuthor($author1, $author2)
//{
//    $result = strcmp($author1["author"], $author2["author"]);
//    if ($result == 0) {
//        $result = sortByDate($author1, $author2);
//    }
//    return $result;
//}
//
//function sortByGenre($genre1, $genre2)
//{
//    $result = strcmp($genre1["genre"], $genre2["genre"]);
//    if ($result == 0) {
//        $result = sortByDate($genre1, $genre2);
//    }
//    return $result;
//}
//
//function sortByDate($book1, $book2)
//{
//    return $book1["publishDate"] > $book2["publishDate"] ? 1 : -1;
//}
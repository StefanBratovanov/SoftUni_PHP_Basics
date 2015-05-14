<?php

$list = $_GET["list"];
$maxPrice = $_GET["maxPrice"];
$minPrice = $_GET["minPrice"];
$filter = $_GET["filter"];
$order = $_GET["order"];

$products = preg_split("/[\r\n]+/", $list, -1, PREG_SPLIT_NO_EMPTY);

$filtered = [];
$id = 1;
foreach ($products as $product) {

    $tokens = explode(" | ", $product);
    $name = trim($tokens[0]);
    $type = trim($tokens[1]);
    $components = explode(", ", trim($tokens[2]));
    $price = number_format(trim($tokens[3]), 2, ".", "");

    if ($type === $filter || $filter === "all") {
        if ($price >= $minPrice && $price <= $maxPrice) {

            $filtered[] = [$name, $type, $components, $price, $id];
        }
    }
    $id++;
}

usort($filtered, function ($comp1, $comp2) use ($order) {
    if ($comp1[3] == $comp2[3]) {
        return $comp1[4] - $comp2[4];
    }

    return $order === "ascending" ^ $comp1[3] > $comp2[3] ? -1 : 1;

});

//var_dump($filtered);

$output = "";
foreach ($filtered as $product) {
    $output .= '<div class="product" id="product' . htmlspecialchars($product[4]) . '">' .
        '<h2>' . htmlspecialchars($product[0]) . '</h2>' . '<ul>';
    foreach ($product[2] as $component) {
        $output .= '<li class="component">' . htmlspecialchars($component) . '</li>';
    }
    $output .= '</ul>';
    $output .= '<span class="price">' . htmlspecialchars($product[3]) . '</span></div>';
}
echo $output;


//usort($filtered, function ($comp1, $comp2) use ($order) {
//
//    $result = $comp1[3] - $comp2[3];
//    if ($order === "descending") {
//        $result *= -1;
//    }
//    if ($result == 0) {
//        $result = $comp1[4] - $comp2[4];
//    }
//    return $result;
//});

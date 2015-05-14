<?php

$priceList = $_GET["priceList"];

$regEx = '/\s*<td>\s*(.*?)\s*<\/td>\s*<td>\s*(.*?)\s*<\/td>\s*<td>\s*(.*?)\s*<\/td>\s*<td>\s*(.*?)\s*<\/td>\s*/';

$all = [];

preg_match_all($regEx, $priceList, $matches, PREG_SET_ORDER);
//var_dump($matches);

foreach ($matches as $match) {
    $name = html_entity_decode (trim($match[1]));
    $category = html_entity_decode (trim($match[2]));
    $price = html_entity_decode (trim($match[3]));
    $currency = html_entity_decode (trim($match[4]));

    $currProduct = ["product" => $name, "price" => $price, "currency" => $currency];
    //var_dump($currProduct);
    if (!array_key_exists($category, $all)) {
        $all[$category] = [];
    }
    $all[$category][] = $currProduct;
}

ksort($all);

foreach ($all as $key => $value) {
    usort($value, function ($a, $b) {
        return strcmp($a['product'], $b['product']);
    });
    $all[$key] = $value;
}

echo json_encode($all);


<?php

$code = $_GET["code"];

$code = htmlentities($code);

$varRegex = '/(\$\w+)/';
$forRegex = '/(for\s*\(.*\))/';
$whileRegex = '/(while\s*\(.*\))/';
$forEach = '/(foreach\s*\(.*\))/';
$ifRegex = '((if|else if)\s*\(.*\))';

$all = [];

preg_match_all($varRegex, $code, $variables);
$vars = [];
foreach ($variables[0] as $key => $value) {
    $vars[] = $value;
}
$v = array_count_values($vars);
//VARS - word -> count;
//var_dump($v);

preg_match_all($forRegex, $code, $fors);
$forsLoops = $fors[0];
//var_dump($forsLoops);

preg_match_all($whileRegex, $code, $whiles);
$whileLoops = $whiles[0];
//var_dump($whileLoops);

preg_match_all($forEach, $code, $foreaches);
$foreachLoops = $foreaches[0];
//var_dump($whileLoops);
//var_dump($foreachLoops);

preg_match_all($ifRegex, $code, $ifs);
$ifLoops = $ifs[0];
//var_dump($ifLoops);

if (!array_key_exists("variables", $all) || !array_key_exists("loops", $all) || !array_key_exists("conditionals", $all)) {
    $all["variables"] = [];
    $all["loops"] = [];
    $all["conditionals"] = [];
}

if (!array_key_exists("while", $all["loops"]) || (!array_key_exists("for", $all["loops"])) || (!array_key_exists("foreach", $all["loops"]))) {
    $all["loops"]["while"] = [];
    $all["loops"]["for"] = [];
    $all["loops"]["foreach"] = [];
}

foreach ($whileLoops as $key => $value) {
    if (!array_key_exists("while", $all["loops"])) {
        $all["loops"]["while"] = [];
    }
    $all["loops"]["while"][] = htmlspecialchars_decode($value);
}

foreach ($forsLoops as $key => $value) {
    if (!array_key_exists("for", $all["loops"])) {
        $all["loops"]["for"] = [];
    }
    $all["loops"]["for"][] = htmlspecialchars_decode($value);
}
 
foreach ($foreachLoops as $key => $value) {
    if (!array_key_exists("foreach", $all["loops"])) {
        $all["loops"]["foreach"] = [];
    }
    $all["loops"]["foreach"][] = htmlspecialchars_decode($value);
}

foreach ($ifLoops as $key => $value) {
    $all["conditionals"][] =  htmlspecialchars_decode($value);
}

foreach ($v as $key => $value) {
    $all["variables"][$key] = $value;
}

echo json_encode($all);
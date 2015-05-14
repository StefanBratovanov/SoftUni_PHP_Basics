<?php

$text = $_GET["text"];

//$match = preg_split("/([^a-zA-Z])/", $text);
//preg_match_all("/[a-zA-Z]+/", $text, $matches);
//var_dump($match);
//var_dump($matches);

$outputWord = "<p>";

$line = preg_replace_callback('/[a-zA-Z]+/', "chechUpperAndPali", $text);
//var_dump($line);

$outputWord.=htmlspecialchars($line);
$outputWord.= "</p>";

echo $outputWord;

function chechUpperAndPali($words)
{
    foreach ($words as $word) {
        if (ctype_upper($word)) {
            $changedWord = strrev($word);
            if ($changedWord === $word) {
                $changedWord = "";
                for ($i = 0; $i < strlen($word); $i++) {
                    $changedWord .= "$word[$i]$word[$i]";
                }
            }
            $word = $changedWord;
        }
        return $word;
    }
}

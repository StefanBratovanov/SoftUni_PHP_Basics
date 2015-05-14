<?php
date_default_timezone_set('UTC');
$text = $_GET["text"];
$regex = '/\s*([a-zA-z -]+)\s*%\s*([a-zA-z\. -]+)\s*;\s*(\d{2}\s*-\s*\d{2}\s*-\s*\d{4}\s*)-\s*(.+)/';

preg_match_all($regex, $text, $matches, PREG_SET_ORDER);

//var_dump($matches);

$output = "";

foreach ($matches as $match) {
    $topic = trim($match[1]);
    $author = trim($match[2]);
    $date = trim($match[3]);
    $summary = trim($match[4]);

    $month = date('F', strtotime($date));
    if (strlen($summary) > 100) {
        $summary = substr($summary,0,100)."...";
    }
    else $summary .= "...";

    $output.= "<div>\n";
    $output.= "<b>Topic:</b> <span>".htmlspecialchars($topic)."</span>\n";
    $output.= "<b>Author:</b> <span>".htmlspecialchars($author)."</span>\n";
    $output.= "<b>When:</b> <span>".htmlspecialchars($month)."</span>\n";
    $output.= "<b>Summary:</b> <span>".htmlspecialchars($summary)."</span>\n";

    $output.= "</div>\n";
}

echo $output;

//$date = date_create_from_format('j-M-Y', '15-Feb-2009');
//echo date_format($date, 'Y-m-d');
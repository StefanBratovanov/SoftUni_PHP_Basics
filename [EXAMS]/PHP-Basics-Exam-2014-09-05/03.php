<?php
date_default_timezone_set("UTC");

$text = $_GET["text"];

$posts = preg_split("/[\r\n]+/", $text, -1, PREG_SPLIT_NO_EMPTY);
//var_dump($posts);

$postsByDate = [];

foreach ($posts as $post) {
    $post = explode(";", $post);
    //var_dump($post);
    $author = trim($post[0]);
    $dateArr = explode("-", trim($post[1]));
    $date = date_create("$dateArr[2]-$dateArr[1]-$dateArr[0]");
    $date = date_format($date, 'j F Y');
    $dateAsInt = strtotime($date);
  //  echo $dateAsInt;
    $message = trim($post[2]);
    $likes = trim($post[3]);
    if ($post[4]) {
        $comments = explode("/", trim($post[4]));
       // var_dump($comments);
    }

    $postsByDate[$dateAsInt] = printHtml($author, $date, $message, $likes, $comments);
}

//var_dump($postsByDate);
krsort($postsByDate);

implode("", $postsByDate);

$result = "";
foreach ($postsByDate as $post) {
    $result .= $post;
}
echo $result;

//echo implode("", $postsByDate);

function printHtml($author, $date, $message, $likes, $comments)
{
    $output = "<article><header><span>";
    $output .= htmlspecialchars($author) . "</span><time>$date</time>";
    $output .= "</header><main><p>" . htmlspecialchars($message) . "</p></main>";
    $output .= '<footer><div class="likes">';
    $output .= "$likes people like this</div>";

    if (count($comments) > 0) {
        $output .= '<div class="comments">';
        foreach ($comments as $comment) {
                $output .= "<p>" . htmlspecialchars(trim($comment)) . "</p>";
        }
    }
    $output .= '</div>';

    $output .= "</footer></article>";
    return $output;
}
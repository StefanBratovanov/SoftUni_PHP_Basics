<?php

$input = $_GET["html"];

$divRegEx = '/<(div\s+).*((id|class)\s*\=\s*\"(.*?)\").*?>/';
$closingTagRegex = '/(<\/div>\s+<!--\s*?(.*?)\s*?-->)/';

preg_match_all($divRegEx, $input, $matches);
//var_dump($matches);

$semanticTags = ['main', 'header', 'nav', 'article', 'section', 'aside', 'footer'];
$tagsToReplace = $matches[0];
//var_dump($tagsToReplace);

foreach ($tagsToReplace as $key => $tag) {
    $fullAttribute = $matches[2][$key];
    $attribute = $matches[4][$key];

    if (in_array($attribute, $semanticTags)) {
        $replacedTag = str_replace('div', $attribute, $tag);
        $replacedTag = str_replace($fullAttribute, "", $replacedTag);
        $replacedTag = preg_replace('/\s*>/', '>', $replacedTag);
        $replacedTag = preg_replace("/\\s{2,}/", ' ', $replacedTag);

        $input = str_replace($tag, $replacedTag, $input);
       // var_dump($input) ;
    }
}

preg_match_all($closingTagRegex, $input, $closingsTags);
//var_dump($closingsTags);

$closingTagsToReplace = $closingsTags[0];
//var_dump($closingTagsToReplace);

foreach ($closingTagsToReplace as $key => $closingTag) {
    $replacedTag = str_replace($closingTag,"</".trim($closingsTags[2][$key]).">", $closingTag);
    //var_dump($replacedTag);
    $input = str_replace($closingTag, $replacedTag, $input);
}
echo $input;
<?php

echo date("jS F, Y", strtotime("first Sunday of ".date("M")." ".date('Y')))."\n";
echo date("jS F, Y", strtotime("second Sunday of ".date('M')." ".date('Y')))."\n";
echo date("jS F, Y", strtotime("third Sunday of ".date('M')." ".date('Y')))."\n";
echo date("jS F, Y", strtotime("fourth Sunday of ".date('M')." ".date('Y')))."\n";

if(date("jS F, Y", strtotime("last Sunday of ".date('M')." ".date('Y'))) === date("jS F, Y", strtotime("fifth Sunday of ".date('M')." ".date('Y'))) ){
    echo date("jS F, Y", strtotime("fifth Sunday of ".date('M')." ".date('Y')));
}
?>
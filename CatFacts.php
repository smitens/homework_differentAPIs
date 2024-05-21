<?php
include("useAPI.php");

$catRandomFacts = new CatFacts("https://cat-fact.herokuapp.com");
$fact = json_decode($catRandomFacts->getRandomFacts('cat', 1));
if (isset($fact->text)) {
    echo $fact->text . "\n";
} else {
    echo "Error getting fact!\n";
}
<?php
include ("useAPI.php");

$name = readline ("Enter Your first name: ");

$nameAge = new NameFacts("https://api.agify.io", $name);
$response = json_decode($nameAge->getNameFacts());
if (isset($response->error)) {
    echo $response->error . "\n";
} else {
    echo "- $response->name is $response->age years old name. \n- $response->count people have this name. \n";
}
echo "\n";
$nameGender = new NameFacts("https://api.genderize.io", $name);
$response = json_decode($nameGender->getNameFacts());
if (isset($response->error)) {
    echo $response->error . "\n";
} else {
    echo "- Name $response->name is $response->gender with " . $response->probability * 100 . "% certainty. \n";
}
echo "\n";
$nameNationality = new NameFacts("https://api.nationalize.io/", $name);
$response = json_decode($nameNationality->getNameFacts());
if (isset($response->error)) {
    echo $response->error . "\n";
} else {
    echo "- Name $response->name is from " . $response->country[0]->country_id . " with " .
        round($response->country[0]->probability * 100,0) . "% certainty. \n";
}
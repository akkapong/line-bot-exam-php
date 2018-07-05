<?php


$access_token = 'FetFmZCPdNnWyowKNXIwZlFnZd8F3OK8O4h0JxLtZgvjOaAvhXNG9oe8iZwhyK5IdQdZzkXTJdW7hT+665l9Ud5JRIsMbs/kY10BD1dfi+v7YoFNlxAjeWauV5TivF/EfzEprLEI/ynUOhgkn2SKgAdB04t89/1O/w1cDnyilFU=';

$userId = 'U451fc85ea12260354a24d5c20e035b09';

$url = 'https://api.line.me/v2/bot/profile/'.$userId;

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;


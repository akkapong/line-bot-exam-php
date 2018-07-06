<?php
require "vendor/autoload.php";
require "MyBot.php";
// $access_token = 'FetFmZCPdNnWyowKNXIwZlFnZd8F3OK8O4h0JxLtZgvjOaAvhXNG9oe8iZwhyK5IdQdZzkXTJdW7hT+665l9Ud5JRIsMbs/kY10BD1dfi+v7YoFNlxAjeWauV5TivF/EfzEprLEI/ynUOhgkn2SKgAdB04t89/1O/w1cDnyilFU=';
// $channelSecret = '166fe404020820ee2de356dc939170a6';
// $idPush = 'U451fc85ea12260354a24d5c20e035b09';

// $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
// $bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channelSecret]);
// $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello world');
// $response = $bot->pushMessage($idPush, $textMessageBuilder);

// echo $response->getHTTPStatus() . ' ' . $response->getRawBody();

// echo "\n===================\n";

$bot = new MyBot();
echo $bot->manageTexMessage("push", [$idPush], "Test 1")

// echo "\n===================\n";

// $bot->pushMessage($idPush, "Test 2")
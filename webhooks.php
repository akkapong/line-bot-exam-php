<?php // callback.php

require "vendor/autoload.php";
require_once('vendor/linecorp/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');

$access_token = 'FetFmZCPdNnWyowKNXIwZlFnZd8F3OK8O4h0JxLtZgvjOaAvhXNG9oe8iZwhyK5IdQdZzkXTJdW7hT+665l9Ud5JRIsMbs/kY10BD1dfi+v7YoFNlxAjeWauV5TivF/EfzEprLEI/ynUOhgkn2SKgAdB04t89/1O/w1cDnyilFU=';

$master = 'U451fc85ea12260354a24d5c20e035b09';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);

function replyMessage($messages, $replyToken) {
	
	// Make a POST Request to Messaging API to reply to sender
	$url = 'https://api.line.me/v2/bot/message/reply';
	$data = [
		'replyToken' => $replyToken,
		'messages'   => [$messages]
	];
	$post    = json_encode($data);
	$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $GLOBALS['access_token']);

	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	$result = curl_exec($ch);
	curl_close($ch);

	return $result . "\r\n";
}

// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$sender = $event['source']['userId'];

			// Get replyToken
			$replyToken = $event['replyToken'];

			$messages = [
				'type' => 'text',
				'text' => ""
			];

			switch ($event['message']['text']) {
				// case "$dunfull" : 
				// 	$messages['text'] = "";
				// 	break;
				case "$hello" :
					$messages['text'] = "Hello !!";
					break;
				default:
					$messages = [];
					break;
			}
			
			if (!$messages) {
				echo replyMessage($messages, $replyToken);
			} else {
				//test
								// Make a POST Request to Messaging API to reply to sender
				$url = 'https://api.line.me/v2/bot/message/reply';
				$data = [
					'replyToken' => $replyToken,
					'messages'   => [[
										'type' => 'text',
										'text' => "TEST"
									]]
				];
				$post    = json_encode($data);
				$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

				$ch = curl_init($url);
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
				curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
				$result = curl_exec($ch);
				curl_close($ch);

				echo $result . "\r\n";
			}



		}
	}
}


echo "OK";

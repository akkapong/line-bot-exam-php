<?php // callback.php

require "MyBot.php";

$list = ["U451fc85ea12260354a24d5c20e035b09"];

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);

function getMessage($event) {
	$mode    = "none";
	
	$message = "Reply : ".$event['message']['text'];
	
	$command = $event['message']['text'];

	switch ($command) {
		case "[hello]":
			$mode    = "reply";
			$message = "Hello!!";
			break;
		case "[wai]":
			$mode    = "reply";
			$message = "I am a bot!!";
			break;
		case "[userid]":
			$mode    = "reply";
			$message = "Your ID: ".$event['source']['userId'];
			break;
		case "[full]":
			$mode    = "push";
			$message = "Test push";
			break;
	}

	return [$mode, $message];
}

// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$sender     = $event['source']['userId'];
			
			// Get replyToken
			$replyToken = $event['replyToken'];

			//get message and mode
			list($mode, $message) = getMessage($event);

			//skip if don't know command
			if ($mode == "none") continue;

			$bot      = new MyBot();
			$recevier = [$replyToken];

			if ($mode == "push") {
				$recevier = $list;
			}

			$res = $bot->manageTexMessage($mode, $recevier, $message);
			echo $res;
		}
	}
}


echo "OK";

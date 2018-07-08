<?php // callback.php

require "MyBot.php";

require "members.php";

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
			$message = "ดันเต็มแล้วนะครับ!!";
			break;
		case "[fight]":
			$mode    = "push";
			$message = "จู่โจมกิลด์ตั๋งโต๊ะ แต้มถึง 36 แล้วจ้า";
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

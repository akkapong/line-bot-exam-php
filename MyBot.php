<?php
require "vendor/autoload.php";

class MyBot() {

	private $access_token = 'FetFmZCPdNnWyowKNXIwZlFnZd8F3OK8O4h0JxLtZgvjOaAvhXNG9oe8iZwhyK5IdQdZzkXTJdW7hT+665l9Ud5JRIsMbs/kY10BD1dfi+v7YoFNlxAjeWauV5TivF/EfzEprLEI/ynUOhgkn2SKgAdB04t89/1O/w1cDnyilFU=';
	private $channelSecret = '166fe404020820ee2de356dc939170a6';

	private $bot;

	function __construct() {
		$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($this->access_token);
		$this->bot  = new \LINE\LINEBot($httpClient, ['channelSecret' => $this->channelSecret]);
	}

	public function pushMessage($pushID, $message) {
		$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($message);
		$response           = $this->bot->pushMessage($pushID, $textMessageBuilder);

		return $response->getHTTPStatus() . ' ' . $response->getRawBody();

	}

	public function replyMessage($replyToken, $message) {
		$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($message);
		$response           = $this->bot->replyText($replyToken, $textMessageBuilder);

		return $response->getHTTPStatus() . ' ' . $response->getRawBody();

	}

	public function manageTexMessage($mode, $tos, $message) {
		$res = "";
		foreach ($tos as $to) {
			switch ($mode) {
				case "reply":
					$res = $this->replyMessage($to, $message);
					break;
				case "push":
					$res = $this->pushMessage($to, $message);
					break;
				default:
					$res = "";
					break;
			}
		}
		return $res;
	}
} 










<?php 

//$access_token = "0iUcdcZOrWfzqmAsJvL+4w71v+DKgg+a+QKnZZuu4kO02zRaG03ei2FS1VUgz5M8C0ip/IwOQC7HQMZTHche5CpJUWaxvHjnVH9/uCNcmgvxBbBmLU4zLZ9fg1CQbRCdXPxWN/zGwm48V83918r2kwdB04t89/1O/w1cDnyilFU=";
//$access_token = "Q5JtYUSsKcDOw2qt1WBLFe7pAv+lq1HH1TpkokYfhc5SSk9fUOJxh1ijHkNDq5SKiPjQRsbtrujAG4YyCZK4zecc1a8cfUvJ2bHnDrZ0GBN25DRFJFd7SPJ94CpK7lquMxeGhLAL79jfEpWYh+gPMAdB04t89/1O/w1cDnyilFU=";
$access_token = "DBSY+rfxqfzGO26aJtKFoVPUqimxWuZ7DZaZX0kpltZVZ+sQrNMG+9qb1KjELbqXr/rvJb9LbH+xbUbP7KRMlW0ucrd0vFF4Nz7238rB59CUFKmFLT7Q1dplgAjBf1704K9jA9gLkdFVSscHcKKZqwdB04t89/1O/w1cDnyilFU=";
// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent

			$text = "User ID is : ".$event['source']['userId'] ."Group Id : ".$event['source']['groupId'];
			
			$msg = $event['message']['text'];
			$check_msg = explode(":",$msg);
			if( count($check_msg) > 1 ){
				
			}
			// Get replyToken
			$replyToken = $event['replyToken'];

			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => $text
			];

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
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

?>

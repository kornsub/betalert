<?php 
//$access_token = "0iUcdcZOrWfzqmAsJvL+4w71v+DKgg+a+QKnZZuu4kO02zRaG03ei2FS1VUgz5M8C0ip/IwOQC7HQMZTHche5CpJUWaxvHjnVH9/uCNcmgvxBbBmLU4zLZ9fg1CQbRCdXPxWN/zGwm48V83918r2kwdB04t89/1O/w1cDnyilFU=";
$access_token = "DBSY+rfxqfzGO26aJtKFoVPUqimxWuZ7DZaZX0kpltZVZ+sQrNMG+9qb1KjELbqXr/rvJb9LbH+xbUbP7KRMlW0ucrd0vFF4Nz7238rB59CUFKmFLT7Q1dplgAjBf1704K9jA9gLkdFVSscHcKKZqwdB04t89/1O/w1cDnyilFU=";

			// Get text sent

			$text = "Report \n".$_GET['text'];
			$To = "U50db648d0798f19ff5708e8a4e992b08";

			//$text = "Robot Test Push Massage ?";
			//$To = "C2f6acfc9f271f5422b1a4c1eb71b27b7";

			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => $text
			];

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/push';
			$data = [
				'to' => $To,
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


echo "OK_push2";
?>

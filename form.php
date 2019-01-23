<?php

//sleep(5); // For demo purpose

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['postEmail']) && isset($_POST['postName']) && isset($_POST['postMessage'])){
$email = strtolower($_POST['postEmail']);
$name = $_POST['postName'];
$message = $_POST['postMessage'];

	if ($name == "" || $email == "" || $message == "") {
		http_response_code(400);
		echo "Fill all required fields!";
	}
	elseif (strlen($name) < 3) {
		http_response_code(411);
		echo "Name must be not less than 2 characters";
	}
	elseif (strlen($name) > 25) {
		http_response_code(413);
		echo "Name must be less than 26 characters";
	}
	elseif(!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z0-9-]{2,20})$^",$email)){
			http_response_code(400);
			echo "Enter the correct e-mail";
	}
	elseif (strlen($message) < 5) {
		http_response_code(411);
		echo "Message must be not less than 5 characters";
	}
	elseif (strlen($message) > 300) {
		http_response_code(413);
		echo "Message must be less than 300 characters";
	}
	else
	{
		// All form data looks good, so lets start curl to Google form:
		$url = 'https://docs.google.com/forms/d/e/1FAIpQLSfzM7cvQazK0b2hlPt5zFFjMncvMA6Io904DstCGfH75J1uuw/formResponse';

		// Fix for cyrillic variables with urlencode:
		$myvars = 'emailAddress=' . urlencode($email) . '&entry.1224778685=' . urlencode($name).'&entry.512804397=' . urlencode($message);

		$ch = curl_init( $url );
		curl_setopt( $ch, CURLOPT_POST, 1);
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $myvars);
		curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt( $ch, CURLOPT_HEADER, 1);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

		// grab URL and pass it to the browser
		$response = curl_exec( $ch );
		
		$responseinfo = curl_getinfo($ch);

		// close cURL resource, and free up system resources
		curl_close($ch);
		
		if($responseinfo["http_code"] == 200){
			http_response_code(200);
			echo "Form received.";
		}
		else{
			http_response_code(421);
			echo "Form not received, please try again or contact with us by phone";
		}
	}
}
else{
	http_response_code(406);
	echo "Provide all required data: postEmail, postName, postMessage";
}
?>
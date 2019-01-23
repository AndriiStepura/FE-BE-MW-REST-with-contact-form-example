<?php
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
		// All form data looks good, so:
		http_response_code(200);
		echo "Data valid";
	}
}
else{
	http_response_code(406);
	echo "Provide all required data: postEmail, postName, postMessage";
}
?>
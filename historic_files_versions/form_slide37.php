<?php
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['postEmail']) && isset($_POST['postName']) && isset($_POST['postMessage'])){
$email = $_POST['postEmail'];
$name = $_POST['postName'];
$message = $_POST['postMessage'];

	if ($name == "" || $email == "" || $message == "") {
		http_response_code(400);
		echo "Fill all required fields!";
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
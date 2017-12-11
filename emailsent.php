<!DOCTYPE html>
<html lang="en-US">
    <head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Final Project - Modern Peeps">
		<meta name="author" content="Sergio Rodriguez, The Ngo, Vinh Le">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<link rel="stylesheet" href="style.css">
		<title>Modern Peeps</title>
	</head>
	<body>
		
		
		
		<!--Send the a message with a link to change password maybe send the hashed pw as a get or something
		then check database for the email and password 
		then contents of the message is to click link and input new password
		then output message "Password reset instructions have been send to EMAIL@EMAIL.COM please follow instructions"-->
		
		
		
		<?php
			// The message
			$message = "Line 1\r\nLine 2\r\nLine 3";
			
			// In case any of our lines are larger than 70 characters, we should use wordwrap()
			$message = wordwrap($message, 70, "\r\n");
			
			// Send
			mail('caffeinated@example.com', 'My Subject', $message);
		?>
		
		
	</body>
</html>
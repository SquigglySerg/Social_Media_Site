<?php
	// define variables and set to empty values
	$email = "";
	$emailErr = "";
	
	if($_SERVER["REQUEST_METHOD"] == "POST") {
	  
	  if (empty($_POST["email"])) {
		$emailErr = "Email is required";
	  } else {
		$email = test_input($_POST["email"]);
		// check if e-mail address is well-formed
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		  $emailErr = "Invalid email format";
		}
		else {
		  $emailErr = "";
		}
	  }
	  
	  if($emailErr == ""){ //Email entered is valid
		//Connect to the DB
		$servername = "localhost"; //Using my local database for testing -Sergio
		$username = "serodrig";
		$password = "AAIOWYSM";
		$dBName = "f17_serodrig";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dBName);

		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		
		$userQuery = "SELECT email FROM Users WHERE email = ?";
		$stmt = $conn->prepare($userQuery);
		$stmt->bind_param("s", $email);
		$stmt->execute();

		//Check if the customer exist, if not prevent password change
		if($stmt->fetch()){
			//User exist send email with password reset
			$stmt->close();
			
			//Obtained the stored hashed password in the database
			$userPSWQuery = "SELECT password FROM Users WHERE email = ?";
			$pswStmt = $conn->prepare($userPSWQuery);
			$pswStmt->bind_param("s", $email);
			$pswStmt->execute();
			
			$pswResult = $pswStmt->get_result();
			if($pswResult->num_rows == 1){
				if($hash = $pswResult->fetch_assoc()){ //Get the password
					$hash2 = "http://luna.mines.edu/serodrig/passwordreset.php?reset=" . $hash["password"] . "&email=" . $email; 
					
					// The message
					$message = "Click the link below to reset your password\r\n\r\n" . $hash2 . "\r\n\r\nIf you did not request this ignore this message";
					
					// In case any of our lines are larger than 70 characters, we should use wordwrap()
					$message = wordwrap($message, 70, "\r\n");
					
					// Send
					mail($email, 'Modern Peeps: Password Reset', $message);
					
					redirect("./login.php");
				}
			}
		}
		else{
			//User does not exist
			$stmt->close();
			$emailErr = "Email not in records";
		}
	  }
	  
	}
	
	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}	
	
	function redirect($url) {
	  ob_start();
	  header('Location: '.$url);
	  ob_end_flush();
	  die();
	}
?>

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
?>

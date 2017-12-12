<?php
	// define variables and set to empty values
	$email = $psw = "";
	$emailErr = $pswErr = $authenticationErr = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	  
	  if (empty($_POST["email"])) {
		$emailErr = "Email is required";
	  } else {
		$email = test_input($_POST["email"]);
		// check if e-mail address is well-formed
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		  $emailErr = "Invalid email format";
		  $authenticationErr = $emailErr;
		}
		else {
			$emailErr = "";
		}
	  }
	  
	  if (empty($_POST["psw"])) {
		$pswErr = "Password required";
	  } else {
		$psw = test_input($_POST["psw"]);
		$pswErr = "";
	  }
	  
	  if($emailErr == "" && $pswErr == ""){ //Submition made and stripped of odd characters
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

		//Check if the customer exist, if not prevent access
		if($stmt->fetch()){
			//User Exist, so check password
			
			
			$hash = '$2y$07$BCryptRequires22Chrcte/VlQH0piJtjXl.0t1XkA8pw9dMXTpOq';
			
			if (password_verify($psw, $hash)) {
				//Password is valid
				
				redirect("./index.php");
			} 
			else {
				//Invalid password
				$authenticationErr = "User or password incorrect";
			}
			
		}
		else{
			//User does not exist, so deny access
			$authenticationErr = "User not recognised";
		}
		
		$stmt->close();
		$conn->close();
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
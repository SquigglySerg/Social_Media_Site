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
			$stmt->close(); //Have to close before the nextquery
			
			//First obtained the stored hashed password on the database
			$userPSWQuery = "SELECT password, verified FROM Users WHERE email = ?";
			$pswStmt = $conn->prepare($userPSWQuery);
			$pswStmt->bind_param("s", $email);
			$pswStmt->execute();
			
			$pswResult = $pswStmt->get_result();
			if($pswResult->num_rows == 1){
				if($hash = $pswResult->fetch_assoc()){ //Get the password
					//Check if user is verified
					if($hash["verified"] == true){
						//User Verified
					
						//Check if it is correct
						if (password_verify($psw, $hash["password"])) {
							//Password is valid
							$_SESSION["email"] = $email;
							redirect("./profile.php");
						} 
						else {
							//Invalid password
							$authenticationErr = "Email or password incorrect";
						}
					}
					else{
						//User not verified
						$authenticationErr = "Email or password incorrect";
					}
				}
			}
			
			$pswStmt->close();
		}
		else{
			//User does not exist, so deny access
			$authenticationErr = "Email or password incorrect";
			$stmt->close();
		}
		
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
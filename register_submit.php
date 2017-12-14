<?php
	// define variables and set to empty values
	$fnameErr = $lnameErr = $emailErr = $pswErr = "";
	$fname = $lname = $email = $psw = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	  if (empty($_POST["fname"])) {
		$fnameErr = "Name is required";
	  } else {
		$fname = test_input($_POST["fname"]);
		// check if name only contains letters and whitespace
		if (!preg_match("/^[a-zA-Z ]*$/",$fname)) {
		  $fnameErr = "Only letters and white spaces allowed";
		}
		else {
			$fnameErr = "";
		}
	  }
	  
	  if (empty($_POST["lname"])) {
		$lnameErr = "Name is required";
	  } else {
		$lname = test_input($_POST["lname"]);
		// check if name only contains letters and whitespace
		if (!preg_match("/^[a-zA-Z ]*$/",$lname)) {
		  $lnameErr = "Only letters and white spaces allowed";
		}
		else {
			$lnameErr = "";
		}
	  }
	  
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
	  
	  if (empty($_POST["psw"])) {
		$pswErr = "Password required";
	  } else {
		$psw = test_input($_POST["psw"]);
		// check if password meets necessary requirements
		// At least one number, one letter, or at least one of the following !@#$% and of length 8-36
		if (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,36}$/', $psw)) {
		  $pswErr = "Password must contain at least one number, one letter, or one of the following !@#$% and be 8-36 characters long.";
		}
		else {
		  $pswErr = "";
		}
	  }
	  
	  if($fnameErr == "" && $lnameErr == "" && $emailErr == "" && $pswErr == ""){ //Submition valid
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

		//Check if the customer exist, if not create customer
		if($stmt->fetch()){
			//User Exist
			$emailErr = "Email already in use";
			$stmt->close();
		}
		else{
			$stmt->close();
			
			//Create user
			$addCustomerQuery = "INSERT INTO Users (email, firstName, lastName, password, verified) VALUES (?,?,?,?,?)";
			$stmtAddCustomer = $conn->prepare($addCustomerQuery);
			
			//Hash Password
			$pswHash = password_hash($psw, PASSWORD_DEFAULT);
			
			$verified = false;
			$stmtAddCustomer->bind_param("sssss", $email, $fname, $lname, $pswHash, $verified);
			$stmtAddCustomer->execute();
			$stmtAddCustomer->close();
			
			//Create user profile shell
			$addCustomerProfileQuery = "INSERT INTO User_Profile (intro, hobbies, music, avatar, email) VALUES (?,?,?,?,(SELECT email FROM Users WHERE email = ?))";
			$stmtAddCustomerProfile = $conn->prepare($addCustomerProfileQuery);
			
			$intro = "Go to editinfo to change intro";
			$hobbies = "Go to editinfo to change hobbies";
			$music = "Go to editinfo to change music";
			$avatar = "";
			
			$stmtAddCustomerProfile->bind_param("sssss", $intro, $hobbies, $music, $avatar, $email);
			$stmtAddCustomerProfile->execute();
			$stmtAddCustomerProfile->close();
			
			//Send verification email
			$msgLink = "http://luna.mines.edu/serodrig/emailverify.php?email=" . $email . "&code=" . $pswHash;
			$message = "Click the link below to verify your email\r\n\r\n" . $msgLink; // The message
			
			// In case any of our lines are larger than 70 characters, we should use wordwrap()
			$message = wordwrap($message, 70, "\r\n");
			
			// Send
			mail($email, 'Modern Peeps: Email Verification', $message);
	
			//Redirect to the login screen
			redirect("./emailverify.php");
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
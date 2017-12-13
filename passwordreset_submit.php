<?php
	$hash = $email = $pswErr = "";
	
	//Get the passed in emall
	if(isset($_GET['email'])){
		$email = $_GET['email'];
		echo "STUFF OBTAINED FROM SESSSION";
	}
	
	//Get the passed in hash for the password reset
	if(isset($_GET['reset'])){
		$hash = $_GET['reset'];
		echo "STUFF OBTAINED FROM SESSSION";
	}
	
	//Check the session
	$time = $_SERVER['REQUEST_TIME'];

	//for a 30 minute timeout, specified in seconds
	$timeout_duration = 1800;

	//look for the user's LAST_ACTIVITY timestamp.
	if (isset($_SESSION['LAST_ACTIVITY']) && 
	   ($time - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
		session_unset();
		session_destroy();
		session_start();
		
		if($email == "" || $hash == "" && isset($_SESSION["hash"]) && isset($_SESSION["email"])){
			$email = $_SESSION["email"];
			$hash = $_SESSION["hash"];
			echo "STUFF OBTAINED FROM SESSSION";
		}
	}

	//LAST_ACTIVITY
	$_SESSION['LAST_ACTIVITY'] = $time;
	
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		
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
		
		if($email != "" && $hash != ""){
			$_SESSION["email"] = $email;
			$_SESSION["hash"] = $hash;
			echo "";
		}
		
		if($pswErr == "" && $email != "" && $hash != ""){
			
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

			//Check the email, if the user exist check the hash
			if($stmt->fetch()){
				//User exist, check passed hash
				$stmt->close();
				
				//Obtained the stored hashed password in the database and compare with the passed hash
				$userPSWQuery = "SELECT password FROM Users WHERE email = ?";
				$pswStmt = $conn->prepare($userPSWQuery);
				$pswStmt->bind_param("s", $email);
				$pswStmt->execute();
				
				$pswResult = $pswStmt->get_result();
				if($pswResult->num_rows == 1){
					if($hash2 = $pswResult->fetch_assoc()){ //Get the Hash
						echo "PASSWORD CHANGGES";
					}
				}
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
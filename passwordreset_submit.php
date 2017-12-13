<?php
	$pswErr = $email = $hash = "";
	session_set_cookie_params(900,"/");
	session_start(); 
	
	//Get the passed in emall
	if(isset($_GET['email'])){
		$email = test_input($_GET['email']);
		$_SESSION["email"] = $email;
	}
	
	//Get the passed in hash for the password reset
	if(isset($_GET['reset'])){
		$hash = test_input($_GET['reset']);
		$_SESSION["hash"] = $hash;
	}
	
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		if (empty($_POST["psw"])) {
			$pswErr = "Password required";
		} 
		else {
			$psw = test_input($_POST["psw"]);
			// check if password meets necessary requirements
			// At least one number, one letter, and can only be numbers or letter or one of the following !@#$% and of length 8-36
			if (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,36}$/', $psw)) {
			  $pswErr = "Password must contain at least one number, one letter, and can only be numbers, letter or one of the following !@#$% and must be 8-36 characters long";
			}
			else {
			  $pswErr = "";
			}
		}
		
		if(!empty($_SESSION["email"]) && !empty($_SESSION["hash"]) ){
			$hash = test_input($_SESSION["hash"]);
			$email = test_input($_SESSION["email"]);
		}
		
		if($pswErr == "" && $email != "" && $hash != ""){
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
						if($hash2["password"] == $hash){
							//Hash is correct; allow password change
							$pswUpdateQuery = "UPDATE Users SET password = ? WHERE email = ?";
							$pswUpdateStmt = $conn->prepare($pswUpdateQuery);
							
							//Hash Password
							$pswHash = password_hash($psw, PASSWORD_DEFAULT);
							
							$pswUpdateStmt->bind_param("ss", $pswHash, $email);
							$pswUpdateStmt->execute();
							$pswUpdateStmt->close();
							$pswStmt->close();
							
							unset($_SESSION['hash']);
							unset($_SESSION['email']);
							session_destroy();
							
							redirect("./login.php");
						}
						else{
							echo "HACKS!!!!";
						}
					}
				}else{
					$pswStmt->close();
				}
			}
			else{
				//User not found
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
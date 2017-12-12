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
		// At least one number, one letter, or one of the following !@#$% and of length 8-36
		if (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,36}$/', $psw)) {
		  $pswErr = "Password must contain at least one number, one letter, or one of the following !@#$% and be 8-36 characters long.";
		}
		else {
			$pswErr = "";
		}
	  }
	  
	  if($fnameErr == "" && $lnameErr == "" && $emailErr == "" && $pswErr == ""){
		echo "<p>" . $fname . " " . $lname . " " . $email . " " . $psw . "</p>";
	  }
	  
	}
	
	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
?>
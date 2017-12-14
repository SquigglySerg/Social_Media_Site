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
		<script src="script.js"></script>
		<?php
			$active = "emailverify";
			include './header.php';
		?>
		<div id="login" class="loginbox">
			<div class="loginbox-content">
			<?php 
				if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['code']) && !empty($_GET['code'])){
					// Verify data
					$email = test_input($_GET['email']); // Set email variable
					$hash = test_input($_GET['code']); // Set hash variable
					
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
					
					//Check if the customer exist, if not invalid email
					if($stmt->fetch()){
						//User Exist
						$stmt->close();
						
						$verified = true;
						$verificationQuery = "UPDATE Users SET verified = ? WHERE email = ?";
						$verificationStmt = $conn->prepare($verificationQuery);
						$verificationStmt->bind_param("ss", $verified, $email);
						$verificationStmt->execute();
						
						echo "<p> Email Verifed</p>";
					}
					else{
						$stmt->close();
					}
				}else{
					// Invalid approach
					echo "<p> Check your email for a message from www-data@mines.edu and click the link.</p>";
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
			</div>
		</div>
		<?php include "footer.php";?>
	</body>
</html>

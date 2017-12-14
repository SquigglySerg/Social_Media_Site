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
		<?php
			$active = "profile";
			include './header.php';
		?>
		<div class="profile_info">
			<div class="profile_image">
			</div>
		
			<img id="img" src="" alt="" style="display:none;">
			<br><br>
		
			<br>
			<div id="intro">
				Introduction
			</div>		
			
			<br>
			<div id="hobbies">
				Hobbies
			</div>
			<br>
			<div id="music">
				Music
			</div>
		</div>
		
	</body>
<?php
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
                session_start();
                $email = $_SESSION["email"];
		
		// Fill in the image
		$userQuery = "SELECT avatar FROM User_Profile WHERE email LIKE ?";
                $stmt = $conn->prepare($userQuery);
                $stmt->bind_param("s", $email);
                $stmt->execute();
		$result = $stmt->get_result();	
                $stmt->close();
		while($row = $result->fetch_assoc()) {
			$image = $row["avatar"];
			echo "<script>";
			echo "document.getElementById('img').src = '".$image."';";
			echo "document.getElementById('img').style = 'display: block;';";
                        echo "document.getElementsByClassName('profile_image')[0].style = 'display: none;';";

			echo "</script>";
		}

		// Fill in the intro box
		$userQuery = "SELECT intro FROM User_Profile WHERE email LIKE ?";
                $stmt = $conn->prepare($userQuery);
                $stmt->bind_param("s", $email);
                $stmt->execute();
		$result = $stmt->get_result();	
                $stmt->close();
		while($row = $result->fetch_assoc()) {
			$intro = $row["intro"];
			echo "<script>";
			echo "document.getElementById('intro').innerHTML = '".$intro."';";
			echo "</script>";
		}

		// Fill in the hobbies box
		$userQuery = "SELECT hobbies FROM User_Profile WHERE email LIKE ?";
                $stmt = $conn->prepare($userQuery);
                $stmt->bind_param("s", $email);
                $stmt->execute();
		$result = $stmt->get_result();	
                $stmt->close();
		while($row = $result->fetch_assoc()) {
			$hobbies = $row["hobbies"];
			echo "<script>";
			echo "document.getElementById('hobbies').innerHTML = '".$hobbies."';";
			echo "</script>";
		}

		// Fill in the music box
		$userQuery = "SELECT music FROM User_Profile WHERE email LIKE ?";
                $stmt = $conn->prepare($userQuery);
                $stmt->bind_param("s", $email);
                $stmt->execute();
		$result = $stmt->get_result();	
                $stmt->close();
		while($row = $result->fetch_assoc()) {
			$music = $row["music"];
			echo "<script>";
			echo "document.getElementById('music').innerHTML = '".$music."';";
			echo "</script>";
		}	
		$conn->close();
	?>
</html>

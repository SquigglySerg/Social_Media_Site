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
	<script>
		function changeColor() {
			// Connect to database
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
			$email = $_SESSION["email"];				

			if(document.getElementById('background_colors').value == "cyan") {
                        	document.getElementById("profile_info").style = "background-color: cyan";
                		$userQuery = "UPDATE User_Profile SET background = 'cyan' WHERE email = ?";
                		$stmt = $conn->prepare($userQuery);
                		$stmt->bind_param("s", $email);
                		$stmt->execute();			
				
                	}   	
			else if(document.getElementById('background_colors').value == "yellow") {
                        	document.getElementById("profile_info").style = "background-color: yellow";
                		$userQuery = "UPDATE User_Profile SET background = 'yellow' WHERE email = ?";
                		$stmt = $conn->prepare($userQuery);
                		$stmt->bind_param("s", $email);
                		$stmt->execute();			
                	}   	
			else if(document.getElementById('background_colors').value == "red") {
                        	document.getElementById("profile_info").style = "background-color: red";
                		$userQuery = "UPDATE User_Profile SET background = 'red' WHERE email = ?";
                		$stmt = $conn->prepare($userQuery);
                		$stmt->bind_param("s", $email);
                		$stmt->execute();			
                	}
			$stmt->close();
			$conn->close();   	
		}
	
		function changeImage() {
			// Connect to database
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
			$email = $_SESSION["email"];

			if(document.getElementById('images').value == "cat") {
                        	document.getElementById("img").src = "images/cat.jpg";
                		$userQuery = "UPDATE User_Profile SET avatar = 'images/car.jpg' WHERE email = ?";
                		$stmt = $conn->prepare($userQuery);
                		$stmt->bind_param("s", $email);
                		$stmt->execute();			
                	}   	
			else if(document.getElementById('images').value == "dog") {
                        	document.getElementById("img").src = "images/dog.jpg";
                		$userQuery = "UPDATE User_Profile SET avatar = 'images/car.jpg' WHERE email = ?";
                		$stmt = $conn->prepare($userQuery);
                		$stmt->bind_param("s", $email);
                		$stmt->execute();			
                	}   	
			else if(document.getElementById('images').value == "turtle") {
                        	document.getElementById("img").src = "images/turtle.jpg";
                		$userQuery = "UPDATE User_Profile SET avatar = 'images/car.jpg' WHERE email = ?";
                		$stmt = $conn->prepare($userQuery);
                		$stmt->bind_param("s", $email);
                		$stmt->execute();			
                	}   	
			$stmt->close();
			$conn->close();   	
		}
	</script>
	<body>
		<div id="profile_info">
			<div id="profile_image">
			<img id="img" src="" alt="#">
			</div>
			
			<div id="intro">
			Introduction
			</div>		
			
			<div id="hobbies">
			Hobbies
			</div>
			
			<div id="music">
			Music
			</div>
			
			<div id="selectors">
				<select id="images" onChange="changeImage()">
					<option value="none">Select an Avatar Image</option>
					<option value="cat">Cat</option>
					<option value="dog">Dog</option>
					<option value="turtle">Turtle</option>
				</select>
			
				<select id="background_colors" onChange="changeColor()">
					<option value="none">Select a Background Color</option>
					<option value="cyan">Cyan</option>
					<option value="yellow">Yellow</option>
					<option value="red">Red</option>
				</select>
			</div>
		</div>
		
	</body>
</html>

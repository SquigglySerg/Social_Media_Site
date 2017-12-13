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
			if(document.getElementById('background_colors').value == "cyan") {
                        	document.getElementById("profile_info").style = "background-color: cyan";
                	}   	
			else if(document.getElementById('background_colors').value == "yellow") {
                        	document.getElementById("profile_info").style = "background-color: yellow";
                	}   	
			else if(document.getElementById('background_colors').value == "red") {
                        	document.getElementById("profile_info").style = "background-color: red";
                	}
		}

		function changeImage() {
			if(document.getElementById('images').value == "cat") {
                        	document.getElementById("img").src = "images/cat.jpg";
                	}   	
			else if(document.getElementById('images').value == "dog") {
                        	document.getElementById("img").src = "images/dog.jpg";
                	}   	
			else if(document.getElementById('images').value == "turtle") {
                        	document.getElementById("img").src = "images/turtle.jpg";
                	}   	
		}
		
		function submitChanges() {
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

			// update avatar image path 
			$avatar = "<script>document.getElementById('img').src<//script>"
        	        $userQuery = "UPDATE User_Profile SET avatar = ? WHERE email LIKE ?";
                	$stmt = $conn->prepare($userQuery);
                	$stmt->bind_param("ss", $avatar, $email);
                	$stmt->execute();
			$stmt->close();
			
			// update background color 
			$color = "<script>document.getElementById('background_colors').value<//script>"
        	        $userQuery = "UPDATE User_Profile SET background = ? WHERE email LIKE ?";
                	$stmt = $conn->prepare($userQuery);
                	$stmt->bind_param("ss", $color, $email);
                	$stmt->execute();
			$stmt->close();

			// update avatar image path 
			$intro = "<script>document.getElementById('text1').value<//script>"
        	        $userQuery = "UPDATE User_Profile SET avatar = ? WHERE email LIKE ?";
                	$stmt = $conn->prepare($userQuery);
                	$stmt->bind_param("ss", $intro, $email);
                	$stmt->execute();
			$stmt->close();

			// update avatar image path 
			$hobbies = "<script>document.getElementById('text2').value<//script>"
        	        $userQuery = "UPDATE User_Profile SET avatar = ? WHERE email LIKE ?";
                	$stmt = $conn->prepare($userQuery);
                	$stmt->bind_param("ss", $hobbies, $email);
                	$stmt->execute();

			// update avatar image path 
			$music = "<script>document.getElementById('text3').value<//script>"
        	        $userQuery = "UPDATE User_Profile SET avatar = ? WHERE email LIKE ?";
                	$stmt = $conn->prepare($userQuery);
                	$stmt->bind_param("ss", $music, $email);
                	$stmt->execute();
			$stmt->close();
			$intro = "<script>document.getElementById('').src<//script>"
        	        $userQuery = "UPDATE User_Profile SET avatar = ? WHERE email LIKE ?";
                	$stmt = $conn->prepare($userQuery);
                	$stmt->bind_param("ss", $avatar, $email);
                	$stmt->execute();
			$stmt->close();
			$conn->close();
		}
	</script>
	<body>
		<div id="profile_info">
			<div id="profile_image">
				<img id="img" src="" alt="">
			</div>
			
			<div id="intro">
				<textarea id="text1"></textarea>
			</div>		
			
			<div id="hobbies">
				<textarea id="text2"></textarea>
			</div>
			
			<div id="music">
				<textarea id="text3"></textarea>
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
			<button type="submit" onClick="submitChanges()">Submit Changes</button>
		</div>
		
	</body>
</html>

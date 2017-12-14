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
				document.getElementsByClassName("profile_info")[0].style = "background-color: cyan";
			}   	
			else if(document.getElementById('background_colors').value == "yellow") {
				document.getElementsByClassName("profile_info")[0].style = "background-color: yellow";
			}   	
			else if(document.getElementById('background_colors').value == "red") {
				document.getElementsByClassName("profile_info")[0].style = "background-color: red";
			}   	
		}
		
		function changeImage() {
			if(document.getElementById('images').value == "cat") {
				document.getElementById("img").src = "images/cat.jpg";
				document.getElementById("img").style = "display: block;";
				document.getElementsByClassName("profile_image")[0].style = "display: none;";
				
			}   	
			else if(document.getElementById('images').value == "dog") {
				document.getElementById("img").src = "images/dog.jpg";
				document.getElementById("img").style = "display: block;";
				document.getElementsByClassName("profile_image")[0].style = "display: none;";
				
			}   	
			else if(document.getElementById('images').value == "turtle") {
				document.getElementById("img").src = "images/turtle.jpg";
				document.getElementById("img").style = "display: block;";
				
			}   	
		}

	</script>
	<script>		
		function submitChanges() {
			//Connect to the DB
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
				// update avatar image path 
				$avatar = htmlspecialchars($_POST["avatar"]);;
				$userQuery = "UPDATE User_Profile SET avatar = ? WHERE email LIKE ?";
				$stmt = $conn->prepare($userQuery);
				$stmt->bind_param("ss", $avatar, $email);
				$stmt->execute();
				$stmt->close();
			
				// update background color 
				$color = htmlspecialchars($_POST["colors"]);;
				$userQuery = "UPDATE User_Profile SET background = ? WHERE email LIKE ?";
				$stmt = $conn->prepare($userQuery);
				$stmt->bind_param("ss", $color, $email);
				$stmt->execute();
				$stmt->close();
				
				// update intro
				$intro = htmlspecialchars($_POST["introT"]);;
				$userQuery = "UPDATE User_Profile SET intro = ? WHERE email LIKE ?";
				$stmt = $conn->prepare($userQuery);
				$stmt->bind_param("ss", $intro, $email);
				$stmt->execute();
				$stmt->close();
				
				// update hobbies
				$hobbies = htmlspecialchars($_POST["hobbiesT"]);;
				$userQuery = "UPDATE User_Profile SET hobbies = ? WHERE email LIKE ?";
				$stmt = $conn->prepare($userQuery);
				$stmt->bind_param("ss", $hobbies, $email);
				$stmt->execute();
				
				// update music
				$music = htmlspecialchars($_POST["musicT"]);;
				$userQuery = "UPDATE User_Profile SET music = ? WHERE email LIKE ?";
				$stmt = $conn->prepare($userQuery);
				$stmt->bind_param("ss", $music, $email);
				$stmt->execute();
			$stmt->close();
			
			$conn->close();
			//echo "window.alert('Submitted')";
			//$intro = htmlspecialchars($_POST["introT"]);
			//	echo "window.alert('".$intro."')";
			?>
		}
	</script>

	<body>
		<div class="profile_info">
			<div class="profile_image">
				
			</div>
			
			<img id="img" src="" alt="">
			<br>
			<form method="post" >
			<div id="selectors">
				<select id="images" name="avatar" onChange="changeImage()">
					<option value="none">Select an Avatar Image</option>
					<option value="cat">Cat</option>
					<option value="dog">Dog</option>
					<option value="turtle">Turtle</option>
				</select>
				
				<select id="background_colors" name="colors" onChange="changeColor()">
					<option value="none">Select a Background Color</option>
					<option value="cyan">Cyan</option>
					<option value="yellow">Yellow</option>
					<option value="red">Red</option>
				</select>
			</div>
			
			
			<div id="intro">
				<textarea type="text" name="introT" id="text1"></textarea>
			</div>		
			
			<div id="hobbies">
				<textarea type="text" name="hobbiesT" id="text2"></textarea>
			</div>
			
			<div id="music">
				<textarea type="text" name="musicT" id="text3"></textarea>
			</div>
			<button onClick="submitChanges()">Submit Changes</button>	
			</form>
		</div>
	</body>
</html>

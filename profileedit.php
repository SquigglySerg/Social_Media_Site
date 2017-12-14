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
				document.getElementsByClassName("profile_image")[0].style = "display: none;";
				
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
				if($avatar == "cat") {
					$avatar = "images/cat.jpg";
				}
				else if($avatar == "dog") {
					$avatar = "images/dog.jpg";
				}
				else if($avatar == "turtle") {
					$avatar = "images/turtle.jpg";
				}
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
				<textarea id="introT" type="text" name="introT" id="text1"></textarea>
			</div>		
			
			<div id="hobbies">
				<textarea id="hobbiesT" type="text" name="hobbiesT" id="text2"></textarea>
			</div>
			
			<div id="music">
				<textarea id="musicT" type="text" name="musicT" id="text3"></textarea>
			</div>
			<button onClick="submitChanges()">Submit Changes</button>	
			</form>
		</div>
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
                        echo "document.getElementById('introT').value = '".$intro."';";
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
                        echo "document.getElementById('hobbiesT').value = '".$hobbies."';";
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
                        echo "document.getElementById('musicT').value = '".$music."';";
                        echo "</script>";
                }
                $conn->close();
        ?>

	</body>
</html>

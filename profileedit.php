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
	<?php
	
				session_start();
				$email = $_SESSION["email"];
	?>
	<script>
		
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
			else if(document.getElementById('images').value == "giraffe") {
				document.getElementById("img").src = "images/giraffe.jpg";
				document.getElementById("img").style = "display: block;";
				document.getElementsByClassName("profile_image")[0].style = "display: none;";
			}   	
			else if(document.getElementById('images').value == "hedgehog") {
				document.getElementById("img").src = "images/hedgehog.jpg";
				document.getElementById("img").style = "display: block;";
				document.getElementsByClassName("profile_image")[0].style = "display: none;";
			}   	
		}

	</script>
	<?php
		if($_SERVER["REQUEST_METHOD"] == "POST") {
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
				$avatar = htmlspecialchars($_POST["avatar"]);
				if($avatar == "cat") {
					$avatar = "images/cat.jpg";
				}
				else if($avatar == "dog") {
					$avatar = "images/dog.jpg";	
				}
				else if($avatar == "turtle") {
					$avatar = "images/turtle.jpg";
				}
				else if($avatar == "giraffe") {
					$avatar = "images/giraffe.jpg";
				}
				else if($avatar == "hedgehog") {
					$avatar = "images/hedgehog.jpg";
				}
				if($avatar != "none") {
					$userQuery = "UPDATE User_Profile SET avatar = ? WHERE email LIKE ?";
					$stmt = $conn->prepare($userQuery);
					$stmt->bind_param("ss", $avatar, $email);
					$stmt->execute();
					$stmt->close();
				}
				// update intro
				$intro = htmlspecialchars($_POST["introT"]);
				$userQuery = "UPDATE User_Profile SET intro = ? WHERE email LIKE ?";
				$stmt = $conn->prepare($userQuery);
				$stmt->bind_param("ss", $intro, $email);
				$stmt->execute();
				$stmt->close();
				
				// update hobbies
				$hobbies = htmlspecialchars($_POST["hobbiesT"]);
				$userQuery = "UPDATE User_Profile SET hobbies = ? WHERE email LIKE ?";
				$stmt = $conn->prepare($userQuery);
				$stmt->bind_param("ss", $hobbies, $email);
				$stmt->execute();
				
				// update music
				$music = htmlspecialchars($_POST["musicT"]);
				$userQuery = "UPDATE User_Profile SET music = ? WHERE email LIKE ?";
				$stmt = $conn->prepare($userQuery);
				$stmt->bind_param("ss", $music, $email);
				$stmt->execute();
				$stmt->close();
				$conn->close();		
		}
	?>

	<body>
		<?php
			$active = "edit";
			include './header.php';
		?>
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
					<option value="giraffe">Giraffe</option>
					<option value="hedgehog">Hedgehog</option>
				</select>
			</div>
			
			<h2>Introduction</h2>	
			<div id="intro">
				<textarea id="intro_text" name="introT"></textarea>
			</div>		
			
			<h2>Hobbies</h2>	
			<div id="hobbies">
				<textarea id="hobbies_text" name="hobbiesT"></textarea>
			</div>
			
			<h2>Favorite Music</h2>	
			<div id="music">
				<textarea id="music_text" name="musicT"></textarea>
			</div>
			<button type="submit" onClick="submitChanges()">Submit Changes</button>	
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
                        echo "document.getElementById('intro_text').value = '".$intro."';";
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
                        echo "document.getElementById('hobbies_text').value = '".$hobbies."';";
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
                        echo "document.getElementById('music_text').value = '".$music."';";
                        echo "</script>";
                }
                $conn->close();
        ?>

	</body>
</html>

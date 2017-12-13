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
	
	
	
	<body>
		<div class="profile_info">
			<div class="profile_image">
			</div>
			<br>
			<img id="img" src="" alt="#" style="display: none;" >
				
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
			
			<br>
			<div class="intro">
				Introduction
			</div>		
			<br>
			<div class="hobbies">
				Hobbies
			</div>
			<br>
			<div class="music">
				Music
			</div>
			
			
		</div>
		
	</body>
</html>

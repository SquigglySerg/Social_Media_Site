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
	
	
	
	
	
	
	
		<div id="login" class="loginbox">
					
			<form class="loginbox-content" method="post" action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>'>
								
				<div class="container">
					<label><b>Email</b></label>
					<input type="email" id="Email" placeholder="Enter Email" autocomplete="off" name="email" required>
					
					<label><b>Password</b></label>
					<input type="password" id="Psw" placeholder="Enter Password" autocomplete="off" name="psw"  required>
					
					
					<button type="submit">Login</button>
				</div>
				
				<div class="container" style="background-color:#f1f1f1">
				<!-- Make cancel redirect to index page or previous page -->
					<button type="button" onclick="window.location='index.php'" class="cancelbtn">Cancel</button>
					<span class="psw">Reset <a href="passwordchange.php">password?</a></span>
				</div>
			</form>
		</div>
		
		
	</body>
</html>
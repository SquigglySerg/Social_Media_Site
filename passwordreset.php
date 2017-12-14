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
		<?php include './passwordreset_submit.php';
			$active = "passwordreset";
			include './header.php';
		?>
		
		<!--use the GET hashed password and EMAIL to confirm user and then use update sql command to replace user password-->
		<form class="loginbox-content" method="post" action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>'>
			
			<div class="container">
				<label><b>Enter Password</b></label><span>*Password must contain at least one number, one letter, and can only be numbers or letter or one of the following !@#$% and must be 8-36 characters long.</span>
					<input type="password" id="Psw" placeholder="Enter Password" autocomplete="off" name="psw" onmouseover="mouseoverPass();" onmouseout="mouseoutPass();" required>
					<small>Mouse over text box to see password</small><br>
					<span class="error"><?php echo $pswErr;?></span>
					
					<button type="submit">Submit</button>
				</div>
				
				<div class="container" style="background-color:#f1f1f1">
					
					<button type="button" onclick="window.location='index.php'" class="cancelbtn">Cancel</button>
					<span class="psw">Create <a href="register.php">New Account</a></span>
				</div>
			</form>
			
			
		</body>
	</html>		
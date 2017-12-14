<?php session_start();?>
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
	
		<?php include 'passwordchange_submit.php';
			$active = "passwordchange";
			include './header.php';
		?>
		<form class="loginbox-content" method="post" action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>'>
			
			<div class="container">
				<label><b>Your Email Address</b></label>
				<!-- Check if email exists if not return message using php and querying the database-->
				<input type="email" id="Email" placeholder="Enter Email" autocomplete="off" name="email" value="<?php echo $email ?>" required>
				<span class="error"><?php echo $emailErr;?></span>
				
				<button type="submit">Send Instruction</button>
			</div>
			
			<div class="container" style="background-color:#f1f1f1">
				
				<button type="button" onclick="window.location='index.php'" class="cancelbtn">Cancel</button>
				<span class="psw">Create <a href="register.php">New Account</a></span>
			</div>
		</form>
		
		
	</body>
</html>
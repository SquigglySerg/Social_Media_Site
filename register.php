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
		<?php include 'register_submit.php';
			$active = "register";
			include './header.php';
		?>
		<div id="login" class="loginbox">
			<form class="loginbox-content" method="post" action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>'>
				
				<div class="container">
					<label><b>First Name</b></label><span class="error">* <?php echo $fnameErr;?></span>
					<input type="text" id="Fname" placeholder="Enter First Name" autocomplete="off" name="fname" value="<?php echo $fname ?>" required>
					
					<label><b>Last Name</b></label><span class="error">* <?php echo $lnameErr;?></span>
					<input type="text" id="Lname" placeholder="Enter Last Name" autocomplete="off" name="lname" value="<?php echo $lname ?>" required>
					
					<!--Make sure Email is unique send message to say this email was used previously to create an account...-->
					<label><b>Email</b></label><span class="error">* <?php echo $emailErr;?></span>
					<input type="email" id="Email" placeholder="Enter Email" autocomplete="off" name="email" value="<?php echo $email ?>" required>
					
					<label><b>Password</b></label><span class="error">* <?php echo $pswErr;?></span>
					<input type="password" id="Psw" placeholder="Enter Password" autocomplete="off" name="psw" onmouseover="mouseoverPass();" onmouseout="mouseoutPass();" required>
					<small>Mouse over text box to see password</small>
					<br><br>
					<button type="submit">Create Account</button>
				</div>
				
				<div class="container" style="background-color:#f1f1f1">
					<button type="button" onclick="window.location='index.php'" class="cancelbtn">Cancel</button>
				</div>
			</form>
		</div>
		<?php include "footer.php";?>
	</body>
</html>

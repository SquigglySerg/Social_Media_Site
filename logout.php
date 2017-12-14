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
		<script src="script.js"></script>
		<?php
			include './header.php';
			
			//Logging out kill session and redirect
			unset($_SESSION['email']);
			session_destroy();

			redirect("./index.php");
			
			function redirect($url) {
				ob_start();
				header('Location: '.$url);
				ob_end_flush();
				die();
			}
		?>
	</body>
</html>
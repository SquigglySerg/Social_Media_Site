<?php
	//string password_hash ( string $password , integer $algo [, array $options ] )
	
	/**
		* We just want to hash our password using the current DEFAULT algorithm.
		* This is presently BCRYPT, and will produce a 60 character result.
		*
		* Beware that DEFAULT may change over time, so you would want to prepare
		* By allowing your storage to expand past 60 characters (255 would be good)
	*/
	echo password_hash("rasmuslerdorf", PASSWORD_DEFAULT);
?>



<?php
	//boolean password_verify ( string $password , string $hash )
	
	// See the password_hash() example to see where this came from.
	$hash = '$2y$07$BCryptRequires22Chrcte/VlQH0piJtjXl.0t1XkA8pw9dMXTpOq';
	
	if (password_verify('rasmuslerdorf', $hash)) {
		echo 'Password is valid!';
		} else {
		echo 'Invalid password.';
	}
?>
<?php
	require_once 'sample-data.php';
	$admin = new User("admin", 1234, true);
	$user = new User("user", 0000, false);
	$flag = false;
	$captcha_flag = false;
	session_start();
	if($_SESSION){
		header("Location: index.php");
	}
	else if($_POST){
		$captcha=$_POST['g-recaptcha-response'];
		if(!$captcha){

			$captcha_flag = true;
		}
		
		else{

			if($_POST["username"] == $admin->username 
				 && $_POST["pin"] == $admin->pin){
					
					$_SESSION["username"] = $admin->username;
					$_SESSION["pin"] = $admin->pin;
					$_SESSION["admin"] = $admin->admin;
					header("Location: index.php");
			}else if($_POST["username"] == $user->username 
				 && $_POST["pin"] == $user->pin){
					
					$_SESSION["username"] = $user->username;
					$_SESSION["pin"] = $user->pin;
					$_SESSION["admin"] = $user->admin;
					header("Location: index.php");
			}else{
				$flag = true;
			}
		}
		
	}
	else{

	}

?>
<html>
<head>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>

<h2>HTML Forms</h2>
	<?php 
		if($flag) {
			echo "<p>Information Inorrect!</p>";
		}
	?>
	<br>
	<?php 
		if($captcha_flag) {
			echo "<p>captcha Inorrect!</p>";
		}
	?>
	<form method = "post" action="login.php">
	  Username:<br>
	  <input type="text" name="username" />
	  <br>
	  Pin Number:<br>
	  <input type="number" name="pin" />
	  <br><br>
	  <div class="g-recaptcha" data-sitekey="6Lci3HIUAAAAANCqp6EyjpvIu0KTbP8elzZrGO2V"></div>
	  <input type="submit" value="Submit">
	</form> 
</body>
</html>

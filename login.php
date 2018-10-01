<?php
	require_once 'sample-data.php';
	$admin = new User("admin", 1234);
	$admin->setPinAndAdmin(5555, true);
	$user = new User("user", 0000);
	$default_user = new User("tmp", 4789);
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
				 && $_POST["pin"] == $admin->getPin()){
					
					$_SESSION["username"] = $admin->username;
					$_SESSION["pin"] = $admin->getPin();
					$_SESSION["admin"] = $admin->getAdmin();
					
				header("Location: index.php");
			}else if($_POST["username"] == $user->username 
				 && $_POST["pin"] == $user->getPin()){
					
					$_SESSION["username"] = $user->username;
					$_SESSION["pin"] = $user->getPin();
					$_SESSION["admin"] = $user->getAdmin();
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
<script src='https://www.google.com/recaptcha/api.js'></script>
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
	  <div class="g-recaptcha" data-sitekey="6Lfr3nIUAAAAAC_oU3UbQ0em5Vv6i_SlI_mbwUin"></div>
	  <input type="submit" value="Submit">
	</form>

	<?php 
		$username = 'username';  
		echo $default_user->$username."<br>"; 

		$pin = 'pin';
		//echo $admin->$pin."<br>";
		echo $default_user->getPin()."<br>";
		
		
		if($default_user->getAdmin()){
			echo "true <br>";
		}
		else{
			echo "false <br>";
		}
		
		$default_user->setAdmin(true);
		if($default_user->getAdmin()){
			echo "true <br>";
		}else{
			echo "false <br>";
		}
	?>
</body>
</html>

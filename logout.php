<?php
	session_start();
	if($_SESSION){
		unset($_SESSION);
		session_destroy();
	}
	header("Location: index.php");
?>
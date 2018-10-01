<?php
$userInfoDisplay = "";
session_start();
if($_SESSION){
	
	$userInfoDisplay = $_SESSION["username"]."  ";
	
	if($_SESSION["admin"] == true){
		$userInfoDisplay .= "ADMIN";
	}else{
		$userInfoDisplay .= "USER";
	}
	if($_POST){
		if($_POST["htmlcode"] && $_POST["target"]){
			echo $_POST["target"]."<br>";
			echo trim($_POST["htmlcode"]."<br>");
			if ( file_exists($_POST['target']) ) { 
				echo "1";
				if($f = fopen($_POST['target'], 'w')){
					echo "2";
					fwrite($f, trim($_POST["htmlcode"]));
					fclose($f);
					echo "3";
					
				}
			}
			header("Refresh:0");
		}	
	}
}
else{
	header("Location: login.php");
}
	
?>


<html>
<head>
<title>Editable Page</title>
	<meta charset="utf-8">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src='https://www.google.com/recaptcha/api.js'></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<style>
.content{
	padding: 50px;
}

fieldset{
	margin: 20px;
}
</style>
<script>
	$(document).ready(function(){
		$("#edit1")[0].contentEditable = false;
		$("#edit2")[0].contentEditable = false;
			
		var contents = $('#editableContent').html();
		var contents_edit1 = $("#edit1").html();
		var contents_edit2 = $("#edit2").html();
		
		var ec = $("#editableContent");
		var htmlC = $("#htmlC");

		$("#editableContent").on('blur', '[contenteditable]', function(){
			htmlC.val(ec.html());

			//console.log(htmlC.val());
		});
		
		$("#editButton").click(function(){
			$("#cancelEditButton").show();
			$("#saveButton").show();
			$("#edittButton").hide();
			
			$("#edit1")[0].contentEditable = true;
			$("#edit2")[0].contentEditable = true;
		});
		
		$("#cancelEditButton").click(function(){
			$("#cancelEditButton").hide();
			$("#saveButton").hide();
			$("#edittButton").show();
			
			$("#edit1")[0].contentEditable = false;
			$("#edit2")[0].contentEditable = false;
			
			$("#edit1").html(contents_edit1);
			$("#edit2").html(contents_edit2);
		});
	});
</script>
<body>

<div class = "content">

	<fieldset><legend>Logged User</legend>
		<?php echo $userInfoDisplay; ?>
		<form method = "post" action = "logout.php">
			<input type = "submit" value = "Logout" />
		</form>
	</fieldset>
	
	<fieldset><legend> Edit Content</legend>
		<div contenteditable="true">
			Edit this...
		</div>
	</fieldset>
	
	<fieldset><legend> Edit Content & Save</legend>
	
		<div id = "editableContent">
			<?php require_once 'edit-example.html' ?>
		</div>
		
		
		
		<?php
		if($_SESSION["admin"] == true){
		echo "
		<button id = 'editButton'>Edit</button>
		
		
		<form method = 'post' action = ''>
			<input input = 'text' id = 'htmlC' name = 'htmlcode' hidden />
			<input input = 'text' name = 'target' value = 'edit-example.html' hidden />
			
			<div style ='padding-top: 5px; padding-bottom: 5px; padding-right: 5px;'>
				<input id = 'saveButton' type ='submit' value = 'Save' hidden />
				<button id = 'cancelEditButton' hidden> Cancel</button>
			</div>
		</form>";}?>
	</fieldset>
	</div>
</body>
</div>
</html>

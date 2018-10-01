
<?php ?>
<html>
<head>
<title> Reading a file using PHP </title>
</head>

<body>
<fieldset><legend>File Content</legend>
<?php

$filename = "tmp.txt";
$file = fopen($filename, "r");

if($file == false){
	echo ("Error in opening file");
	exit();
}

$filesize = filesize($filename);
$filetext = fread($file, $filesize);
fclose($file);

echo("File name: ".$filename."<br> File size: ".$filesize ."bytes"."<br><br>");
echo "<b>Content: </b>";
echo("<pre>".$filetext."</pre>");
?>
</fieldset>
</body>
</html>

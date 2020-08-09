<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Document sans titre</title>
<style>
	body{
		background-color:#1F6360;
	}
	@font-face{
	font-family:hissa_fontb;
	src: url("hissa_fontb.ttf");
}
	h3{
		color:#CCC;
		font-size:50px;
		border-bottom:dotted 2px #CCCCCC;
		font-family:hissa_fontb;
		padding-bottom:1em;
	}
	h4{
		color:#fa0;
	}
	h3>span{
		color: #fa0;
	}
</style>
</head>

<body>
<center><h3>erreur donnée <span>:'(</span></h3></center>
<?php
if(isset($_GET['error'])){
	echo "<h4>" . htmlspecialchars($_GET['error']) . "</h4>";
}
else{
}
?>
</body>
</html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Document sans titre</title>
</head>

<body>
<?php
if(isset($_GET['nom'])&&isset($_GET['prenom'])){
	echo $_GET['nom'] . " " . $_GET['prenom'];
}
else{
	echo "<h2>erreur dans la page</h2>";
}
?>
<iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $_GET['link'] ?>" frameborder="0" allowfullscreen></iframe>
</body>
</html>
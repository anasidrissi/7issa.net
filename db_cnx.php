<?php
try{
	$hissa_db = new PDO('mysql:host=127.0.0.1;dbname=anas', 'root', '');
}
catch (Exeption $e)
{
	die('erreur : ' . $e->getMessage());
}
?>
<?php
	function securite_bdd($string)
	{
		// On regarde si le type de string est un nombre entier (int)
		if(ctype_digit($string))
		{
			$string = intval($string);
		}
		// Pour tous les autres types
		else
		{
			$string = mysql_real_escape_string($string);
			$string = addcslashes($string, '%_');
		}
		
		return $string;
	}
?>
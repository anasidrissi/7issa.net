<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="icon" href="img/icon.ico" />
<link rel="stylesheet" href="tools/font_style.css" />
<link rel="stylesheet" href="tools/plan_comptable.css" />
<?php
try{
	$hissa_db = new PDO('mysql:host=127.0.0.1;dbname=anas', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
}
catch (Exeption $e)
{
	die('erreur : ' . $e->getMessage());
}
?>
<title>7issa | le plan comptable</title>
</head>
<body>
<?php
function color($a){
switch ($a) {
	case 1://la aclasse 1
		$color_classe='ffd35e';
		break;
	case 2://
		$color_classe='cb98d1';
		break;
	case 3://
		$color_classe='f49c54';
		break;
	case 4://
		$color_classe='89b87a';
		break;
	case 5://
		$color_classe='4b9cd5';
		break;
	case 6://
		$color_classe='c29d43';
		break;
	case 7://
		$color_classe='cd89c9';
		break;
	case 8://
		$color_classe='019379';
		break;
	case 9://
		$color_classe='c402a6';
		break;
	default:
		$color_classe='526ca7';
		break;
}
return $color_classe;
}
	$plan_db=$hissa_db->query("SELECT * FROM plancompta");
?>
	<section id="header">
	<div class="logo"><a href="index.php"><img src="img/logo_apps.png" /></a></div>
		<form method="post" action="plan_cherche.php">
			<input type="radio" value="exacte" name="type" /><label class="cherche_type">recherche exacte</label>
			<input type="radio" value="normale" name="type" checked="" /><label class="cherche_type">recherche normale</label><br />
			<input class="ch_field" name="ch" placeholder="chercher classe,compte..." type="text" /><button class="plan_charche_btn" type="submit" value="chercher"><span style="color:white" id="fs1" aria-hidden="true" data-icon="&#x55;"></button>
			</form>
			<br />
		<form method="post" action="plan_cherche.php">
			<span class="plan_tri_titre">selectionner une classe :</span>
			<br />
			<select class="plan_select" name="class_num">
				<option value="1">--Sélectionner--</option>
				<option value="1">classe 1</option>
				<option value="2">classe 2</option>
				<option value="3">classe 3</option>
				<option value="4">classe 4</option>
				<option value="5">classe 5</option>
				<option value="6">classe 6</option>
				<option value="7">classe 7</option>
				<option value="8">classe 8</option>
				<option value="9">classe 9</option>
				<option value="0">classe 0</option>
			</select>
			<br />
			<button class="plan_tri_btn" type="submit" value="trier">trier</button>
		</form>
		<p class="version">version: beta</p>
	</section>
	<section id='plan'>
	<a href="plan_comptable.php"><span class="grand_titre">PLAN COMPTABLE GENERALE <span>MAROCAIN</span></span></a>
<?php
	while($plan_affiche=$plan_db->fetch()){
		if(strlen($plan_affiche["comptaid"])==1){
			$classe_index=$plan_affiche["comptaid"];
			$classe_num=$classe_index["0"];
			echo "<br /><div class='titre' style='background:#" . color($classe_num) ."'><span><span class='classe'>CLASSE : " . strtoupper($plan_affiche["comptaid"]) . "</span> " . strtoupper($plan_affiche['name']) . "</span></div><br />";
		}
		elseif (strlen($plan_affiche["comptaid"])==2) {
			echo "<div style='background:#" . color($classe_num) ."' class='attri'><span class='attr_num'>" . $plan_affiche["comptaid"] . "</span> " . strtoupper($plan_affiche['name']) . "</div><br />";
		}
		elseif (strlen($plan_affiche["comptaid"])==5) {
			echo "<span  class='sous_compte'>" . $plan_affiche["comptaid"] . " " . $plan_affiche['name'] . "</span><br />";
		}
		elseif (strlen($plan_affiche["comptaid"])==3) {
			echo "<span class='post'>" . $plan_affiche["comptaid"] . " " . $plan_affiche['name'] . "</span><br />";
		}
		else{
			echo "<span class='compte'>" . $plan_affiche['comptaid'] . " " . $plan_affiche['name'] . "</span><br />";
		}

	}
?>	
	<span class="plan_foot"><p><span style="color:#00B6C7;">7issa.com</span> Comptes du PCGE Modele normal</p></span>
	</section>
	<footer class="foot"><!-- footer section -->
 <?php
 include("footer.php");
 ?>
 </footer>
	
</body>
</html>
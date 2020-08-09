<!DOCTYPE html>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<head>
	<link rel="icon" href="img/icon.ico" />
	<link rel="stylesheet" href="tools/font_style.css" />
	<link rel="stylesheet" href="tools/plan_comptable.css" />
	<title></title>
</head>
<body>
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
	</section>
	<section id='plan'>
	<a href="plan_comptable.php"><span class="grand_titre">PLAN COMPTABLE GENERALE <span>MAROCAIN</span></span><br /></a>
<?php
	try{
	$hissa_db = new PDO('mysql:host=127.0.0.1;dbname=anas', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
}
catch (Exeption $e)
{
	die('erreur : ' . $e->getMessage());
}
	include('fontions.php');
	if(isset($_POST['ch'])){
	$ch=htmlspecialchars($_POST['ch']);
}
	if (isset($_POST['class_num'])) {
	$num=$_POST['class_num'];
}
	//$ch=preg_replace('#[^a-z A-Z 0-9?!éà]#', '', $_POST['ch']);
	if (isset($_POST['class_num']) OR $ch) {
		//condition si $ch presente et $class_num absente
		if (isset($ch) AND !isset($class_num)) { 
			if ($_POST['type']=='exacte') { //first field "recherche exacte"
				$commendeDonne="SELECT * FROM plancompta WHERE comptaid=\"$ch\" OR name=\"$ch\"";
				$commendeCount="SELECT COUNT(*) AS ch_select_count FROM plancompta WHERE comptaid=\"$ch\" OR name=\"$ch\"";

			}
			else{ //second field "recherche normale"
			$commendeDonne="SELECT * FROM plancompta WHERE comptaid LIKE \"%$ch%\" OR name LIKE \"%$ch%\" ORDER BY id";
			$commendeCount="SELECT COUNT(*) AS ch_select_count FROM plancompta WHERE comptaid LIKE \"%$ch%\" OR name LIKE \"%$ch%\" ORDER BY id";
		}
	}
	//condition si $class_num presente et $ch absente
	elseif(isset($num) AND !isset($ch)){
			$commendeDonne="SELECT * FROM plancompta WHERE comptaid < 1000";
			$commendeCount="SELECT COUNT(*) AS ch_select_count FROM plancompta WHERE comptaid=\"$num\"";
	}
		$plan_donne=$hissa_db->query($commendeDonne);
		$plan_count_donne=$hissa_db->query($commendeCount);
		$plan_count_affiche=$plan_count_donne->fetch();
		if ($plan_count_affiche['ch_select_count']==0) {
			echo "<br /><span class='no_resultat'>aucune resultat pour <span style='color:#00808C;font-weight:bold;'>" . $ch . "</span><span></span>";//section acune resultat
		}
		while ($plan_affiche=$plan_donne->fetch()){
				$classe_index=$plan_affiche["comptaid"];
					$classe_num=$classe_index["0"];
			switch (strlen($plan_affiche["comptaid"])) {
				case 1:
					echo "<br /><div class='titre' style='background:#" . color($classe_num) ."'><span><span class='classe'>CLASSE : " . strtoupper($plan_affiche["comptaid"]) . "</span> " . strtoupper($plan_affiche['name']) . "</span></div><br />";
					break;
				case 2:
					echo "<div style='background:#" . color($classe_num) ."' class='attri'><span class='attr_num'>" . $plan_affiche["comptaid"] . "</span> " . strtoupper($plan_affiche['name']) . "</div><br />";
					break;
				case 3:
					echo "<span class='post'>" . $plan_affiche["comptaid"] . " " . $plan_affiche['name'] . "</span><br />";
					break;
				case 5:
					echo "<span  class='sous_compte'>" . $plan_affiche["comptaid"] . " " . $plan_affiche['name'] . "</span><br />";
					break;
				default:
					echo "<span class='compte'>" . $plan_affiche['comptaid'] . " " . $plan_affiche['name'] . "</span><br />";
					break;
			}
		}
}
	else{
		echo "erreur";
	}
	?>
<span class="plan_foot"><p><span style="color:#00B6C7;">7issa.com</span> Comptes du PCGE Modele normal</p></span>
	</section
</body>
</html>
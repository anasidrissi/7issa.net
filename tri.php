<?php include_once('db_cnx.php'); $logo_type=1; ?> <!-- connection a la base du donne -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="tools/index_style.css" />
<link rel="stylesheet" href="tools/header.css" />
<link rel="stylesheet" href="tools/menu_left_style.css" />
<link rel="icon" href="img/icon.ico" />
<link rel="stylesheet" href="tools/font_style.css" />
<script type="text/javascript" src="tools/jquery.js"></script>
<script type="text/javascript" src="tools/index_script.js"></script>
<script type="text/javascript" src="tools/fades.js"></script>
<title>7issa | <?php if(isset($_GET['semestre'])){echo $_GET['tri_cat'] . " | s" . $_GET['semestre'];}else{echo $_GET['tri_cat'];} ?></title>
</head>

<body>
<header class="header">
<?php
include("index_header.php");
?><div><span onclick="fadee('menu_left')" class="fs1" aria-hidden="true" data-icon="&#xe056;"></span></div>
</header>
<section id="menu_left">
<?php
include("menu_left.php");
?>
</section>
<section id="principale">
<?php
$tri=htmlspecialchars($_GET['tri_cat']);
$tri=securite_bdd($tri);

if($_GET['tri_cat']==NULL OR strlen($_GET['tri_cat'])>=50  OR !isset($_GET['tri_cat']) OR !in_array($_GET['tri_cat'],$matieres)){
	if(preg_match('#[0-9]#',$_GET['tri_cat'])){
	 header('location:error.php?error=Tous les noms des catégories ne contiennent pas des nombres merci pour vérifier votre adresse web');
	}
	elseif($_GET['tri_cat']=='no'){
		header('location:error.php?error=s\'il te plait essayer de choisir une matier pour bien trier');
	}
	else{
	header('location:error.php?error=7issa.com n\'a pas trouvé cette catégorie ressayé avec une entrée valide');
	}
}
//tri avec la variables semestre
if(isset($_GET['semestre']) AND $_GET['semestre']<=20  AND preg_match('#[0-9]#',$_GET['semestre'])){
	$tri_semestre=htmlspecialchars($_GET['tri_semestre']);
$tri_semestre=securite_bdd($tri_semestre);
	 $tri_semestre=htmlspecialchars($_GET['semestre']);
			echo "<div id='cat_titre'>" . htmlspecialchars($_GET['tri_cat']);
			if ($_GET['semestre']!='no') {
				echo " > semestre " . $tri_semestre . "</div>";
			}
			else{
				echo "</div>";
			}
		$tri_donne=$hissa_db->query('SELECT * FROM hissa_beta WHERE mat_name=\'' .$tri . '\' AND semestre=\'' . $tri_semestre . '\'');
		$k=0;
		while($tri_affiche=$tri_donne->fetch()){
				if(preg_match('#Ã©#',$tri_affiche['mat_name'])){
	$tri_affiche['mat_name']=str_replace('Ã©','é',$tri_affiche['mat_name']);
}
	if(preg_match('#Ã©#',$tri_affiche['name'])){
	$tri_affiche['name']=str_replace('Ã©','é',$tri_affiche['name']);
}
			echo '<a href="hissa_play.php?v_id=' . $tri_affiche['id'] . '&nom=' . $tri_affiche['name'] . '&mat=' . $tri_affiche['mat_name'] . '"><div id="hissa_index">
			<aside class="name" title="' . $tri_affiche['name'] . '">' . $tri_affiche['name'] . '</aside>
		<aside class="img_name"><center><img class="img_size" src="img/hissa_img/' . $tri_affiche['img_name'] . '" /></center></aside>
		<span>
		<aside class="prof_name" title="' . $tri_affiche['prof_name'] . '"><a>' . $tri_affiche['prof_name'] . '</a></aside>
		<aside class="mat_name" title="' . $tri_affiche['mat_name'] . '">' . $tri_affiche['mat_name'] . '</aside>
		<aside class="dat" title="le: ' . $tri_affiche['date'] . '">' . $tri_affiche['date'] . '</aside>';
	if ($_GET['semestre']!='no') {
			
		echo '<aside class="semestre">Semestre ' . $tri_affiche['semestre'] . ' Ens ' . $tri_affiche['ensemble'] .'</aside>';
	}
	else{
		echo '<aside class="semestre">hissa_num ' . $tri_affiche['hissa_num'] . '</aside>';
	}
			if($tri_affiche['link_var']=="load"){
		echo
		'<span title="ce cours en train de chargement" style="color:#666;" id="fs1" aria-hidden="true" data-icon="&#xe02d;"></span>';
		}
		elseif($tri_affiche['link_var']=="no"){
			echo
		'<span title="ce cours n\'est valable en mode video" style="color:#aaa;" id="fs1" aria-hidden="true" data-icon="&#xe00e;"></span>';
		}
		else{
				echo
		'<span title="ce cours est valable en mode video" style="color:#666" id="fs1" aria-hidden="true" data-icon="&#xe00e;"></span>';
		
		}
		
		if(isset($tri_affiche['pdf_link']) and !empty($tri_affiche['pdf_link'])){
		echo
		'<span title="ce cours est valable en document pdf" style="color:#666" id="fs1" aria-hidden="true" data-icon="&#xe086;"></span>';
		}
		else{echo
		'<span title="ce cours pas valable en mode pdf :(" style="color:#aaa" id="fs1" aria-hidden="true" data-icon="&#xe086;"></span>';
		}
		
		if(isset($tri_affiche['doc_link']) and !empty($tri_affiche['doc_link'])){
		echo
		'<span title="ce cours est valable en document word" style="color:#666" id="fs1" aria-hidden="true" data-icon="&#xe058;"></span>';
		}
		else{echo
		'<span title="ce cours pas valable en document word :(" style="color:#aaa" id="fs1" aria-hidden="true" data-icon="&#xe058;"></span>';
		}
		if(isset($tri_affiche['ptt_link']) and !empty($tri_affiche['ptt_link'])){
		echo
		'<span title="ce cours est valable en document power point" style="color:#666" id="fs1" aria-hidden="true" data-icon="&#xe0f0;"></span>';
		}
		else{echo
		'<span title="ce cours pas valable en document power point :(" style="color:#aaa" id="fs1" aria-hidden="true" data-icon="&#xe0f0;"></span>';
		}
		echo '</div></a>';
		$k++;
		}
		if($k==0){
			echo "<p class='vide'>Aucun résultat disponible ! </p>";
		}
		$tri_donne->closeCursor();
}

//tri sans la variables semestre
else{
	$k=0;
echo "<div id='cat_titre'>" . htmlspecialchars($_GET['tri_cat']) .  " :</div>";
$tri_donne=$hissa_db->query('SELECT * FROM hissa_beta WHERE mat_name=\'' . $tri . '\'');
while($tri_affiche=$tri_donne->fetch()){
	if(preg_match('#Ã©#',$tri_affiche['mat_name'])){
	$tri_affiche['mat_name']=str_replace('Ã©','é',$tri_affiche['mat_name']);
}
	if(preg_match('#Ã©#',$tri_affiche['name'])){
	$tri_affiche['name']=str_replace('Ã©','é',$tri_affiche['name']);
}
	echo '<a href="hissa_play.php?v_id=' . $tri_affiche['id'] . '&nom=' . $tri_affiche['name'] . '&mat=' . $tri_affiche['mat_name'] . '"><div id="hissa_index">
	<aside class="name" title="' . $tri_affiche['name'] . '">' . $tri_affiche['name'] . '</aside>
<aside class="img_name"><center><img class="img_size" src="img/hissa_img/' . $tri_affiche['img_name'] . '" /></center></aside>
<span>
<aside class="prof_name" title="' . $tri_affiche['prof_name'] . '"><a>' . $tri_affiche['prof_name'] . '</a></aside>
<aside class="mat_name" title="' . $tri_affiche['mat_name'] . '">' . $tri_affiche['mat_name'] . '</aside>
<aside class="dat" title="le: ' . $tri_affiche['date'] . '">' . $tri_affiche['date'] . '</aside>';
		if($tri_affiche['semestre']!=0){
		echo '<aside class="semestre">Semestre ' . $tri_affiche['semestre'] . ' Ens ' . $tri_affiche['ensemble'] .'</aside>';
		}
		else{
			echo '<aside class="semestre">Hissa num ' . $tri_affiche['hissa_num'] . '</aside>';
		}

	if($tri_affiche['link_var']=="load"){
		echo
		'<span title="ce cours en train de chargement" style="color:#666;" id="fs1" aria-hidden="true" data-icon="&#xe02d;"></span>';
		}
		elseif($tri_affiche['link_var']=="no"){
			echo
		'<span title="ce cours n\'est valide en mode video" style="color:#aaa;" id="fs1" aria-hidden="true" data-icon="&#xe00e;"></span>';
		}
		else{
				echo
		'<span title="ce cours est valide en mode video" style="color:#666" id="fs1" aria-hidden="true" data-icon="&#xe00e;"></span>';
		
		}
		
		if(isset($tri_affiche['pdf_link']) and !empty($tri_affiche['pdf_link'])){
		echo
		'<span title="ce cours est valide en document pdf" style="color:#666" id="fs1" aria-hidden="true" data-icon="&#xe086;"></span>';
		}
		else{echo
		'<span title="ce cours pas valide en mode pdf :(" style="color:#aaa" id="fs1" aria-hidden="true" data-icon="&#xe086;"></span>';
		}
		
		if(isset($tri_affiche['doc_link']) and !empty($tri_affiche['doc_link'])){
		echo
		'<span title="ce cours est valide en document word" style="color:#666" id="fs1" aria-hidden="true" data-icon="&#xe058;"></span>';
		}
		else{echo
		'<span title="ce cours pas valide en document word :(" style="color:#aaa" id="fs1" aria-hidden="true" data-icon="&#xe058;"></span>';
		}
		if(isset($tri_affiche['ptt_link']) and !empty($tri_affiche['ptt_link'])){
		echo
		'<span title="ce cours est valide en document power point" style="color:#666" id="fs1" aria-hidden="true" data-icon="&#xe0f0;"></span>';
		}
		else{echo
		'<span title="ce cours pas valide en document power point :(" style="color:#aaa" id="fs1" aria-hidden="true" data-icon="&#xe0f0;"></span>';
		}
	echo '</div></a>';
$k++;
}
if($k==0){
			echo "<p class='vide'>Aucun resultat disponible ! </p>";
		}
$tri_donne->closeCursor();
}
?>
</section>

<!-- section footer -->
  <footer class="foot"><!-- footer section -->
 <?php
 include("footer.php");
 ?>
 </footer>

<!-- section news and adsence -->

</body>
</html>
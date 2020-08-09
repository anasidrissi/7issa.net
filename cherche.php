<?php include_once('db_cnx.php'); $logo_type=1; ?> <!-- connection a la base du donne -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="tools/font_style.css" />
<link rel="stylesheet" type="text/css" href="tools/index_style.css" />
<link rel="stylesheet" href="tools/header.css" />
<link rel="stylesheet" href="tools/menu_left_style.css" />
<script type="text/javascript" src="tools/jquery.js"></script>
<script type="text/javascript" src="tools/index_script.js"></script>
<link rel="icon" href="img/icon.ico" />
<title>7issa</title>
<script type="text/javascript" src="tools/fades.js"></script>
</head>

<body>
<header class="header">
<?php
include("index_header.php");
?><div><span onclick="fadee('menu_left')" class="fs1" aria-hidden="true" data-icon="&#xe056;"></span></div>
</header>
<div id="menu_left">
<?php
include("menu_left.php");
?>
</div>
<?php
function replace_off($target){
	if(preg_match('#é#',$target)){
	$target=str_replace('é','Ã©',$target);
	return $target;
	}
	else{
		return $target;
	}
}
function replace_on($target){
	if(preg_match('#Ã©#',$target)){
	$target=str_replace('Ã©','é',$target);
	return $target;
	}
	else{
		return $target;
	}
}
$c=0;
$sh=htmlspecialchars($_GET['sh']);
$sh=securite_bdd($sh);
$condition="WHERE mat_name=" . "\"" . $sh . "\"";
?>
<section id="principale">
<?php
if (!empty($sh) AND strlen($sh)>=3) {
echo "<div id='cat_titre'>recherche pour : ".$sh."</div>";
}
?>
<?php
//get error
error_reporting(E_ALL);
ini_set('display_errors', '1');
$cherche_donne_count=$hissa_db->query("SELECT COUNT(*) AS c FROM hissa_beta WHERE mat_name LIKE '%$sh%' OR name LIKE '%$sh%' OR prof_name LIKE '%$sh%' OR univer_name LIKE '%$sh%'");
$cherche_donne_countaf=$cherche_donne_count->fetch();
$c=$cherche_donne_countaf['c'];
$cherche_donne=$hissa_db->query("SELECT * FROM hissa_beta WHERE mat_name LIKE '%$sh%' OR name LIKE '%$sh%' OR prof_name LIKE '%$sh%' OR univer_name LIKE '%$sh%'");
while($cherche_affiche=$cherche_donne->fetch()){
	if(strlen($sh)>=3){
		echo '<a href="hissa_play.php?v_id=' . $cherche_affiche['id'] . '&nom=' . replace_off($cherche_affiche['name']) . '&mat=' . $cherche_affiche['mat_name'] . '"><div id="hissa_index">
	<aside class="name" title="' . $cherche_affiche['name'] . '">' . $cherche_affiche['name'] . '</aside>
<aside class="img_name"><img class="img_size" src="img/hissa_img/' . $cherche_affiche['img_name'] . '" /></aside>
<span>
<aside class="prof_name" title="' . $cherche_affiche['prof_name'] . '"><a>' . $cherche_affiche['prof_name'] . '</a></aside>
<aside class="mat_name" title="' . $cherche_affiche['mat_name'] . '">' . $cherche_affiche['mat_name'] . '</aside>
<aside class="dat" title="Le: ' . $cherche_affiche['date'] . '">' . $cherche_affiche['date'] . '</aside>
<aside class="semestre">Semestre ' . $cherche_affiche['semestre'] . ' Ens ' . $cherche_affiche['ensemble'] .'</aside>
';
if($cherche_affiche['link_var']=="load"){
echo
'<span title="ce cours en train de chargement" style="color:#666;" id="fs1" aria-hidden="true" data-icon="&#xe02d;"></span>';
}
elseif($cherche_affiche['link_var']=="no"){
	echo
'<span title="ce cours n\'est valable en mode video" style="color:#aaa;" id="fs1" aria-hidden="true" data-icon="&#xe00e;"></span>';
}
else{
		echo
'<span title="ce cours est valable en mode video" style="color:#666" id="fs1" aria-hidden="true" data-icon="&#xe00e;"></span>';

}

if(isset($cherche_affiche['pdf_link']) and !empty($cherche_affiche['pdf_link'])){
echo
'<span title="ce cours est valable en document pdf" style="color:#666" id="fs1" aria-hidden="true" data-icon="&#xe086;"></span>';
}
else{echo
'<span title="ce cours pas valable en mode pdf :(" style="color:#aaa" id="fs1" aria-hidden="true" data-icon="&#xe086;"></span>';
}

if(isset($cherche_affiche['doc_link']) and !empty($cherche_affiche['doc_link'])){
echo
'<span title="ce cours est valable en document word" style="color:#666" id="fs1" aria-hidden="true" data-icon="&#xe058;"></span>';
}
else{echo
'<span title="ce cours pas valable en document word :(" style="color:#aaa" id="fs1" aria-hidden="true" data-icon="&#xe058;"></span>';
}
if(isset($cherche_affiche['ptt_link']) and !empty($cherche_affiche['ptt_link'])){
echo
'<span title="ce cours est valable en document power point" style="color:#666" id="fs1" aria-hidden="true" data-icon="&#xe0f0;"></span>';
}
else{echo
'<span title="ce cours pas valable en document power point :(" style="color:#aaa" id="fs1" aria-hidden="true" data-icon="&#xe0f0;"></span>';
}
echo '</div></a>';
}}
if (empty($sh)){
	echo "<p class='vide'> Stp entrer un mot clé pour bien chercher (ex:com)</p>";
}
elseif(strlen($sh)<3){
	echo "<p class='vide'> il faut au moin 3 caracters pour faire une recherche</p>";
}
elseif($c==0){
	echo "<p class='vide'>aucune résultat pour : ". $sh . "<br /> <span class='engine_beta'>*notre moteur de recherche est en mode beta vous pouvez utiliser le tri </span></p>";
}
$cherche_donne->closeCursor();
?>
</section>
<footer class="foot">
<?php
include_once("footer.php");
?>
</footer>
</body>
</html>
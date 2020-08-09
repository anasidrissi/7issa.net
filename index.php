<?php include_once('db_cnx.php'); $logo_type=1;?> <!-- connection a la base du donne -->
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
<!-- header -->
<?php
include("index_header.php");
?><!--<span onclick="fadee('menu_left')" class="fs1" aria-hidden="true" data-icon="&#xe056;"></span></div>-->
						<!-- menu left -->
<span id="menu_left">
<?php
include("menu_left.php");
?>
</span>
<?php
$hissa_donne=$hissa_db->query('SELECT COUNT(id) FROM hissa_beta');
$hissa_affiche=$hissa_donne->fetch();
$rows=$hissa_affiche[0];
$page_rows=12;
$last=ceil($rows/$page_rows);
if($last<1){
	$last=1;
}
$pagenum=1;
if(isset($_GET['pn'])){
	$pagenum=preg_replace('#[^0-9]#','', $_GET['pn']);
}
if ($pagenum<1) {
	$pagenum=1;
}
elseif ($pagenum>$last) {
	$pagenum=s($last);
}
$limit='LIMIT ' . ($pagenum-1)*$page_rows . ',' . $page_rows;
$hissa_donne=$hissa_db->query("SELECT * FROM hissa_beta ORDER BY date DESC $limit");
$paginationctrs='';
if ($last!=1) {
	if ($pagenum>1) {
		$previous=$pagenum-1;
		$paginationctrs.='<a title="la page precedent" id="fs1" aria-hidden="true" data-icon="&#x44;" href="' . $_SERVER['PHP_SELF'] . '?pn=' . $previous . '"></a> &nbsp; ';
		for ($j=$pagenum-4; $j<$pagenum ; $j++) {
		if ($j>0) {
			$paginationctrs.='<a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $j . '">' . $j . '</a>&nbsp;';
		}
	}
}
	$paginationctrs.= '<a style="color:black" href="#">'. $pagenum . '</a>&nbsp;';
for ($j=$pagenum+1; $j <=$last ; $j++) { 
	$paginationctrs.='<a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $j . '">' . $j . '</a> &nbsp;'; 
	if($j>=$pagenum+4){
		break;
	}
}
if ($pagenum!=$last) {
	$next=$pagenum+1;
	$paginationctrs.='<a title="la page suivante" id="fs1" aria-hidden="true" data-icon="&#x45;" class="extrem" href="'.$_SERVER['PHP_SELF'].'?pn='.$next.'" ></a>';
}
}
function replace_off($target){
	if(preg_match('#é#',$target)){
	$target=str_replace('é','é',$target);
	return $target;
	}
	else{
		return $target;
	}
}
function replace_on($target){
	if(preg_match('#Ã©#',$target)){
	$target=str_replace('Ã©','Ã©',$target);
	return $target;
	}
	else{
		return $target;
	}
}
?><!-- les fonction de remplacement des caracters speciaux et la pagination -->
<!-- the principale section in the website -->
<section id="principale">
<?php
$hissa_donne=$hissa_db->query("SELECT * FROM hissa_beta ORDER BY date DESC $limit");
while($hissa_affiche=$hissa_donne->fetch()){
	if(preg_match('#Ã©#',$hissa_affiche['mat_name'])){
	$hissa_affiche['mat_name']=str_replace('Ã©','é',$hissa_affiche['mat_name']);
}
	if(preg_match('#Ã©#',$hissa_affiche['name'])){
	$hissa_affiche['name']=str_replace('Ã©','é',$hissa_affiche['name']);
}// fix "é" problem just in this moment
$id=$hissa_affiche['id'];
$name=replace_off($hissa_affiche['name']);
$mat=replace_off($hissa_affiche['mat_name']);
$date=$hissa_affiche['date'];
$prof=$hissa_affiche['prof_name'];

if($hissa_affiche['link_var']=="no" OR $hissa_affiche['link_var']=="load" OR empty($hissa_affiche['link_var'])){
	$href='cours/?cours='.$id.'';//link if vedeo doesen't exist
}
else{
	
	$href='hissa_play.php?v_id='.$id.'&nom='.$name.'&mat='.$mat.'';//link if video existe
}
	echo '<a href="' . $href . '"><div id="hissa_index">
	<aside class="name" title="' . $name . '">' . ucfirst($name) . '</aside>
<aside class="img_name"><img class="img_size" src="img/hissa_img/' . $hissa_affiche['img_name'] . '" /></aside>
<span>
<aside class="prof_name" title="' . $prof . '"><a>' . strtoupper($prof) . '</a></aside>
<aside class="mat_name" title="' . $mat . '">' . ucfirst($mat) . '</aside>
<aside class="dat" title="Le: ' . $hissa_affiche['date'] . '">' . $hissa_affiche['date'] . '</aside>';
if ($hissa_affiche['semestre']!=0) {
		echo '<aside class="semestre">Semestre ' . $hissa_affiche['semestre'] . ' Ens ' . $hissa_affiche['ensemble'] .'</aside>';
}
else{
		echo '<aside class="semestre">hissa num : ' . $hissa_affiche['hissa_num'] . '</aside>';
}
if($hissa_affiche['link_var']=="load"){
echo
'<span title="ce cours en train de chargement" style="color:#666;" id="fs1" aria-hidden="true" data-icon="&#xe02d;"></span>';
}
elseif($hissa_affiche['link_var']=="no"){
	echo
'<span title="Ce cours n\'est pas encore en vidéo" style="color:#aaa;" id="fs1" aria-hidden="true" data-icon="&#xe00e;"></span>';
}
else{
		echo
'<span title="Ce cours est en vidéo" style="color:#666" id="fs1" aria-hidden="true" data-icon="&#xe00e;"></span>';

}

if(isset($hissa_affiche['pdf_link']) and !empty($hissa_affiche['pdf_link']) and $hissa_affiche['pdf_link']!="no"){
echo
'<span title="Ce cours est existe en pdf" style="color:#666" id="fs1" aria-hidden="true" data-icon="&#xe086;"></span>';
}
else{echo
'<span title="Ce cours n\'existe pas en pdf" style="color:#aaa" id="fs1" aria-hidden="true" data-icon="&#xe086;"></span>';
}

if(isset($hissa_affiche['doc_link']) and !empty($hissa_affiche['doc_link']) and $hissa_affiche['doc_link']!="no"){
echo
'<span title="Ce cours est existe en document word" style="color:#666" id="fs1" aria-hidden="true" data-icon="&#xe058;"></span>';
}
else{echo
'<span title="Ce cours n\'existe pas en document word" style="color:#aaa" id="fs1" aria-hidden="true" data-icon="&#xe058;"></span>';
}
if(isset($hissa_affiche['ptt_link']) and !empty($hissa_affiche['ptt_link']) and $hissa_affiche['ptt_link']!="no"){
echo
'<span title="Ce cours est existe en document powerpoint" style="color:#666" id="fs1" aria-hidden="true" data-icon="&#xe0f0;"></span>';
}
else{echo
'<span title="Ce cours n\'existe pas en document powerpoint" style="color:#aaa" id="fs1" aria-hidden="true" data-icon="&#xe0f0;"></span>';
}
echo '</div></a>';
}
echo '<center><aside id="pagin_ctrl">' . $paginationctrs . '</aside></center>';

 ?>
 </section>
  
 <!-- the news section of the website -->
 <section id="newsandads">
 <!-- les reseaux sociaux [home_page] -->
 <div class="news">
 <div class="titre_section_news"><a href="#">Réseaux sociaux</a></div>
 <div class="sociaux">
 <span style="color:black" id="fs1" aria-hidden="true" data-icon="&#xe0c1; ">facebook</span>
 <span style="color:black" id="fs1" aria-hidden="true" data-icon="&#xe0c2; ">twitter</span>
 <span style="color:black" id="fs1" aria-hidden="true" data-icon="&#xe0d1; ">youtube</span>
 <span style="color:black" id="fs1" aria-hidden="true" data-icon="&#xe0c4; ">google+</span>
 </div>
 </div>
 	<!-- publicite [home_page] -->
  <div class="ads" id="pub" >
	<div class="titre_section_news"><a href="#">Publicité</a></div>
	<div id="adsence"><a href="plan_comptable.php"><img src="img/ads_exemple.png" /></a></div>
</div>
					<!-- hissa app [home_page] -->
 <div class="ads" >
	<div class="titre_section_news"><a href="hissa_apps.php">7issa apps</a></div>
	<div id="plan_comptable">
		<a href="plan_comptable.php"><img class="app_img" src="img/plan_comptable.png" /></a>
		<a href="hissa_apps/statistique"><img src="img/statistique.jpg" /></a>
		<a href="#.php"><img src="img/no_img.jpg" /></a>
		<a href="#.php"><img src="img/no_img.jpg" /></a>
	</div>
</div>
</section>
<br />

<footer class="foot"><!-- footer section -->
 <?php
 include("footer.php");
 ?>
 </footer>
</body>
</html>

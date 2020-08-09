<?php
include_once("../db_cnx.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../tools/font_style.css" />
<link rel="stylesheet" href="../tools/header.css">
<link rel="stylesheet" href="../tools/rit.css" />
<link rel="stylesheet" href="../tools/style.css" />
<link rel="stylesheet" href="../tools/menu_left_style.css" />
<link rel="icon" href="../img/icon.ico" />
<script type="text/javascript" src="../tools/fades.js"></script>
<script type="text/javascript" src="../tools/jquery.js"></script>
<script type="text/javascript" src="../tools/index_script.js"></script>
	<title>7issa | RIT</title>
</head>
<?php
$hissa_donne=$hissa_db->query("SELECT COUNT(id) FROM hissa_beta WHERE prof_name='omar'");
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
	$pagenum=$last;
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
// la pagination tres important?>
<body>
	<header> <!-- la devision  header syle fix-->
	<?php
	include("header.php");
	?>
	<div><span onclick="fadee('menu_left_rit')" class="fs1" aria-hidden="true" data-icon="&#xe056;"></span></div>
	</header>

	<div id="menu_left_rit"><!-- menu left rit -->
	<?php
	include_once("menu_left.php");
	?>
	</div>

 <!-- rit couverture -->
<img class="img_couv" src="../img/rit.png" /> <!-- l'image du couverture RIT -->
	<div class="about_admin">
		<span title="information sur le prof" style="color:#444" id="fs1" aria-hidden="true" data-icon="&#xe08a;"></span><a class="apropos_admin" href="bio.php">information sur le prof</a>
		<span title="Chaine youtube" style="color:#C41A1E;" id="fs1" aria-hidden="true" data-icon="&#xe0a3;"></span><a target="_blanket" class="youtube" href="https://www.youtube.com/channel/UCAHaKVpDJqo9uOm_fL4BIcg">Chaine youtube</a>
		<span title="La page facebook" style="color:#3974B1;" id="fs1" aria-hidden="true" data-icon="&#xe093;"></span><a target="_blanket" class="facebook" href="https://www.facebook.com/repinfotech">La page facebook</a>
		<span title="twitter" style="color:#2793E6;" id="fs1" aria-hidden="true" data-icon="&#xe094;"></span><a class="twitter" href="#">twitter</a>
	</div>
<section id="principale_rit">
<?php
$hissa_donne=$hissa_db->query("SELECT * FROM hissa_beta WHERE prof_name='omar' ORDER BY date DESC $limit");
while($hissa_affiche=$hissa_donne->fetch()){
	if(preg_match('#Ã©#',$hissa_affiche['mat_name'])){
	$hissa_affiche['mat_name']=str_replace('Ã©','é',$hissa_affiche['mat_name']);
}
	if(preg_match('#Ã©#',$hissa_affiche['name'])){
	$hissa_affiche['name']=str_replace('Ã©','é',$hissa_affiche['name']);
}// fix "é" problem just in this moment
	echo '<a href="../hissa_play.php?v_id=' . $hissa_affiche['id'] . '&nom=' . $hissa_affiche['name'] . '&mat=' . $hissa_affiche['mat_name'] . '"><div id="hissa_index">
	<aside class="name" title="' . $hissa_affiche['name'] . '">' . $hissa_affiche['name'] . '</aside>
<aside class="img_name"><img class="img_size" src="../img/hissa_img/' . $hissa_affiche['img_name'] . '" /></aside>
<span>
<aside class="prof_name" title="' . $hissa_affiche['prof_name'] . '"><a>' . $hissa_affiche['prof_name'] . '</a></aside>
<aside class="mat_name" title="' . $hissa_affiche['mat_name'] . '">' . $hissa_affiche['mat_name'] . '</aside>
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
'<span title="ce cours n\'est valide en mode video" style="color:#aaa;" id="fs1" aria-hidden="true" data-icon="&#xe00e;"></span>';
}
else{
		echo
'<span title="ce cours est valide en mode video" style="color:#666" id="fs1" aria-hidden="true" data-icon="&#xe00e;"></span>';

}

if(isset($hissa_affiche['pdf_link']) and !empty($hissa_affiche['pdf_link']) and $hissa_affiche['pdf_link']!="no"){
echo
'<span title="ce cours est valide en document pdf" style="color:#666" id="fs1" aria-hidden="true" data-icon="&#xe086;"></span>';
}
else{echo
'<span title="ce cours pas valide en mode pdf :(" style="color:#aaa" id="fs1" aria-hidden="true" data-icon="&#xe086;"></span>';
}

if(isset($hissa_affiche['doc_link']) and !empty($hissa_affiche['doc_link']) and $hissa_affiche['doc_link']!="no"){
echo
'<span title="ce cours est valide en document word" style="color:#666" id="fs1" aria-hidden="true" data-icon="&#xe058;"></span>';
}
else{echo
'<span title="ce cours pas valide en document word :(" style="color:#aaa" id="fs1" aria-hidden="true" data-icon="&#xe058;"></span>';
}
if(isset($hissa_affiche['ptt_link']) and !empty($hissa_affiche['ptt_link']) and $hissa_affiche['ptt_link']!="no"){
echo
'<span title="ce cours est valide en document power point" style="color:#666" id="fs1" aria-hidden="true" data-icon="&#xe0f0;"></span>';
}
else{echo
'<span title="ce cours pas valide en document power point :(" style="color:#aaa" id="fs1" aria-hidden="true" data-icon="&#xe0f0;"></span>';
}
echo '</div></a>';
}
echo '<center><aside id="pagin_ctrl">' . $paginationctrs . '</aside></center>';
 ?>
 </section>
</body>
</html>
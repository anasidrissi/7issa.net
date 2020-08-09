<?php 
 include('../db_cnx.php'); $logo_type=1;?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="../tools/font_style.css" />
<link rel="stylesheet" type="text/css" href="../tools/index_style.css" />
<link rel="stylesheet" href="../tools/header.css" />
<link rel="stylesheet" href="../tools/menu_left_style.css" />
<link rel="stylesheet" type="text/css" href="../tools/cours_style.css">
<script type="text/javascript" src="../tools/jquery.js"></script>
<script type="text/javascript" src="../tools/index_script.js"></script>
<title></title>
<script type="text/javascript" src="../tools/fades.js"></script>
</head>
<body>
<?php
$cours=(int)$_GET['cours'];
$cours_donne_mat=$hissa_db->query('SELECT * FROM hissa_beta WHERE id='.$cours.'');
$cours_affiche_mat=$cours_donne_mat->fetch();
$matiere=$cours_affiche_mat['mat_name'];
function classmaker($var2, $var3){
	if (!empty($var2) AND $var2!="no") {
		$class="yes_".$var3;
	}
	else{
		$class="no_".$var3;
	}
	return $class;
}
function linkmaker($var1){
	if (!empty($var1) AND $var1!= "no") {
		$link=$var1;
}
else{
	$link="#";
}
return $link;
}
$cours_donne_mat->closeCursor();
$more_donne=$hissa_db->query('SELECT * FROM hissa_beta WHERE mat_name=\''.$matiere.'\' AND id!=\''.$cours.'\' ORDER BY date DESC LIMIT 0,5');
?>
<?php
include("index_header.php");
?>
<span id="menu_left">
<?php
include("menu_left.php");
?>
</span>
	<section id="principale_cours">
		<div class="main_cours">
		<?php
		
			include_once("cours".$cours.".html");
		?>
		</div>
		<div class="related_cours">
		<span>Voir aussi : </span><br/>
		<?php
		while ($more_affiche=$more_donne->fetch()) {
			echo "<a class='more_link' href='?cours=".$more_affiche['id']."'>".iconv("UTF-8", "ISO-8859-1//TRANSLIT", $more_affiche['name'])." (Cours ".$more_affiche['hissa_num'].")</a>";

		}

		?>
		</div>
	</section>
	<section id="principale_cours" class="plus_doc">
	<div id="titre_section"><span style="color:white" id="fs1" aria-hidden="true" data-icon="&#xe02b;"></span>Plus des documents</div>

		<center>
		<div id='download_button' class="<?php echo classmaker($cours_affiche_mat["pdf_link"], "pdf_link"); ?>" ><span style="color:white" id="fs1" aria-hidden="true" data-icon="&#xe086;"></span><a href="<?php echo linkmaker($cours_affiche_mat["pdf_link"]); ?>" >PDF</a></div>
		<div id='download_button' class="<?php echo classmaker($cours_affiche_mat["doc_link"], "doc_link"); ?>" ><span style="color:white" id="fs1" aria-hidden="true" data-icon="&#xe058;"></span><a href="<?php echo linkmaker($cours_affiche_mat["doc_link"]); ?>">WORD</a></div>
		<div id='download_button' class="<?php echo classmaker($cours_affiche_mat["ptt_link"], "ptt_link"); ?>" ><span style="color:white" id="fs1" aria-hidden="true" data-icon="&#xe0f0;"></span><a href="<?php echo linkmaker($cours_affiche_mat["ptt_link"]); ?>">POWERPOINT</a></div>
		<div id='download_button' class="<?php echo classmaker($cours_affiche_mat["link_var"], "link_var"); ?>" ><span style="color:white" id="fs1" aria-hidden="true" data-icon="&#xe00e;"></span><a href="#">VIDEO</a></div></center>

	</section>
	<section id="principale_cours" class="plus_doc"><!-- section des commentaire -->
		<div id="titre_section"><span style="color:white" id="fs1" aria-hidden="true" data-icon="&#xe066;"></span>Vos avis</div>
	</section>
	<!-- plus de cours -->
</body>
</html>

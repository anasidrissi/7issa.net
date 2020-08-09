<?php include_once('../db_cnx.php'); $logo_type=3; ?> <!-- connection a la base du donne -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="sylesheet" type="text/css" href="../tools/admin_style.css">
	<link rel="stylesheet" href="../tools/font_style.css" />
	<link rel="stylesheet" type="text/css" href="../tools/header.css" />
	<link rel="stylesheet" href="../tools/menu_left_style.css" />
	<link rel="stylesheet" type="text/css" href="../tools/hissa_apps.css">
	<script type="text/javascript" src="../tools/jquery.js" ></script>
	<link rel="icon" href="img/icon.ico" />
<title>administration | 7issa.com</title>
<style>
.label{
	width:10em;
	display:inline-block;
	}
.btn{
	width:6em;
	height:2em;
}
textarea{
	width:12.5em;
}
legend{
	font-weight:bold;
	font-size:large;
	color:#066;
}
#table_de_commende{
	position: relative;
}
select{
	width: 13%;
	margin-left: 0px;
}
#btn{
	height: 2em;
	width: 8em;
	border: 1px solid black;
	margin-top: 0.5em;
	font-size: 0.8em;
}
#btn:hover{
	background-color: green;
	border: 2px solid black;
	transition:background-color 1s;
	transition:border 1s;
}
#error_affiche{
	width: 40%;
	background: white;
	border: 1px solid #aaa;
	border-radius: 5px;
	position: absolute;
	top: 15em;
	left: 30%;
	z-index: 5;
	display: none;
	font-family: hissa_fontb;
	padding-bottom: 3em;
	box-shadow: 0px 0px 7px 1px #ccc;
}
#error_affiche>h1{
	font-family: hissa_font;
}
#error_affiche>div{
	background: #a80000;
	height: 1.5em;
	color: white;
}
#error_affiche>div>strong{
	position: relative;
	left: 43%;
}
#error_affiche>div>strong:hover{
	color: red;
	cursor: pointer;
}
.alert{
	color: red;
}
</style>
</head>

<body>
<?php include_once('admin_header.php'); ?>

<!-- error tracker -->
<?php
	$error_affiche = array('aucun erreur',
							'une ou plusieur variables sont absent verifier votre formulaire',
							 'une ou plusieur variable sont introuvables merci pour verifier vos variables',
							  'l\'extension du images pas valide merci pour verifier votre image',
							  'la taille du limage et trop volumeux merc pour insere une image valide',
							  'cocher une seule case pour finir',
							  'l\'id du cours est introuvables mrc pour inserer une id valide',
							  'une ou plusieur donne ne sont pas valide mrc pour verifier votre news',
							  'aucune page html uploader' );
	$succes_affiche=array('aucun succes','les données sont bien posté','les données sont bien modifié','les données sont bien suprimé');
	if (isset($_GET['error'])) {
		$error_index=(int)$_GET['error'];
		echo "<center><div id='error_affiche' >
		<div>erreur <strong id='cic'> X </strong></div>
		<h1>".$error_affiche[$error_index]."</h1>
		</div></center>";
		echo "<script type='text/javascript'>
	$('#error_affiche').fadeIn('slow');
	$('#error_affiche').click(function(){
		$('#error_affiche').fadeOut('slow');
	})
	$('body').click(function(){
		$('#error_affiche').fadeOut('slow');
	})
</script>";
	}
	elseif (isset($_GET['succes'])) {
		$succes_index=(int)$_GET['succes'];
		echo "<center><div id='error_affiche' >
		<div style='background:green;' >succès <strong> X </strong></div>
		<h1>".$succes_affiche[$succes_index]."</h1>
		</div></center>";
		echo "<script type='text/javascript'>
	$('#error_affiche').fadeIn('slow');
	$('#error_affiche').click(function(){
		$('#error_affiche').fadeOut('slow');
	})
	$('body').click(function(){
		$('#error_affiche').fadeOut('slow');
	})
</script>";
	}
?>
<section id='table_de_commende'>
<form action="administration_post.php" method="post" enctype="multipart/form-data">
<input type="checkbox" name="hissa_post_choice" /><label>poster une nouvelle seance</label><br />
<input type="checkbox" name="news_post_choice" /><label>poster une nouvelle news</label><br />
<input type="checkbox" name="hissa_edit_choice" /><label>modifier un cours</label><label style="margin-left:2em;" >cours id:</label><input type="number" name="id_edit" placeholder="entrer l'id du cours ici" /><br />
<input type="checkbox" name="hissa_delet_choice" /><label class="alert" >suprimer un cours</label><label style="margin-left:2em;" >cours id:</label><input type="number" name="id_delet" placeholder="entrer l'id du cours ici" /><br />
<fieldset class="hissa_jdida">
<legend>les donne pour ajouter une seance:</legend>
<div class="label"><label>nom du l'université: </label></div>
	<select name="univer_name" id="iniv_name">
<option value="Fsjes Mohammedia">Fsjes Mohammedia</option>
<option value="Fsjes Mohammedia">faculte benmsik</option>
<option value="Fsjes Mohammedia">faculte ain sbaa</option>
<option value="rit">rit</option>
</select><br />

<div class="label"><label>matier: </label></div>
	<select name="mat_name" id="iniv_name">
<option value="introduction">introduction</option>
<option value="management">management</option>
<option value="management II">management II</option>
<option value="comptabilité">comptabilité</option>
<option value="comptabilité II">comptabilité II</option>
<option value="statistique">statistique</option>
<option value="microeconomie">microeconomie</option>
<option value="macroeconomie">macroeconomie</option>
<option value="probabilité">probabilité</option>
<option value="mathématique">mathématique</option>
<option value="reseaux">reseaux</option>
<option value="language">language</option>
<option value="reparation">reparation</option>
<option value="bureautique">bureautique</option>
</select><br />
<div class="label"><label>titre du cours: </label></div><input name="name" type="text" /><br />
<div class="label"><label>nom du prof: </label></div><input name="prof_name" type="text" /><br />
<div class="label"><label>la date: </label></div><input name="date" type="text" /><br />
<div class="label"><label>LINK: </label></div><input placeholder="(ex: Jbnlk) ou 'no' pour rien" name="link_var" type="text" /><br />
<div class="label"><label>ensemble : </label></div><input name="ensemble" type="number" /><br />
<div class="label"><label>semestre : </label></div><input name="semestre" type="text" /><br />
<div class="label"><label>pdf_link : </label></div><input placeholder="(ex:http//...) ou vide pour rien" name="pdf_link" type="text" /><br />
<div class="label"><label>ptt_link : </label></div><input placeholder="(ex:http//...) ou vide pour rien" name="ptt_link" type="text" /><br />
<div class="label"><label>doc_link : </label></div><input placeholder="(ex:http//...) ou vide pour rien" name="doc_link" type="text" /><br />
</div><input name="img_name" type="hidden" />
<div class="label"><label>hissa_num : </label></div><input name="hissa_num" type="number" /><br />
<label>le cours html:</label><input type="file" name="html_cours" /><br />
<label>l'image</label><input type="file" name="img"  />
<input id="btn" value="poster" type="submit" />
</fieldset>
<fieldset class="news_jdida">
<legend>les donne pour ajouter une news :</legend>
<div class="label"><label>la date du news</label></div><input name="news_date" type="text" /><br />
<div class="label"><label>le titre du news</label></div><input name="news_titre" type="text" /><br />
<div class="label"><label>la news en arabe</label></div><textarea name="news_ar"></textarea><br />
<div class="label"><label>la news en français</label></div><textarea name="news_fr"></textarea><br />
<input style="margin-left:19.5em;" id="btn" value="news_post" type="submit" />
</fieldset>
</form>
</section>
<?php
?>
</body>
</html>
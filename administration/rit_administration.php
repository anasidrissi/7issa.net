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
select{
	width: 13%;
	margin-left: 0px;
}
</style>
</head>

<body>

<?php include_once('admin_header.php'); ?>
<form action="administration_post.php?input=1" method="post" enctype="multipart/form-data">
<input type="checkbox" name="hissa_post_choice" /><label>poster une nouvelle seance</label><br />
<input type="checkbox" name="news_post_choice" /><label>poster une nouvelle news</label><br />
<input type="checkbox" name="hissa_edit_choice" /><label>modifier un cours</label><label style="margin-left:2em;" >cours id: </label><input type="number" name="id_edit" placeholder="entrer l'id du cours ici" /><label style="color:red;">Pour modifier un cours if faut donnez l'ID du cours, voir l'aide pour bien comprendre</label><br />
<fieldset class="hissa_jdida">
<legend>les donne pour ajouter une seance:</legend>
<div class="label"><label>nom du l'université: </label></div>
	<select name="univer_name" id="iniv_name">
<option value="rit">rit</option>
<option value="bts">bts</option>
</select><br />

<div class="label"><label>matier: </label></div>
	<select name="mat_name" id="iniv_name">
<option value="">- - choisir une matiere - -</option>
<option value="windows">windows</option>
<option value="linux">linux</option>
<option value="python">python</option>
<option value="reseaux">reseaux</option>
<option value="developement">developement</option>
<option value="divertisement">divertisement</option>
</select><br />
<div class="label"><label>titre du cours : </label></div><input name="name" type="text" /><br />
<div class="label"><label>nom du prof : </label></div><input value="omar" name="prof_name" type="text" /><br />
<div class="label"><label>la date : </label></div><input name="date" type="text" /><br />
<div class="label"><label>LINK* : </label></div><input placeholder="(ex: Jbnlk) ou 'no' pour rien" name="link_var" type="text" /><br />
<input name="ensemble" value="0" type="hidden" /><br />
<input name="semestre" value="0" type="hidden" /><br />
<div class="label"><label>pdf_link : </label></div><input placeholder="(ex:http//...) ou vide pour rien" name="pdf_link" type="text" /><br />
<div class="label"><label>ptt_link : </label></div><input placeholder="(ex:http//...) ou vide pour rien" name="ptt_link" type="text" /><br />
<div class="label"><label>doc_link : </label></div><input placeholder="(ex:http//...) ou vide pour rien" name="doc_link" type="text" /><br />
</div><input name="img_name" type="hidden" />
<div class="label"><label>hissa_num : </label></div><input name="hissa_num" type="number" /><br />
<input title="7issa accepte les formats suivant: png PNG jpg JPG jpeg JPEG gif GIF" type="file" name="img" />
<input class="btn" value="poster" type="submit" /> 
</fieldset>
<fieldset class="news_jdida">
<legend>les donne pour ajouter une news :</legend>
<input name="section" type="hidden" value="rit" /><br />
<div class="label"><label>la date du news</label></div><input  name="news_date" type="text" /><br />
<div class="label"><label>le titre du news</label></div><input  name="news_titre" type="text" /><br />
<div class="label"><label>la news en arabe</label></div><textarea  name="news_ar"></textarea><br />
<div class="label"><label>la news en français</label></div><textarea  name="news_fr"></textarea><br />
<input style="margin-left:19.5em;" class="btn" value="news_post" type="submit" />
</fieldset>
</form>
<?php
?>
</body>
</html>
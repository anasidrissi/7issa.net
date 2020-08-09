<html>
<head>
<link rel="stylesheet" href="tools/menu_left_style.css" />
<link rel="icon" href="img/icon.ico" />
</head>
<body class="body_menu_left">
<div id="menu_left_principale">

<?php
echo '<p class="titre_menu_left"><a href="../">Economie :</a></p>';      //pour la ligne suivant cett solution est temporaire n'est pas finale
$matieres= array ('rit_developpement'=>'developpement','rit_python'=>'python','rit_reseaux'=>'reseaux','rit_windows'=>'windows','rit_linux'=>'linux','introduction'=>'introduction','management'=>'management', 'management II'=>'management II','comptabilité'=>'comptabilité','comptabilité II'=>'comptabilité II','statistique'=>'statistique','microeconomie'=>'microeconomie','macroeconomie'=>'macroeconomie','probabilité'=>'probabilité','math'=>'math','algébre'=>'algébre','حقوق'=>'حقوق');
foreach($matieres as $element){
	$matiers_key=array_search($element,$matieres);
	if(!preg_match('#^rit#', $matiers_key)){
	$count_donne=$hissa_db->query('SELECT COUNT(*)AS hissa_nb FROM hissa_beta  WHERE mat_name=\'' . $element . '\'');
	$count_affiche=$count_donne->fetch();
	echo "<a class='matieres_position' href='../tri.php?tri_cat=" . $element . "'><aside class='matieres' title='" . $element . "'>" . $element . "<span>" . $count_affiche['hissa_nb'] . "</span></aside></a>";
}	
}
echo '<p  class="titre_menu_left"><a title="Repair-Informatique-Technologie" href="rit">RIT :</a></p>';
foreach($matieres as $element){
	$matiers_key=array_search($element,$matieres);
	if(preg_match('#^rit#', $matiers_key)){
	$count_donne=$hissa_db->query('SELECT COUNT(*)AS hissa_nb FROM hissa_beta  WHERE mat_name=\'' . $element . '\'');
	$count_affiche=$count_donne->fetch();
	echo "<a class='matieres_position' href='../tri.php?tri_cat=" . $element . "'><aside class='matieres' title='" . $element . "'>" . $element . "<span>" . $count_affiche['hissa_nb'] . "</span></aside></a>";
}	
}
?>
</div>
</body>
</html>
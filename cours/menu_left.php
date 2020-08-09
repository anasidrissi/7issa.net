
<div id="menu_left_principale" >
<p class="group_titre">CATEGORIES</p>
<?php
echo '<div class="t"><span class="titre_menu_left"><img id="menu_img" src="../img/menu_img/eco.png" /><a href="economie">Economie :</a></span></div><span onClick="fademenu(\'ddd\',\'arrow\')" id="arrow">&#9662;</span>';      //pour la ligne suivant cett solution est temporaire n'est pas finale
echo "<span id='ddd'>";
$matieres= array ('rit_developpement'=>'developpement','rit_python'=>'python','rit_reseaux'=>'reseaux','rit_windows'=>'windows','rit_linux'=>'linux','introduction'=>'introduction','management'=>'management', 'management II'=>'management II','comptabilité'=>'comptabilité','comptabilité II'=>'comptabilité II','statistique'=>'statistique','microeconomie'=>'microeconomie','macroeconomie'=>'macroeconomie','probabilité'=>'probabilité','math'=>'math','algébre'=>'algébre');

foreach($matieres as $element){
	$matiers_key=array_search($element,$matieres);
	if(!preg_match('#^rit#', $matiers_key)){
	$element=mb_convert_encoding($element, "ISO-8859-15");
	$count_donne=$hissa_db->query('SELECT COUNT(*)AS hissa_nb FROM hissa_beta  WHERE mat_name=\'' . $element . '\'');
	$count_affiche=$count_donne->fetch();
	echo "<a class='matieres_position' href='../tri.php?tri_cat=" . $element . "'><aside class='matieres' title='" . $element . "'>" . $element . "<span>" . $count_affiche['hissa_nb'] . "</span></aside></a>";
}	
}
echo "</span>";
echo '<div class="t"><span class="titre_menu_left"><img id="menu_img" src="../img/menu_img/rit.png" /><a title="Repair-Informatique-Technologie" href="rit">RIT :</a></span></div><span onClick="fademenu(\'ccc\',\'arrow2\')" id="arrow2">&#9662;</span>';
echo "<span id='ccc'>";
foreach($matieres as $element){
	$matiers_key=array_search($element,$matieres);
	if(preg_match('#^rit#', $matiers_key)){
	$count_donne=$hissa_db->query('SELECT COUNT(*)AS hissa_nb FROM hissa_beta  WHERE mat_name=\'' . $element . '\'');
	$count_affiche=$count_donne->fetch();
	echo "<a class='matieres_position' href='tri.php?tri_cat=" . $element . "'><aside class='matieres' title='" . $element . "'>" . $element . "<span>" . $count_affiche['hissa_nb'] . "</span></aside></a>";
}	
}
echo "</span>";
?>
<p class="group_titre2">APPLICATIONS</p>
<div class="t"><span class="titre_menu_left"><img id="menu_img" src="../img/menu_img/plan_comptable.png" /><a href="economie">Plan comptable</a></span></div>
</div>
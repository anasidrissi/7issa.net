
<?php
function classmaker($text){
	if (!empty($cours_affiche_mat[$text]) AND $cours_affiche_mat[$text]!="no") {
		$class="yes_".$text;
	}
	else{
		$class="no_".$text;
	}
}
function linkmaker($text2){
	if (!empty($cours_affiche_mat["$text2])) {
		$link=$text2;
}
else{
	$link="#";
}
return $link;
}
?>
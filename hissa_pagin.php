<?php include_once('db_cnx.php'); ?> <!-- connection a la base du donne -->
$hissa_donne=$hissa_db->query('SELECT COUNT(id) FROM hissa_beta');
$hissa_affiche=$hissa_donne->fetch();
$rows=$hissa_affiche[0];
$page_rows=10;
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
$hissa_donne=$hissa_db->query("SELECT * FROM hissa_beta ORDER BY id DESC $limit");
$textligne1="testmonials (<b>$rows</b>)";
$textligne2="page <b>$pagenum </b> of <b>$last</b>";
$paginationctrs='';
if ($last!=1) {
	if ($pagenum>1) {
		$previous=$pagenum-1;
		$paginationctrs.='<a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $previous . '">previous</a> &nbsp; ';
		for ($j=$pagenum-4; $j<$pagenum ; $j++) {
		if ($j>0) {
			$paginationctrs.='<a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $j . '">' . $j . '</a>&nbsp;';
		}
	}
}
	$paginationctrs.= ''. $pagenum . '&nbsp;';
for ($j=$pagenum+1; $j <=$last ; $j++) { 
	$paginationctrs.='<a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $j . '">' . $j . '</a> &nbsp;'; 
	if($j>=$pagenum+4){
		break;
	}
}
if ($pagenum!=$last) {
	$next=$pagenum+1;
	$paginationctrs.='&nbsp;<a href="'.$_SERVER['PHP_SELF'].'?pn='.$next.'">Next</a>';
}
}
$list='';
while ($hissa_affiche=$hissa_donne->fetch()) {
	$id_var=$hissa_affiche['id'];
	$name=$hissa_affiche['name'];
	$list.='<p><a href="tri.php?id='.$id_var . '">'.$name.'</a>-click the link<br></p>';
}
$hissa_donne->closeCursor();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>7issa</title>
</head>

<body>
<div>
<h2><?php echo $textligne1; ?> paged</h2>
<p><?php echo $textligne2; ?></p>
<p><?php echo $list; ?></p>
<div id="pagination_controls"><?php echo $paginationctrs; ?></div>
</div>
</body>
</html>

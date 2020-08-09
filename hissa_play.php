<?php include_once('db_cnx.php'); $logo_type=1; ?> <!-- connection a la base du donne -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="tools/font_style.css" />
<link rel="stylesheet" href="tools/play_style.css" />
<link rel="stylesheet" href="tools/header.css" />
<link rel="stylesheet" href="tools/menu_left_style.css" />
<link rel="icon" href="img/icon.ico" />
<script type="text/javascript" src="tools/fades.js"></script>
<script type="text/javascript" src="tools/jquery.js"></script>
<script type="text/javascript" src="tools/index_script.js"></script>

<title>7issa | <?php echo $_GET['nom']; ?></title><!-- attention -->
</head>
<body>
<?php
include('index_header.php');
?>
<?php
include('menu_left.php');
?>
<?php
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
?><!-- les fonction de remplacement des caracters speciaux -->
</div>
<section class="hissa_player">
<?php
$video=$hissa_db->query('SELECT * FROM hissa_beta WHERE id=\'' . $_GET['v_id'] . '\' AND mat_name=\'' . $_GET['mat'] . '\'');
$video_affiche=$video->fetch();
if($_GET['mat']==$video_affiche['mat_name'] AND $_GET['v_id']==$video_affiche['id'] AND $_GET['nom']==$video_affiche['name']){
		$pdf=$video_affiche['pdf_link'];
	$ptt=$video_affiche['ptt_link'];
	$doc=$video_affiche['doc_link'];
echo '
<div id="titre_video"><img id="img_play_size" src="img/hissa_img/'.$video_affiche['img_name'].'" /><div id="src">' . replace_on($video_affiche['name']) . " > " . replace_on($video_affiche['mat_name']) . " > " . $video_affiche['prof_name'] . " >" ;
		if ($video_affiche['semestre']!=0) {
		 echo " semestre " . $video_affiche['semestre'] . '</div></div>';
		}
		else{
			echo " hissa num " . $video_affiche['hissa_num'] . '</div></div>';
		}

if ($video_affiche['link_var']=="load" OR $video_affiche['link_var']=="no") {
		echo '<div class="error_video"><span title="ce cours pas valable en mode video" style="color:#D5A616" id="fs1" aria-hidden="true" data-icon="&#x73;"></span>le video pas valable pour le moment merci pour votre patience...<br>... الفيديو غير متاح حاليا نشكركم على صبركم</div>';
	}
	else{
echo '<aside class="v_style"><iframe src="https://www.youtube.com/embed/' . $video_affiche['link_var'] . '" frameborder="0" color="white" allowfullscreen></iframe></aside>
<div class="footer_video"><span><a href="cours'.$_GET['v_id'].'.html">Voir le cours écrit en ligne</span> | <span class="video_footer_ar">الدرس اون لاين</a></span></div>
';}}
else{
	header('location:error.php?error=les donnes de ce video pas compatible merci de vous verifiez votre adresse web !');
}
?>
</section>
<section class="plus_de_video">
<div class="titre_plud_de_video"><span style="color:white" id="fs1" aria-hidden="true" data-icon="&#x59;"></span>plus...</div>
<?php
$plus_video=$hissa_db->query('SELECT * FROM hissa_beta WHERE mat_name=\'' . $_GET['mat'] . '\' AND id != \'' . $_GET['v_id'] . '\' ORDER BY date DESC LIMIT 0, 7');
$c=0;
while($plus_affiche=$plus_video->fetch()){	
	echo '<a href="hissa_play.php?v_id=' . $plus_affiche['id'] . '&nom=' . $plus_affiche['name'] . '&mat=' . $plus_affiche['mat_name'] . '"><div id="hissa_index"><div style="border-right:2px solid #666;" class="hissa_plus_container">
<aside class="hissa_plus_img"><img src="img/hissa_img/' . $plus_affiche['img_name'] . '" /></aside>
<aside class="hissa_plus_text">' . $plus_affiche['name'] . '<br />' . $plus_affiche['prof_name'] . '<br />' . replace_on($plus_affiche['mat_name']) . '<span class="plus_date">' . $plus_affiche['date'] . '</span></aside>
</div></a>';
$c++;
}
$plus_video->closeCursor();
$j=7-$c;
if($c<7){
$pluss_video=$hissa_db->query('SELECT * FROM hissa_beta WHERE id != \'' . $_GET['v_id'] . '\' AND mat_name!=\'' . $_GET['mat'] . '\' ORDER BY date DESC LIMIT 0, ' . $j . ''); 
while($plus_affichee=$pluss_video->fetch()){
	echo '<a href="hissa_play.php?v_id=' . $plus_affichee['id'] . '&nom=' . $plus_affichee['name'] . '&mat=' . $plus_affichee['mat_name'] . '"><div id="hissa_index"><div class="hissa_plus_container">
<aside class="hissa_plus_img"><img src="img/hissa_img/' . $plus_affichee['img_name'] . '" /></aside>
<aside class="hissa_plus_text">' . $plus_affichee['name'] . '<br />' . $plus_affichee['prof_name'] . '<br />' . $plus_affichee['mat_name'] . '<span class="plus_date">' . $plus_affichee['date'] . '</span></aside>
</div></a>';
	
}
$pluss_video->closeCursor();
}
?>
</section>
<section class="hissa_documents">
<div class="titre_documents"><span style="color:white" id="fs1" aria-hidden="true" data-icon="&#xe02b;"></span>plus des documents</div>
<?php
echo
'<a class="a_document" href="' . $pdf . '"><div title="telecharger le cours '.$video_affiche['name'].' en format pdf" class="link_document"><span class="pdf">PDF </span> Telecharger</div></a>
<a class="a_document" href="' . $ptt . '"><div title="telecharger le cours '.$video_affiche['name'].' en format power point" class="link_document"><span class="ppt">PPT </span> Telecharger</div></a>
<a class="a_document" href="' . $doc . '"><div title="telecharger le cours '.$video_affiche['name'].' en format word" class="link_document"><span class="doc">DOC </span> Telecharger</div></a>';

?>
</section>
<section class="hissa_avis">
<div class="titre_documents"><span style="color:white" id="fs1" aria-hidden="true" data-icon="&#xe066;"></span>vos avis</div>
<div id="disqus_thread"></div>
<script type="text/javascript">
    /* * * CONFIGURATION VARIABLES * * */
    var disqus_shortname = '7issa';
    
    /* * * DON'T EDIT BELOW THIS LINE * * */
    (function() {
        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
        dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>
<a href="http://example.com/article2.html#disqus_thread">Second article</a>
</section>
<footer>
<?php
include("footer.php");
?>
</footer>
<script type="text/javascript">
	var src=document.getElementById("src");
	var src_h=src.
	alert(src_h);
</script>
<script type="text/javascript">
    /* * * CONFIGURATION VARIABLES * * */
    var disqus_shortname = '7issa';
    
    /* * * DON'T EDIT BELOW THIS LINE * * */
    (function () {
        var s = document.createElement('script'); s.async = true;
        s.type = 'text/javascript';
        s.src = '//' + disqus_shortname + '.disqus.com/count.js';
        (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
    }());
</script>
</body>
</html>
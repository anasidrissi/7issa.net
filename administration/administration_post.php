<?php include_once('../db_cnx.php'); ?> <!-- connection a la base du donne -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="icon" href="../img/wassim.ico">
<title>Document sans titre</title>
</head>

<body>
<?php
// si la case d'insertion d'ne nouvelle sance coucher "1er case"
if(isset($_POST['hissa_post_choice']) AND !isset($_POST['news_post_choice']) AND !isset($_POST['hissa_edit_choice'])){

	// si la case d'insertion d'ne nouvelle sance coucher "1er case"
	$hissa_enter=$hissa_db->prepare('INSERT INTO hissa_beta (univer_name, ensemble, mat_name, prof_name, date, img_name, hissa_num, link_var, name, semestre, pdf_link, ptt_link, doc_link) VALUES (:univer_name, :ensemble, :mat_name, :prof_name, :date, :img_name, :hissa_num, :link_var, :name, :semestre, :pdf, :ptt, :doc)');
	//tester si tous les variable d'entrer sont exist
		if(isset($_POST['univer_name'], $_POST['ensemble'], $_POST['mat_name'], $_POST['prof_name'], $_POST['date'], $_POST['hissa_num'], $_POST['link_var'], $_POST['name'], $_POST['semestre'])){
			//test si tous les variables d'entrée sont pas vide
			if($_POST['ensemble']!=NULL AND $_POST['date']!=NULL AND $_POST['prof_name']!=NULL AND $_POST['hissa_num']!=NULL AND $_POST['hissa_num']!=0 AND $_POST['link_var']!=NULL AND $_POST['name']!=NULL AND $_POST['semestre']!=NULL){
				//teste si l'image est exist avec aucun erreur (l'upload du img)		
				if(isset($_FILES['img'],$_FILES['html_cours']) AND $_FILES['img']['error']==0 AND $_FILES['html_cours']['error']==0){
					if($_FILES['img']['size']<=4000000 AND $_FILES['html_cours']['size']<=4000000){
						$img_info=pathinfo($_FILES['img']['name']);
						
						$html_info=pathinfo($_FILES['html_cours']['name']);
						$extension_upload=$img_info['extension'];
						$extension_upload_html=$html_info['extension'];
						$extension_valide=array('jpg','PNG','png','JPG','JPEG','GIF','jpeg','gif');
						$extension_valide_html=array('html','HTML','htm','HTM');
						//tester si l'extension est valide
						if(in_array($extension_upload_html, $extension_valide_html)){
						
						if(in_array($extension_upload,$extension_valide)){
							move_uploaded_file($_FILES['img']['tmp_name'],'../img' . '/hissa_img/' . basename($_FILES['img']['name']));
							$_POST['img_name']=$_FILES['img']['name'];
							$hissa_enter->execute(array('univer_name'=>htmlspecialchars($_POST['univer_name']),'ensemble'=>htmlspecialchars($_POST['ensemble']),'mat_name'=>htmlspecialchars($_POST['mat_name']),'prof_name'=>htmlspecialchars($_POST['prof_name']),'date'=>htmlspecialchars($_POST['date']),'img_name'=>htmlspecialchars($_POST['img_name']),'hissa_num'=>htmlspecialchars($_POST['hissa_num']),'link_var'=>htmlspecialchars($_POST['link_var']),'name'=>htmlspecialchars($_POST['name']),'semestre'=>htmlspecialchars($_POST['semestre']),'pdf'=>$_POST['pdf_link'], 'ptt'=>$_POST['ptt_link'], 'doc'=>$_POST['doc_link']));
							//attention html file upload
							$hissa_max_donne=$hissa_db->query('SELECT MAX(id) AS id_max FROM hissa_beta');
							$hissa_max_affiche=$hissa_max_donne->fetch();
							$max_id=$hissa_max_affiche['id_max'];
							$id_name=$max_id;
							$hissa_max_donne->closeCursor();
							$_FILES['html_cours']['name']='cours'.$id_name.'.html';
							move_uploaded_file($_FILES['html_cours']['tmp_name'],'../cours/' . basename($_FILES['html_cours']['name']));
							//tester la page d'entrer pour le retour
							if ($_GET['input']==1) {
								header('location:rit_administration.php');
							}
							else{
							header('location:administration.php?succes=1');

							}
						
						}
						else{
							header('location:../administration/administration.php?error=3');
						}
						}
						else{
							header('location:../administration/administration.php?error=8');
						}
					}
					else{
						header('location:../administration/administration.php?error=4');
					}
				}
				else{
					$_POST['img_name']='no_img.png';
					$hissa_enter->execute(array('univer_name'=>htmlspecialchars($_POST['univer_name']),'ensemble'=>htmlspecialchars($_POST['ensemble']),'mat_name'=>htmlspecialchars($_POST['mat_name']),'prof_name'=>htmlspecialchars($_POST['prof_name']),'date'=>htmlspecialchars($_POST['date']),'img_name'=>htmlspecialchars($_POST['img_name']),'hissa_num'=>htmlspecialchars($_POST['hissa_num']),'link_var'=>htmlspecialchars($_POST['link_var']),'name'=>htmlspecialchars($_POST['name']),'semestre'=>htmlspecialchars($_POST['semestre']),'pdf'=>$_POST['pdf_link'], 'ptt'=>$_POST['ptt_link'], 'doc'=>$_POST['doc_link']));
							if ($_GET['input']==1) {
								header('location:rit_administration.php');
							}
							else{
							header('location:administration.php?succes=1');

							}
				}
			}
			else{
				header('location:../administration/administration.php?error=1');
			}
		}
		else{
			header('location:../administration/administration.php?error=2');
		}
}
			



elseif(isset($_POST['news_post_choice']) AND !isset($_POST['hissa_post_choice']) AND !isset($_POST['hissa_edit_choice'])){
	if(isset($_POST['news_titre'],$_POST['news_fr'],$_POST['news_ar'],$_POST['news_date']) AND !empty($_POST['news_titre']) AND !empty($_POST['news_fr']) AND !empty($_POST['news_ar'])){
	$hissa_enter_news=$hissa_db->prepare('INSERT INTO hissa_news (news_titre, news_fr, news_ar, news_date) VALUES (:news_titre, :news_fr, :news_ar, :news_date)');
	
	$hissa_enter_news->execute(array('news_titre'=>$_POST['news_titre'],'news_fr'=>$_POST['news_fr'],'news_ar'=>$_POST['news_ar'],'news_date'=>$_POST['news_date']));
	header('location:administration.php?succes=1');
}
	else{
		header('location:../administration/administration.php?error=7');
	}
} //cete partie pour poster une news :-)


elseif (isset($_POST['hissa_edit_choice']) AND !isset($_POST['news_post_choice']) AND !isset($_POST['hissa_post_choice'])) {
	/* code pour modification d'une seance */
	if(isset($_POST['id_edit']) AND !empty($_POST['id_edit'])){
		$target=(int)$_POST['id_edit'];
	$hissa_backup=$hissa_db->query('SELECT * FROM hissa_beta WHERE id=' . $target . ''); // une point de resturation des vars source
	$hissa_backup_affiche=$hissa_backup->fetch();
	$hissa_edit=$hissa_db->prepare('UPDATE hissa_beta SET univer_name=:univer_name, ensemble=:ensemble, mat_name=:mat_name, prof_name=:prof_name, date=:date, img_name=:img_name, hissa_num=:hissa_num, link_var=:link_var, name=:name, semestre=:semestre, pdf_link=:pdf, ptt_link=:ptt, doc_link=:doc WHERE id=' . $_POST['id_edit'] . '');
	$hissa_vars = array('prof_name','univer_name','ensemble','mat_name','img_name','name','ensemble','hissa_num','pdf_link','doc_link','ptt_link','date','semestre','link_var' );
		if(isset($_FILES['img']) AND $_FILES['img']['error']==0){
					if($_FILES['img']['size']<=4000000){
						$img_info=pathinfo($_FILES['img']['name']);
						$extension_upload=$img_info['extension'];
						$extension_valide=array('jpg','PNG','png','JPG','JPEG','GIF','jpeg','gif');
						if(in_array($extension_upload,$extension_valide)){
							move_uploaded_file($_FILES['img']['tmp_name'],'../img' . '/hissa_img/' . basename($_FILES['img']['name']));
							$_POST['img_name']=$_FILES['img']['name'];
							//$hissa_edit->execute(array('univer_name'=>htmlspecialchars($_POST['univer_name']),'ensemble'=>htmlspecialchars($_POST['ensemble']),'mat_name'=>htmlspecialchars($_POST['mat_name']),'prof_name'=>htmlspecialchars($_POST['prof_name']),'date'=>htmlspecialchars($_POST['date']),'img_name'=>htmlspecialchars($_POST['img_name']),'hissa_num'=>htmlspecialchars($_POST['hissa_num']),'link_var'=>htmlspecialchars($_POST['link_var']),'name'=>htmlspecialchars($_POST['name']),'semestre'=>htmlspecialchars($_POST['semestre']),'pdf'=>$_POST['pdf_link'], 'ptt'=>$_POST['ptt_link'], 'doc'=>$_POST['doc_link']));
							header('location:administration.php?succes=1');
						}
						else{
							header('location:../error.php?error=l\'extension du l\'image non valide merci pour reseyer avec une autre');
						}
					}
					else{
						header('location:../error.php?error=la taille du l\'image trop grand merci pour resseyer avec une autre');
					}
				}
	foreach ($hissa_vars as $element) {
		if (empty($_POST[$element])){
			$_POST[$element]=$hissa_backup_affiche[$element];
		}
	}
	$hissa_edit->execute(array('univer_name'=>htmlspecialchars($_POST['univer_name']),'ensemble'=>htmlspecialchars($_POST['ensemble']),'mat_name'=>htmlspecialchars($_POST['mat_name']),'prof_name'=>htmlspecialchars($_POST['prof_name']),'date'=>htmlspecialchars($_POST['date']),'img_name'=>htmlspecialchars($_POST['img_name']),'hissa_num'=>htmlspecialchars($_POST['hissa_num']),'link_var'=>htmlspecialchars($_POST['link_var']),'name'=>htmlspecialchars($_POST['name']),'semestre'=>htmlspecialchars($_POST['semestre']),'pdf'=>$_POST['pdf_link'], 'ptt'=>$_POST['ptt_link'], 'doc'=>$_POST['doc_link']));
							if ($_GET['input']==1) {
								header('location:rit_administration.php');
							}
							else{
							header('location:administration.php?succes=1');

							}

	/*$hissa_edit->execute(array('univer_name'=>htmlspecialchars($_POST['univer_name']),'ensemble'=>htmlspecialchars($_POST['ensemble']),'mat_name'=>htmlspecialchars($_POST['mat_name']),'prof_name'=>htmlspecialchars($_POST['prof_name']),'date'=>htmlspecialchars($_POST['date']),'img_name'=>htmlspecialchars($_POST['img_name']),'hissa_num'=>htmlspecialchars($_POST['hissa_num']),'link_var'=>htmlspecialchars($_POST['link_var']),'name'=>htmlspecialchars($_POST['name']),'semestre'=>htmlspecialchars($_POST['semestre']),'pdf'=>$_POST['pdf_link'], 'ptt'=>$_POST['ptt_link'], 'doc'=>$_POST['doc_link']));
	header('location:administration.php');*/
	
}
else{
	header("location:../administration/administration.php?error=6");


} 
}//cette partie pour modidifier les seance ***cette partie pas compler pour lr moment***
elseif(isset($_POST['hissa_delet_choice'])) {
	$id_delet=$_POST['id_delet'];
	$hissa_delet=$hissa_db->query('DELETE FROM hissa_beta WHERE id=' . $id_delet . '');
	header("location:../administration/administration.php?succes=3");
}
else{
	header("location:../administration/administration.php?error=5");
}
?>
</body>
</html>
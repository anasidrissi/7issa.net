<head>
<script type="text/javascript">
function fade(x,y){
	var panel=document.getElementById(x) , navarrow=document.getElementById(y), maxH="20em";
	if(panel.style.height==maxH){
		panel.style.height="0px";
		navarrow.innerHTML="&#9662";
	}
	else{
		panel.style.height=maxH;
		navarrow.innerHTML="&#9652";
		panel.style.boxShadow="0px 0px 2px 0px rgba(47, 50, 50, 0.75)";

	}
}
</script>
<link rel="stylesheet" href="tools/font_style.css" />
</head>
<?php
$logo_type=2;
    if ($logo_type==1) {
        $logo_name="logo";
    }
    elseif($logo_type==2){
        $logo_name="logo_apps.png";
    }
    elseif ($logo_type==3) {
        $logo_name="logo_param.png";
    }
?>
<section id="header">
<a title="7issa.com" href="index.php"><aside class="logo"><img src=<?php echo '"'. $logo_name .'"'; ?> /></aside></a>

<div id="btns">
<button title="menu des semestres" id="btn" onClick="fade('panel1','navarrow1')" ><span>Menu</span><span id="navarrow1">&#9662;</span></button>
<button title="menu des semestres" id="btn" onClick="fade('panel2','navarrow2')" ><span>Trier</span><span id="navarrow2">&#9662;</span></button>
</div>
<div id="shearch_field">
<form method="get" id="sh_field" action="cherche.php" >
    <input name="sh" type="text" placeholder="  cherche cours, video, pdf, document..."><button id="btnn"><span title="rehcerche" style="color:white;" id="fs1" aria-hidden="true" data-icon="&#x55;"></span></button>
</form>
</div>
</section>

<div id="panel1">
<ul class="menu_header">
    <li title="la section reseaux informatique (RIT) chez omar"><a href="rit">-Reseaux informatique (RIT)</a></li>
    <li><a href="#">-Apropos du 7issa.com </a></li>
    <li title="comment j'utulise 7issa.com"><a href="#">- Guide d’utilisation</a></li>
    <li title="partage vos cours avec 7issa.com"><a href="#">-Partagez des cours avec nous</a></li>
    <li title="contacter le webmaster du 7issa.com pour des information ou autre chose"><a href="#">-Contactez le webmaster du 7issa.com</a></li>
    <li title="publier sur 7issa.com"><a href="#">-Publier sur 7issa.com</a></li>
    <li title="declarer des fautes sur des cours et ameliorer votre navigation dans 7issa.com"><a href="#">-Declarer des fautes dans un cours ou document</a></li>
    <li title="7issa-apps"><a href="plan_comptable.php">-7issa-apps</a></li>
</ul>
</div>
<div id="panel2">
    <div>
    <span class="tri_title">Trier :</span><br />
    <aside class="tri_content">
    <form method="get" action="tri.php">
    <label>matières :</label>
        <select name="tri_cat" id="iniv_name">
        <option value="no">--selectionner--</option>
        <option value="introduction">introduction</option>
        <option value="management">management</option>
        <option value="management II">management II</option>
        <option value="comptabilité">comptabilité</option>
        <option value="comptabilité II">comptabilité II</option>
        <option value="statistique">statistique</option>
        <option value="microeconomie">microeconomie</option>
        <option value="macroeconomie">macroeconomie</option>
        <option value="probabilité">probabilité</option>
        <option value="math">math</option>
        <option value="algébre">algébre</option>
        <option value="reseaux">reseaux</option>
        <option value="bureautique">bureautique</option>
        <option value="reparation">reparation</option>
        <option value="language">language</option>
        reseaux
        </select>
    <label>semestres :</label>
     	<select name="semestre" id="iniv_name">
        <option value="no">--selectionner--</option>
        <option value="1">semestre 1</option>
        <option value="2">semestre 2</option>
        <option value="3">semestre 3</option>
        <option value="4">semestre 4</option>
        <option value="5">semestre 5</option>
        <option value="6">semestre 6</option>
        </select>
        <center><input class="tri_btn" type="submit" value="trier" /></center>
        </form>
        </aside>
    </div>
</div>
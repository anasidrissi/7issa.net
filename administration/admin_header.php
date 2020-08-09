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
    if ($logo_type==1) {
        $logo_name="logo.png";
    }
    elseif($logo_type==2){
        $logo_name="logo_apps.png";
    }
    elseif ($logo_type==3) {
        $logo_name="logo_param.png";
    }
?>
<body class="body">
<section id="header">
<a title="7issa.com" href="../index.php"><aside class="logo"><img src=<?php echo '"../img/'.$logo_name.'"'; ?> /></aside></a>

</body>
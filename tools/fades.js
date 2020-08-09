var menu_left=document.getElementById("menu_left");
menu_left.style.width="12em";
function fadee(x){
	var left=document.getElementById(x)
	var maxw="12em";
	
	if(left.style.width=="0px"){
		left.style.width=maxw;
	}
	else{
		left.style.width="0px";
	}
}
	function fademenu(x,y){
	var panel=document.getElementById(x) , navarrow=document.getElementById(y);
	if(panel.style.display=="block"){
		panel.style.display="none";
		navarrow.innerHTML="&#9662";
	}
	else{
		panel.style.display="block";
		navarrow.innerHTML="&#9652";
	}
}
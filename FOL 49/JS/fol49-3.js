

function gethours(dStr,format) {
	var now = new Date();
	if (format == "h:m") {
 		now.setHours(dStr.substr(0,dStr.indexOf(":")));
 		now.setMinutes(dStr.substr(dStr.indexOf(":")+1));
 		now.setSeconds(0);
 		return now.getHours();
	}else 
		return "Invalid Format";
}
function getmins(dStr,format) {
	var now = new Date();
	if (format == "h:m") {
 		now.setHours(dStr.substr(0,dStr.indexOf(":")));
 		now.setMinutes(dStr.substr(dStr.indexOf(":")+1));
 		now.setSeconds(0);
 		return now.getMinutes();
	}else 
		return "Invalid Format";
}

function difference(heure1,heure2){

	var h1 = gethours(heure1,"h:m");
	var h2 = gethours(heure2,"h:m");
	var m1 = getmins(heure1,"h:m");
	var m2 = getmins(heure2,"h:m");

	if( m2 < m1){
		h2 = h2 -1;
		m2 = m2+60;

	}

	var dif_h = h2-h1;
	var dif_m = m2-m1;
	
	if (heure1=="" && heure2=="") return "00:00";
	return dif_h+":"+dif_m;
}

function addition(heure1,heure2){
	var h1 = gethours(heure1,"h:m");
	var h2 = gethours(heure2,"h:m");
	var m1 = getmins(heure1,"h:m");
	var m2 = getmins(heure2,"h:m");

	var res_m = m1+m2;
	var res_h = h1+h2;

	while(res_m >= 60){
		res_h = res_h + 1;
		res_m = res_m -60;
	} 
	return res_h+":"+res_m;
}


function valeur_correct(tab){
	for (var i = 0; i<tab.length;) {
		if(tab[i] !="" && tab[i+1] =="" || tab[i] =="" && tab[i+1] !="" ) return false;
		i=i+2;
	}
	return true;
}


//A refaire avec une boucle //

// LUNDI //
var Lundi = document.querySelectorAll(".Lundi");
for (var i = 0; i < Lundi.length; i++) {
	Lundi[i].addEventListener("change",total_jour,false);
	
}

function total_jour() {

	var j=0;
	var tab_val=[];
	var jour=  document.querySelectorAll(".Lundi");
	
	for (var i = 0; i < jour.length; i++) {
		tab_val[j] = jour[i].value;
		++j;
	}	

	if(valeur_correct(tab_val))	{
		var inputTot = document.getElementsByName('submit');
		inputTot[0].disabled=false;
		for (var i = 0; i < jour.length; i++) {
			jour[i].style="border-color: green;";
		}

		var j=0;
		var resultat=[];
		for (var i = 0; i < tab_val.length;) {
			resultat[j] = difference(tab_val[i],tab_val[i+1]);
			++j;
			i=i+2;
		}

		total = "00:00";
		for (var i = 0; i < resultat.length; i++) {
			total = addition(total,resultat[i]);
		}

		var inputTot = document.getElementsByName('Lundi_totaux');
		console.log(inputTot);
		inputTot[0].value=total;
		inputTot[0].disabled=true;
		console.log(resultat);
		console.log(total);
	}
	else {
		for (var i = 0; i < jour.length; i++) {
			jour[i].style="border-color: red;";
		}

		var inputTot = document.getElementsByName('submit');
		inputTot[0].disabled=true;
	}
}


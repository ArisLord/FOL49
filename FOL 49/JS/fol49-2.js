
var type_contrat = document.getElementsByName("contrat");
for (var i = 0; i < type_contrat.length; i++) {
	type_contrat[i].addEventListener("click",contrat,false);
}

function contrat() {
	if (this.value=="CDI"){
		var divCDI = document.getElementById("div-CDI");
		divCDI.innerHTML="";
		var divtab= document.getElementById("tab-horaire-CDI");
		divtab.innerHTML="";
		var divac= document.getElementById("vacance-scolaire");
		divac.innerHTML="";
		var divII= document.getElementById("intermittence");
		divII.innerHTML="";
		// on efface cdd
		var divCDD = document.getElementById("div-CDD");
		divCDD.innerHTML = "";
		var br = document.createElement("br");
		var label = document.createElement("label");
		label.innerHTML="Volume horaire hebdomadaire :";
		var label2 = document.createElement("label");
		label2.innerHTML="heures/semaine";
		var input = document.createElement("input");
		input.type="number";
		input.name="Volume_horaire";
		input.style="border: 0px solid white;border-bottom : 1px solid black ;";

		var label3 = document.createElement("label");
		label3.innerHTML="CDII";
		var checkbox = document.createElement("input");
		checkbox.type= "checkbox";
		checkbox.name="CDII";
		checkbox.id="CDII";

		divCDI.appendChild(label);
		divCDI.appendChild(input);
		divCDI.appendChild(label2);
		divCDI.appendChild(br);
		
		divCDI.appendChild(label3);
		divCDI.appendChild(checkbox);

		var div=document.createElement("div");
		div.id="heure_CDII";
		divCDI.appendChild(div);
		//creation tableau repartition horaire//
		var table = document.createElement("table");
        
		table.id="enfant_style";
		var tr = document.createElement("tr");
		tr.style="background-color:gray;"
		var semaine = ["Lundi","Mardi","Mercredi","Jeudi","Vendredi"];
		for (var i = 0; i < semaine.length; i++) {
			var td = document.createElement("td");
			td.style="border-left : 2px solid black";
			td.innerHTML=semaine[i];
			tr.appendChild(td);
		}
		var tr2 = document.createElement("tr");
		for (var i = 0; i < semaine.length; i++) {
			var td = document.createElement("td");
			td.style="border-left : 2px solid black";
			td.innerHTML="<input type=\"number\" name=\""+semaine[i]+"\" style=\"border: none;\" size=\"4\">";
			tr2.appendChild(td); 
		}
		
		var p = document.createElement("p");
		p.innerHTML="Répartition des heures jour par jour :";
		
		table.appendChild(tr);
		table.appendChild(tr2);
		divtab.appendChild(p);
		divtab.appendChild(table);

		//----------periode de vacance---------------//
		
		var label = document.createElement("label");
		label.innerHTML="Période Vacances scolaires :";
		var label2 = document.createElement("label");
		label2.innerHTML="heures/semaine";
		var input = document.createElement("input");
		input.type="number";
		input.name="Volume_horaire_vacance";
		input.style="border: 0px solid white;border-bottom : 1px solid black ;";

		var table = document.createElement("table");
        
		table.id="enfant_style";
		var tr = document.createElement("tr");
		tr.style="background-color:gray;"
		var semaine = ["Lundi","Mardi","Mercredi","Jeudi","Vendredi"];
		for (var i = 0; i < semaine.length; i++) {
			var td = document.createElement("td");
			td.style="border-left : 2px solid black";
			td.innerHTML=semaine[i];
			tr.appendChild(td);
		}
		var tr2 = document.createElement("tr");
		for (var i = 0; i < semaine.length; i++) {
			var td = document.createElement("td");
			td.style="border-left : 2px solid black";
			td.innerHTML="<input type=\"number\" name=\""+semaine[i]+"_vac"+"\" style=\"border: none;\" size=\"4\">";
			tr2.appendChild(td); 
		}
		
		var p = document.createElement("p");
		p.innerHTML="Répartition des heures jour par jour :";
		
		table.appendChild(tr);
		table.appendChild(tr2);
		
		divac.appendChild(label);
		divac.appendChild(input);
		divac.appendChild(label2);
		divac.appendChild(p);
		divac.appendChild(table);

		var CDII = document.getElementById("CDII");
		CDII.addEventListener("click",contrat_CDII,false);
	}
	else if(this.value=="CDD"){

		var divCDI = document.getElementById("div-CDI");
		divCDI.innerHTML="";
		var divtab= document.getElementById("tab-horaire-CDI");
		divtab.innerHTML="";
		var divac= document.getElementById("vacance-scolaire");
		divac.innerHTML="";	
		var divII= document.getElementById("intermittence");
		divII.innerHTML="";

		var divCDD = document.getElementById("div-CDD");
			divCDD.innerHTML="";
		var contrat_CDD = ["CDD CAE","CDD Emploi d'Avenir"];

		for (var i = 0; i < contrat_CDD.length; i++) {
					var label = document.createElement("label");
					label.innerHTML=contrat_CDD[i];
					label.style="padding: 1% 5% 0% 5%";
					var input=document.createElement("input");
					input.name="cdd_genre";
					input.type="radio";
					input.value=contrat_CDD[i];

					label.appendChild(input);
					divCDD.appendChild(label);
					
			}	

		var div= document.createElement("div");
		var label = document.createElement("label");
		label.innerHTML="<b>Motif CDD:</b>";


		div.appendChild(label);
		divCDD.appendChild(div);

		var motif=["Accroissement temporaire d activite","Remplacement"];
		for (var i = 0; i < motif.length; i++) {
					var div = document.createElement("div");
					var p = document.createElement("label");
					p.innerHTML=motif[i];
					div.style="padding: 1% 5% 0% 5%";
					var input=document.createElement("input");
					input.name="motif_cdd";
					input.type="radio";
					input.value=motif[i];

					div.appendChild(input);
					div.appendChild(p);
					divCDD.appendChild(div);
		}
		var type_cdd = document.getElementsByName("motif_cdd");
		for (var i = 0; i < type_cdd.length; i++) {
		 	type_cdd[i].addEventListener("click",type_CDD,false);
		 }
		var div = document.querySelector("#div-CDD > div:nth-child(4)");
		var div_2 = document.createElement("div");
		div_2.id ="accroissement";
		div.appendChild(div_2);

		var div = document.querySelector("#div-CDD > div:nth-child(5)");
		var div_2 = document.createElement("div");
		div_2.id ="remplacement";
		div.appendChild(div_2); 
	}
}

function contrat_CDII(){
	if(this.checked==true){
		var intermittence = document.getElementById("intermittence");
		intermittence.innerHTML="";
		var div_heure = document.getElementById("heure_CDII");
		div_heure.innerHTML="";
		var label=document.createElement("label");
		label.innerHTML="-intermittence :";

		var lib =["Nombre de semaines non travaillées :","N° semaines non travaillées :"];

		intermittence.appendChild(label);
		for (var i = 0; i < lib.length; i++) {
			var div = document.createElement("div");
			div.style="padding: 1% 5% 0% 5%";
			var label = document.createElement("label");
			label.innerHTML=lib[i];
			var input = document.createElement("input");
			input.type="text";
			input.name=lib[i];

			input.style="border: 0px solid white;border-bottom : 1px solid black ;";
			

			div.appendChild(label);
			div.appendChild(input);
			intermittence.appendChild(div);


		//--------------------- horaire intermittence--------------------- //
		var texte="<div style=\"padding: 1% 5% 0% 5%\"><label>-Durée minimale annuelle :</label>";
		texte=texte+"<input type=\"number\" name=\"Volume_horaire_cdii\" style=\"border-width: 0px 0px 1px; border-style: solid; border-color: white white black; border-image: initial;\">";
		texte = texte + "<label>heures</label></div>";

		var texte_2 ="<div style=\"padding: 1% 5% 0% 5%\"><label>-Période semaine scolaire :</label>";
		texte_2=texte_2+"<input type=\"number\" name=\"Volume_horaire_cdii_scolaire\" style=\"border-width: 0px 0px 1px; border-style: solid; border-color: white white black; border-image: initial;\">";
		texte_2 = texte_2 + "<label>heures/semaine</label></div>";

		div_heure.innerHTML=texte+texte_2;


		}
	}	
	else {
		var intermittence = document.getElementById("intermittence");
		intermittence.innerHTML="";
		var div_heure = document.getElementById("heure_CDII");
		div_heure.innerHTML="";
	}
}


function type_CDD(){

	if(this.value == "Accroissement temporaire d activite"){
		var div_r=document.getElementById("remplacement");
		div_r.innerHTML="";
		var div=document.getElementById("accroissement");
		div.innerHTML="";

		var acc1 = document.createElement("div");
		acc1.id="acc1";
		acc1.style="padding: 1% 5% 0% 5%";
		var code = "<label>Du :</label>";
			code =code+"<input require=\"required\" type=\"date\" size=\"2\" name=\"debut\" style=\"border-width: 0px 0px 1px; border-style: solid; border-color: white white black; border-image: initial;\">";
			code=code+"<label>Au :</label>";
			code=code+"<input require=\"required\" type=\"date\" size=\"2\" name=\"fin\" style=\"border-width: 0px 0px 1px; border-style: solid; border-color: white white black; border-image: initial;\">";
			code=code+"<label>heures travaillées :</label>";
			code =code+"<input require=\"required\" type=\"number\" size=\"2\" name=\"heure\" style=\"border-width: 0px 0px 1px; border-style: solid; border-color: white white black; border-image: initial;\">";
		acc1.innerHTML=code;
		div.appendChild(acc1);
		
	}
	else {
		var div_r=document.getElementById("accroissement");
		div_r.innerHTML="";
		var div=document.getElementById("remplacement");
		div.innerHTML="";

		var remp1 = document.createElement("div");
		remp1.id="remp1";
		remp1.style="padding: 1% 5% 0% 5%";
		var code ="<div>Personne remplacée : <input require=\"required\" type=\"text\" name=\"pers_remp\" style=\"border-width: 0px 0px 1px; border-style: solid; border-color: white white black; border-image: initial;\"></div>"
			code =code+ "<label>Du :</label>";
			code =code+"<input require=\"required\" type=\"date\" size=\"2\" name=\"debut\" style=\"border-width: 0px 0px 1px; border-style: solid; border-color: white white black; border-image: initial;\">";
			code=code+"<label>Au :</label>";
			code=code+"<input require=\"required\" type=\"date\" size=\"2\" name=\"fin\" style=\"border-width: 0px 0px 1px; border-style: solid; border-color: white white black; border-image: initial;\">";
			code=code+"<label>heures travaillées :</label>";
			code =code+"<input require=\"required\" type=\"number\" size=\"2\" name=\"heure\" style=\"border-width: 0px 0px 1px; border-style: solid; border-color: white white black; border-image: initial;\">";
		remp1.innerHTML=code;
		div.appendChild(remp1);

	}
}
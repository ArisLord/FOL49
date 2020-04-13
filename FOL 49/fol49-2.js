
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
		input.type="text";
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
		input.type="text";
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
			td.innerHTML="<input type=\"number\" name=\""+semaine[i]+"\" style=\"border: none;\" size=\"4\">";
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

		var motif=["Accroissement temporaire d'activité","Remplacement"];
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
	}
}

function contrat_CDII(){
	if(this.checked==true){
		var intermittence = document.getElementById("intermittence");
		intermittence.innerHTML="";
		var div_heure = document.createElement("heure_CDII");
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


		}
		console.log(intermittence);
	}	
	
}
var check = document.getElementById('check_kid');
function enfant(){

	var checkbox = document.getElementById('check_kid');
	if(checkbox.checked==true){

		var div=document.getElementById('enfant');
		var table = document.createElement('table');
		var tr = document.createElement('tr');
		var label=["Nom","Prenom","date de naissance","sexe","A charge"];
		for (var i = 0; i < 6; i++) {
			if(i!=5){
				var td= document.createElement('td');
				td.innerHTML=label[i];
				td.style="border : 2px solid black";
			}
			else {
				var td= document.createElement('td');
				var input=document.createElement('button');
				input.type="button";
				input.name="plus";
				input.id="plus";
				input.style="background-color: gray; border: 1px solid gray;";

				input.innerHTML="<i class=\"fas fa-plus-circle\"></i>";

				td.appendChild(input);
				td.style="border-left : 2px solid black";	
			}
			tr.appendChild(td);
		}
		table.id="enfant_style";
		
		table.appendChild(tr);

		div.appendChild(table);

	var plus = document.getElementById('plus');
	plus.addEventListener("click",addline,false);

	}
	else {
		var div=document.getElementById('enfant');
		div.innerHTML="";
	}

}

check.addEventListener("click",enfant,false);

function addline() {
	
	var table = document.getElementById('enfant_style');
	var tr = document.createElement("tr");
	var label_name = ["nom_enfant[]","prenom_enfant[]","date_naiss_enfant[]","sexe_enfant[]","a_charge[]"];
	for (var i = 0; i <= 5; i++) {
		
		if (i!=5){
			var input = document.createElement("input");
			input.name=label_name[i];
			input.type="text";
			input.style="border : 1px solid white;";

			var td = document.createElement("td");
			td.appendChild(input);
			tr.appendChild(td);
		}
		else {
			var input=document.createElement('button');
			var td = document.createElement("td");
			input.className ="moins";
			input.name="moins";
			input.style="border : 1px solid white;";
			input.innerHTML="<i class=\"fas fa-minus-circle\"></i>";
			td.appendChild(input);
			tr.appendChild(td);
		}
	}
	table.appendChild(tr);
	var moins = document.querySelectorAll(".moins");
	for (var i = 0; i < moins.length; i++) {
		moins[i].addEventListener("click",dropline,false);
	}
}


function dropline(){
	var parent=this.parentNode;
	console.log("parent");
	
}
//vue films
function listerF(reponse){
	var listeFilms=reponse.getElementsByTagName("film");
	var idf,titre,duree,res,pochette,taille;
	var rep="<div class='table-users' style='overflow: scroll; height: 500px;'>";
	rep+="<div class='header'>Liste des films<span style='float:right;padding-right:10px;cursor:pointer;' onClick=\"$('#contenu').hide();\">X</span></div>";
	rep+="<table cellspacing='0'>";
	rep+="<tr><th>NUMERO</th><th>TITRE</th><th>DUREE</th><th>REALISATEUR</th><th>POCHETTE</th></tr>";
	taille=listeFilms.length;
	for(var i=0; i<taille; i++){
		idf=listeFilms[i].getElementsByTagName("idf")[0].firstChild.nodeValue;
		titre=listeFilms[i].getElementsByTagName("titre")[0].firstChild.nodeValue;
		duree=listeFilms[i].getElementsByTagName("duree")[0].firstChild.nodeValue;
		res=listeFilms[i].getElementsByTagName("res")[0].firstChild.nodeValue;
		pochette=listeFilms[i].getElementsByTagName("pochette")[0].firstChild.nodeValue;
		rep+="<tr><td>"+idf+"</td><td>"+titre+"</td><td>"+duree+"</td><td>"+res+"</td><td><img src='pochettes/"+pochette+"' width=80 height=80></td></tr>";		 
	}
	rep+="</table>";
	rep+="</div>";
	$('#contenu').html(rep);
}

function afficherFiche(reponse){
  var idf,titre,duree,res,pochette,taille;
  var uneFiche=reponse.getElementsByTagName("film");
  taille=uneFiche.length;
  if(taille>0){
	idf=uneFiche[0].getElementsByTagName("idf")[0].firstChild.nodeValue;
	titre=uneFiche[0].getElementsByTagName("titre")[0].firstChild.nodeValue;
	duree=uneFiche[0].getElementsByTagName("duree")[0].firstChild.nodeValue;
	res=uneFiche[0].getElementsByTagName("res")[0].firstChild.nodeValue;
	pochette=uneFiche[0].getElementsByTagName("pochette")[0].firstChild.nodeValue;
	$('#formFicheF h3:first-child').html("Fiche du film numero "+idf);
	$('#idf').val(idf);
	$('#titreF').val(titre);
	$('#dureeF').val(duree);
	$('#resF').val(res);
	$('#divFormFiche').show();
	document.getElementById('divFormFiche').style.display='block';
  }else{
	$('#messages').html("Film "+$('#numF').val()+" introuvable");
	setTimeout(function(){ $('#messages').html(""); }, 5000);
  }

}

var filmsVue=(reponse) => {
	var action=reponse.getElementsByTagName('action')[0].firstChild.nodeValue;
	switch(action){
		case "enregistrer" :
		case "enlever" :
		case "modifier" :
			$('#messages').html(reponse.getElementsByTagName('msg')[0].firstChild.nodeValue);
			setTimeout(() => { $('#messages').html(""); }, 5000);
		break;
		case "lister" :
			listerF(reponse);
		break;
		case "fiche" :
			afficherFiche(reponse);
		break;
		
	}
}
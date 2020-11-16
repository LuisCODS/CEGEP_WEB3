



function montrer(elem){
	document.getElementById(elem).style.display='block';
}

function cacher(elem){
  document.getElementById(elem).style.display='none';
}

function listerLivres(listeLivres){

	  var taille = listeLivres.length;

	  var rep="<input type='button' value='Fermer' onClick=\"document.getElementById('maWindow').style.display='none'\">";
		  rep+="<table class=table>";
		  rep+="<thead class=thead-light>";
		  rep+="<tr><th>NUMERO</th><th>TITRE</th><th>AUTEUR</th><th>ANNEE</th><th>PAGES</th></tr>";
		  rep+="</thead>";
		  rep+="<tbody>";

	  for(i=0; i < taille; i++)
	  {
		var unLivre = listeLivres[i];
		rep+="<tr>";
		rep+="<td>"+unLivre['idlivre']+"</td>";
		rep+="<td>"+unLivre['titre']+"</td>";
		rep+="<td>"+unLivre['auteur']+"</td>";
		rep+="<td>"+unLivre['annee']+"</td>";
		rep+="<td>"+unLivre['pages']+"</td>";
		rep+="</tr>";
	  }

	  rep+="</tbody>";
	  rep+="</table>";
	  //Attache le content
	  document.getElementById('maWindow').innerHTML=rep;
	  //Display div
	  document.getElementById('maWindow').style.display='block';
}

function envoyerLister(){
   $.ajax({
	   type: "POST",
	   url: "PHP/livresControleur.php",
	   data:'action=lister',
	   dataType:'json',
	   success:function(reponse)
	   {
		  // alert(reponse);
	      listerLivres(reponse);
		},
	   error:function(){
		 //Votre message
	   },
	});
}

function envoyerEnreg(leForm){
	$.ajax({
	   type: "POST",
	   url: "PHP/livresControleur.php",
	   data:$( leForm ).serialize(),
	   dataType:'text',
	   success:function(reponse)
	   {
		  //alert(reponse); //test le type de retour de donnée
		  document.getElementById("emsg").innerHTML=reponse;
		  //Vide la msg apres 5 sec.
		  setInterval(function(){ document.getElementById("emsg").innerHTML=""; }, 5000);
		},
	   error:function(err){
		 //Votre message
	   },
	});
}
